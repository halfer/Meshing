<?php

/**
 * Space to put in customised methods for node models
 *
 * @author jon
 */
class MeshingBaseObject extends BaseObject
{
	public function postSave(PropelPDO $con = null)
	{
		
	}

	/**
	 * Create a version row after a new row is inserted
	 * 
	 * @param PropelPDO $con 
	 */
	public function postInsert(PropelPDO $con = null)
	{
		
	}

	/**
	 * Create a version row before an existing row is updated
	 * 
	 * Note: if this table is referenced by another table, that 'parent' will be
	 * preUpdated as well - we just intercept that by checking the modified flag
	 * 
	 * @todo Swap out hardwired column for peer constants
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

		// Get max version (@todo deal with race conditions between here and save -
		// maybe just use the database auto-increment system instead?)
		$query = call_user_func(array($this->getVersionableQueryName(), 'create'));
		$maxVersion = $query->
			withColumn('MAX(version)', 'max')->
			select('max')->
			findOne($con);
		$maxVersion = $maxVersion ? $maxVersion : 0;
		
		// @todo Remove these type hints - very handy for development though :)
		/* @var $row TestModelTestOrganiser */
		/* @var $vsn TestModelTestOrganiserVersionable */

		// Create a new versionable
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Save the row state as a version before we commit new values
		$row = $this->reselectThisRow($con);		
		$row->copyInto($vsn);
		$keys = $row->getPrimaryKey();
		$keys[] = $maxVersion + 1;
		$vsn->setPrimaryKey($keys);

		// Complete some metadata
		$vsn->setTimeApplied(time());

		// Let this throw an exception, to be caught higher up
		$vsn->save($con);
			
		return true;
	}

	public function countOldVersions(PropelPDO $con = null)
	{
		// Create a versionable instance
		$vsnName = $this->getVersionableRowName();
		$vsn = new $vsnName();

		// Get the pk criteria for the versionable (fake the version; we throw it away anyway)
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

	public function countVersions(PropelPDO $con = null)
	{
		return $this->countOldVersions($con) + $this->countNewVersions($con);
	}

	protected function reselectThisRow(PropelPDO $con = null)
	{
		return call_user_func_array(
			array($this->getPeerName(), 'retrieveByPK'),
			$this->getPrimaryKey() + array($con)
		);
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
