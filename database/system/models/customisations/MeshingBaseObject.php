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
	 * @param PropelPDO $con 
	 */
	public function preUpdate(PropelPDO $con = null)
	{
		// Since we don't currently capture the initial state of the row object,
		// we will (currently) need to select it again before the save.
		
		return true;
	}

	public function countOldVersions(PropelPDO $con = null)
	{
		$rowName = constant($this->getPeerName() . '::OM_CLASS');
		
		// Create a versionable instance
		$vsnName = $rowName . 'Versionable';
		$vsn = new $vsnName();

		// Get the table-qualified name of the version column
		$vsnPeerName = $rowName . 'VersionablePeer';
		$vsnColName = constant($vsnPeerName . '::VERSION');

		// Get the criteria but remove the version col from it
		$crit = $vsn->buildPkeyCriteria();
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
			$row = call_user_func_array(
				array($this->getPeerName(), 'retrieveByPK'),
				$this->getPrimaryKey() + array($con)
			);
			$count = $row ? 1 : 0;
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

	protected function getPeerName()
	{
		return get_class($this->getPeer());
	}
}
