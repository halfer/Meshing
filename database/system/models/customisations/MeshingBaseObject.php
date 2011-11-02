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
}
