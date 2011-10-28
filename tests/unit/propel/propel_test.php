<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

/**
 * Tests Meshing_Propel_* classes
 *
 * @author jon
 */
class PropelGeneralTestCase extends UnitTestCase
{
	public function setUp()
	{
		$this->projectRoot = realpath(dirname(__FILE__) . '/../../..');
		$this->paths = Meshing_Utils::getPaths();
		$this->modelDir = $this->projectRoot . $this->paths->getPathModelsNodes();

		// Delete anything in the model folder
		if (file_exists($this->modelDir))
		{
			// @todo Convert this to PHP, so as to avoid OS-specific call
			$isWindows = (
				(PHP_OS == 'WIN32') ||
				(PHP_OS == 'WINNT') ||
				(PHP_OS == 'Windows')
			);
			if (!$isWindows)
			{
				$command = 'rm -rf ' . $this->modelDir . '/*';
				$return = null;
				@system($command, $return);
				if ($return)
				{
					trigger_error('Failed to delete model folder', E_USER_WARNING);
				}
			}
		}
	}

	/**
	 * Start of tests for building model class files
	 * 
	 * @todo Can we control the package name? Would be good to turn that off here
	 * @todo Add some actual tests :)
	 */
	public function testClassBuilder()
	{
		$rt = $this->projectRoot;

		$extraPropsFile = $rt . $this->paths->getPathDbConfig() . '/build.properties';
		$schemaDir = $rt . $this->paths->getPathDbConfig();

		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($schemaDir, 'test_schema1.xml');
		$task->setOutputDir($this->modelDir);
		$task->run();

		$this->package = 'test-db';

		// Find these classes
		$classes = array(
			'Event', 'EventPeer', 'EventQuery', 'Organiser', 'OrganiserPeer', 'OrganiserQuery'
		);
		foreach ($classes as $class)
		{
			$this->assertTrue(
				$this->classExists($class),
				'Checking generated class `' . $class . '` exists'
			);
		}
	}

	protected function classExists($model)
	{
		return file_exists(
			$this->modelDir . '/' . $this->package . '/' . $model . '.php'
		);
	}
}
