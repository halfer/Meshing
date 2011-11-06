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
		$tableName = constant($this->getPeerName() . '::TABLE_NAME');
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
		$tableName = constant($this->getPeerName() . '::TABLE_NAME');
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

		// Get max version (@todo deal with race conditions between here and save -
		// maybe just use the database auto-increment system instead?)
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

	public function countVersions(PropelPDO $con = null)
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

		// Then count the number of rows
		$count = call_user_func(
			array($vsnPeerName, 'doCount'),
			$crit,
			$_distinct = false,
			$con
		);
		
		return $count;
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

	protected function getPeerName()
	{
		return get_class($this->getPeer());
	}

	protected function getRowName()
	{
		return constant($this->getPeerName() . '::OM_CLASS');
	}

	protected function getVersionableRowName()
	{
		return $this->getRowName() . 'Versionable';
	}

	protected function getVersionablePeerName()
	{
		return $this->getRowName() . 'VersionablePeer';
	}

	protected function getVersionableQueryName()
	{
		return $this->getRowName() . 'VersionableQuery';
	}
}
