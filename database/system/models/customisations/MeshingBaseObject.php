<?php

/**
 * Space to put in customised methods for node models
 *
 * @author jon
 */
class MeshingBaseObject extends BaseObject
{
	protected $metadataTimeEdited;
	protected $metadataTimeReceived;
	protected $metadataTimeApplied;

	/**
	 * Create a version (containing no column data, just metadata) after a new row is inserted
	 * 
	 * @param PropelPDO $con 
	 */
	public function postInsert(PropelPDO $con = null)
	{
		// If the key is incomplete, this is due to a save on a row referencing another unsaved object
		// @todo Ask why this behaviour exists, and if there is a better way to deal with this?
		$complete = true;
		foreach ($this->getPrimaryKey() as $element)
		{
			if (is_null($element))
			{
				$complete = false;
				break;
			}
		}

		if (!$complete)
		{
			return;
		}

		// Prevent race condition between MAX() and INSERT - lock table here
		$tableName = constant($this->getVersionablePeerName() . '::TABLE_NAME');
		$locker = Meshing_Database_Locker::getInstance($con);
		$ok = $locker->obtainTableLock($tableName);
		if (!$ok)
		{
			throw new Exception('Failed to obtain database lock on ' . $tableName);
		}

		// Create a new versionable row
		try
		{
			$vsn = $this->createVersionableRow($con);
			$this->_preVersionSave($vsn, false);
			$vsn->save($con);
		}
		catch (Exception $e)
		{
			// Release lock and re-throw error
			$locker->releaseTableLock($tableName);
			throw $e;
		}

		// Everything went ok - release table lock here
		$locker->releaseTableLock($tableName);
	}

	/**
	 * Create a version row before an existing row is updated
	 * 
	 * Note: if this table is referenced by another table, that 'parent' will be
	 * preUpdated as well - we just intercept that by checking the modified flag
	 * 
	 * @param PropelPDO $con 
	 */
	public function preUpdate(PropelPDO $con = null)
	{
		// Ignore (related) rows with no changes
		if (!$this->isModified())
		{
			return true;
		}

		// NB, these type hints are just for development
		/* @var $row TestModelTestOrganiser */
		/* @var $vsn TestModelTestOrganiserVersionable */
		
		// Prevent race condition between MAX() and UPDATE - lock table here
		$tableName = constant($this->getVersionablePeerName() . '::TABLE_NAME');
		$locker = Meshing_Database_Locker::getInstance($con);
		$ok = $locker->obtainTableLock($tableName);
		if (!$ok)
		{
			throw new Exception('Failed to obtain database lock on ' . $tableName);
		}

		try
		{
			// Create a new versionable row
			$vsn = $this->createVersionableRow($con);

			// Save the row state as a version before we commit new values
			$row = $this->reselectThisRow($con);		
			$row->copyInto($vsn, $deepCopy = false, $makeNew = false);

			// Let this throw an exception, to be caught higher up
			$this->_preVersionSave($vsn, true);
			$vsn->save($con);
		}
		catch (Exception $e)
		{
			// Release lock and re-throw error
			$locker->releaseTableLock($tableName);
			throw $e;			
		}

		// Everything went ok - release table lock here
		$locker->releaseTableLock($tableName);

		return true;
	}

	/**
	 * Called by internal routines just before version save (testing hook)
	 * 
	 * @param BaseObject $vsn
	 * @param boolean $update
	 */
	protected function _preVersionSave(BaseObject $vsn, $update)
	{
	}

