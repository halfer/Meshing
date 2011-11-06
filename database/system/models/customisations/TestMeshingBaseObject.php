<?php

/**
 * Space to put in customised methods for test node models
 *
 * @author jon
 */
class TestMeshingBaseObject extends MeshingBaseObject
{
	/**
	 * Hook called before version save
	 * 
	 * @param BaseObject $vsn
	 * @param boolean $update
	 */
	protected function _preVersionSave(BaseObject $vsn, $update)
	{
		// Ignore inserts
		if (!$update)
		{
			return;
		}

		// Encourage race condition between MAX() and INSERT
		sleep(1);
	}
}