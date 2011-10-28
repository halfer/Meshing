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
		$paths = Meshing_Utils::getPaths();

		$extraPropsFile = $rt . $paths->getPathDbConfig() . '/build.properties';
		$schemaDir = $rt . $paths->getPathDbConfig();
		$modelDir = $rt . $paths->getPathModelsNodes();

		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($schemaDir, 'test_schema1.xml');
		$task->setOutputDir($modelDir);

		$task->run();
		
		$this->assertTrue(true);
	}
}
