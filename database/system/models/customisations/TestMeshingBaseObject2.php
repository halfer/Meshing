<?php

/**
 * Space to put in customised methods for test node models
 *
 * @author jon
 */
class TestMeshingBaseObject2 extends MeshingBaseObject
{
	/**
	 * Permits us to call a protected method for test purposes
	 * 
	 * @param PropelPDO $con
	 * @return mixed
	 */
	public function callCreateVersionableRow(PropelPDO $con = null)
	{
		return $this->createVersionableRow($con);
	}
}