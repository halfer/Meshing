<?php

/**
 * Used to set up a test model
 *
 * @author jon
 */
class Meshing_Test_ModelTestCase extends UnitTestCase
{
	public function setUp()
	{
		$projectRoot = Meshing_Utils::getProjectRoot();
		// if (!model exists)
		// {
		//		do set up
		// }
		
		register_shutdown_function(array($this, 'deleteModel'));
	}

	public function deleteModel()
	{
		// if (model still exists)
		// {
		//		delete model
		// }
	}
}