	/**
	 * Returns a versionable row, to use in response to INSERTs or UPDATEs
	 * 
	 * @todo Swap out hardwired column for peer constants
	 * 
	 * @param type $time
	 * @return vsnName 
	 */
	protected function createVersionableRow(PropelPDO $con = null)
	{
		// Create a new versionable
		/* @var $vsn TestModelTestOrganiserVersionable */
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Get max version
		$query = call_user_func(array($this->getVersionableQueryName(), 'create'));
		$maxVersion = $query->
			withColumn('MAX(version)', 'max')->
			select('max')->
			findOne($con);
		$maxVersion = $maxVersion ? $maxVersion : 0;

		// Insert the version PK (current + version number)
		$keys = $this->getPrimaryKey();
		$keys[] = $maxVersion + 1;
		$vsn->setPrimaryKey($keys);

		// The version hash is always for the current record, not the version
		$hashFunction = $vsn->getMeshingHashType();
		$vsn->setMeshingHash($this->calcHash($hashFunction));

		// Complete some metadata common to inserts & updates
		if ($this->metadataTimeEdited)
		{
			$vsn->setTimeEdited($this->metadataTimeEdited);
		}
		if ($this->metadataTimeReceived)
		{
			$vsn->setTimeReceived($this->metadataTimeReceived);
		}
		if ($this->metadataTimeApplied)
		{
			$vsn->setTimeApplied($this->metadataTimeApplied);
		}

		return $vsn;
	}

	/**
	 *
	 * @todo Set a deleted timestamp and return false
	 * 
	 * @param PropelPDO $con
	 * @return type 
	 */
	public function preDelete(PropelPDO $con = null)
	{
		return parent::preDelete($con);
	}

	public function countVersions(PropelPDO $con = null)
	{
		// Get the criteria req'd to select all versions
		$crit = $this->getSelectAllVersionsCriteria();

		// Then count the number of rows
		$vsnPeerName = $this->getVersionablePeerName();
		$count = call_user_func(
			array($vsnPeerName, 'doCount'),
			$crit,
			$_distinct = false,
			$con
		);
		
		return $count;
	}

	/**
	 * For a current row, returns criteria required to select all its versionable rows
	 * 
	 * @return Criteria
	 */
	protected function getSelectAllVersionsCriteria()
	{
		// Create a versionable instance
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Get the pk criteria for the versionable (fake the version, we throw it away anyway)
		$keys = $this->getPrimaryKey();
		$keys = is_array($keys) ? $keys : array($keys);
		$vsn->setPrimaryKey(array_merge($keys, array(1)));
		$crit = $vsn->buildPkeyCriteria();

		// Remove the version from the criteria (match just on original PK)
		$vsnPeerName = $this->getVersionablePeerName();
		$vsnColName = constant($vsnPeerName . '::VERSION');
		$crit->remove($vsnColName);

		return $crit;
	}

	public function countNewVersions(PropelPDO $con = null)
	{
		if ($this->isNew())
		{
			// If the object has been constructed for the purpose, we need to do a select
			$count = $this->reselectThisRow($con) ? 1 : 0;
		}
		else
		{
			// Otherwise, count it as 1
			$count = 1;
		}

		return $count;
	}

	public function countOldVersions(PropelPDO $con = null)
	{
		return $this->countVersions($con) - $this->countNewVersions($con);
	}

	/**
	 * Gets metadata for the current row, plus all previous values
	 * 
	 * @todo Need to write this code
	 * 
	 * Do in one go to avoid race conditions:
	 * 
	 * SELECT * FROM x WHERE (pks) AND
	 *	version = (
	 *		SELECT MAX(version) FROM x WHERE (pks)
	 *	)
	 */
	public function getLatestVersionedRow()
	{
		
	}

	/**
	 * Provides the class with metadata to save with the object
	 * 
	 * @param integer $timeEdited
	 * @param integer $timeReceived
	 * @param integer $timeApplied 
	 */
	public function setVersionMetadata($timeEdited = null, $timeReceived = null,
		$timeApplied = null
	)
	{
		$this->metadataTimeEdited = $timeEdited;
		$this->metadataTimeReceived = $timeReceived;
		$this->metadataTimeApplied = $timeApplied;
	}

	protected function reselectThisRow(PropelPDO $con = null)
	{
		$key = array_merge($this->getPrimaryKey(), array($con));

		return call_user_func_array(array($this->getPeerName(), 'retrieveByPK'), $key);
	}

