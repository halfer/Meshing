<?php

/**
 * Space to put in customised methods for node models
 *
 * @author jon
 */
class MeshingBaseObject extends BaseObject implements Meshing_Hash_RowInterface
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
	 * @param PropelPDO $con
	 * @return vsnName 
	 */
	protected function createVersionableRow(PropelPDO $con = null)
	{
		// Create a new versionable
		/* @var $vsn TestModelTestOrganiserVersionable */
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Set up a query object
		/* @var $query TestModelTestOrganiserVersionableQuery */
		$query = call_user_func(array($this->getVersionableQueryName(), 'create'));

		// Let's get the primary key names
		/* @var $tableMap TestModelTestOrganiserVersionableTableMap */
		$tableMap = $this->getVersionableMap();
		/* @var $columnMap ColumnMap */
		foreach ($tableMap->getPrimaryKeys() as $columnMap)
		{
			// Include any PK column except for version
			$phpName = $columnMap->getPhpName();
			if ($phpName != 'Version')
			{
				$query->filterBy(
					$phpName,
					$current = $this->getByName($phpName, BasePeer::TYPE_PHPNAME)
				);
			}
		}

		// Get max version
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
		$vsn->setMeshingHash($this->calcHash($con, $hashFunction));

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
	public function getSelectAllVersionsCriteria()
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

	/**
	 * Count number of versions just in the versionable table
	 * 
	 * @todo Suggested optimisation - if old_versions > 1, then new_versions must be 1
	 *			(that will save a select :-)
	 * 
	 * @param PropelPDO $con
	 * @return integer Number of previous versions for this record 
	 */
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

	public function getNumberedVersion($version)
	{
		// Filter out dodgy version numbers
		if ($version < 1)
		{
			throw new Exception('Version numbers must be 1 or greater');
		}

		// Create a versionable instance
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Get the pk criteria for the versionable
		$keys = $this->getPrimaryKey();
		$keys = is_array($keys) ? $keys : array($keys);
		$vsn->setPrimaryKey(array_merge($keys, array($version)));
		$crit = $vsn->buildPkeyCriteria();

		// Do a select
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
		$params = array_merge($this->getPrimaryKey(), array($con));

		return call_user_func_array(array($this->getPeerName(), 'retrieveByPK'), $params);
	}

	public function getRowName()
	{
		return constant($this->getPeerName() . '::OM_CLASS');
	}

	public function getPeerName()
	{
		return get_class($this->getPeer());
	}

	/**
	 * Gets the table map for the row class
	 * 
	 * @return TableMap 
	 */
	public function getRowMap()
	{
		return call_user_func(array($this->getPeerName(), 'getTableMap'));
	}

	public function getVersionableRowName()
	{
		return $this->getRowName() . 'Versionable';
	}

	public function getVersionablePeerName()
	{
		return $this->getVersionableRowName() . 'Peer';
	}

	public function getVersionableQueryName()
	{
		return $this->getVersionableRowName() . 'Query';
	}

	/**
	 * Gets the table map for the version class
	 * 
	 * @return TableMap 
	 */
	public function getVersionableMap()
	{
		return call_user_func(array($this->getVersionablePeerName(), 'getTableMap'));
	}

	/**
	 * Gets hash of current object, or previous specified version
	 * 
	 * @param PropelPDO $con The integer of the version required
	 * @param integer $version
	 * @return string
	 */
	public function getHash(PropelPDO $con, $version = null)
	{
		return $this->getHashProvider($con)->getHash($this, $version);
	}

	/**
	 * Calculate hash for this row
	 * 
	 * @param string $hashFunction
	 */
	public function calcHash(PropelPDO $con, $hashFunction)
	{
		return $this->getHashProvider($con)->calcHash($this, $hashFunction);
	}

	protected static $hashProviders = array();

	/**
	 * Gets an instance of the hashing object
	 * 
	 * It is possible that Meshing will connect to several connections, either in a production
	 * nodeset where several databases are in use, or in testing. To ensure our provider uses
	 * the right connection, we cache hash providers per connection.
	 * 
	 * @staticvar Meshing_Hash_Base $hashProvider
	 * @param PropelPDO $con
	 * @return Meshing_Hash_Base
	 */
	protected function getHashProvider(Meshing_Database_Connection $con)
	{
		$key = (string) $con;
		if (!array_key_exists($key, self::$hashProviders))
		{
			self::$hashProviders[$key] = Meshing_Utils::getPaths()->getHashProvider($con);
		}

		return self::$hashProviders[$key];
	}

	/**
	 * Clears cached hash providers
	 * 
	 * This is only really useful for testing - we wouldn't normally want to mix hash
	 * providers on the one connection
	 */
	public function clearHashProviders()
	{
		self::$hashProviders = array();
	}
}