	protected function getRowName()
	{
		return constant($this->getPeerName() . '::OM_CLASS');
	}

	protected function getPeerName()
	{
		return get_class($this->getPeer());
	}

	protected function getMapName()
	{
		return $this->getRowName() . 'TableMap';
	}

	protected function getVersionableRowName()
	{
		return $this->getRowName() . 'Versionable';
	}

	protected function getVersionablePeerName()
	{
		return $this->getVersionableRowName() . 'Peer';
	}

	protected function getVersionableQueryName()
	{
		return $this->getVersionableRowName() . 'Query';
	}

	protected function getVersionableMapName()
	{
		return $this->getVersionableRowName() . 'TableMap';
	}

	/**
	 * Gets hash of current object, or previous specified version
	 * 
	 * @param PropelPDO $con The integer of the version required
	 * @param integer $version
	 */
	public function getHash(PropelPDO $con = null, $version = null)
	{
		// Initial check (@todo maybe it would be OK to return null here?)
		if ($this->isNew())
		{
			throw new Exception('New rows do not have hashes set');
		}

		$crit = $this->getSelectAllVersionsCriteria();
		$vsnColName = constant($this->getVersionablePeerName() . '::VERSION');

		if (is_null($version))
		{
			// To get the current item, save a select by grabbing the latest version row
			$crit->addDescendingOrderByColumn($vsnColName);
		}
		else
		{
			// Do some checks on the supplied version number
			if ($version < 1)
			{
				throw new Exception('The version number must be 1 or greater');
			}

			$maxVersion = $this->countVersions($con);
			if ($version > $maxVersion)
			{
				throw new Exception('There are not that many versions for this row');
			}

			$crit->add($vsnColName, $version);
		}

		// Grabs the latest/only row depending on above criteria
		$row = call_user_func(
			array($this->getVersionablePeerName(), 'doSelectOne'),
			$crit,
			$con
		);

		return $row->getMeshingHash();
	}

	/**
	 * Calculate hash for this row
	 * 
	 * The hashing strategy is suggested to be thus. Ordinary columns are concatenated
	 * in their table order, and the hashing function applied to the result. However
	 * for selected columns (usually lazy-loaded ones) their value is replaced with
	 * a cached copy of the function applied to that column only. This ensures that
	 * a hash can be re-calculated without having to load lazy-loaded columns, which
	 * may be slow and memory-hungry.
	 * 
	 * So it might look a bit like this:
	 * 
	 *		hash(a + b + c + hash(blob_d) + ...)
	 * 
	 * The cached hashes may be stored either in the same versionable table, or a
	 * parallel table (the former to start with, as it's easier).
	 * 
	 * @author jon
	 */
	public function calcHash($hashFunction)
	{
		/* @var $vsnTableMap TableMap */
		/* @var $hashTableMap TableMap */
		$thisMapName = $this->getMapName();
		$thisTableMap = new $thisMapName();
		$vsnMapName = $this->getVersionableMapName();
		$vsnTableMap = new $vsnMapName();

		/* @var $columnMap ColumnMap */
		$values = array();
		foreach($thisTableMap->getColumns() as $columnMap)
		{
			$columnName = $columnMap->getName();

			// See if a cached hash exists for this column (@todo avoid hard-wired suffix)
			$hashColumnName = $columnName . '_HASH_CACHE';
			$isCached = $vsnTableMap->containsColumn($hashColumnName);

			if ($isCached)
			{
				// Get hash; bomb out if it doesn't exist (even nulls are hashed)
				$hash = $this->getByName($hashColumnName, BasePeer::TYPE_RAW_COLNAME);
				if (!$hash)
				{
					throw new Exception("No hash found for column '$columnName'");
				}
				$value = $hashFunction($hash);
			}
			else
			{
				// Trivial case - just concatenate the column value
				$value = $this->getByName($columnName, BasePeer::TYPE_RAW_COLNAME);		
			}

			$values[] = $value;
		}

		return $hashFunction(implode('', $values));
	}
}
