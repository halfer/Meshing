<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class PropelModelTestCase extends Meshing_Test_DatabaseTestCase
{
	/**
	 * Tests the building of node model class files
	 */
	public function testClassBuilder()
	{
		$package = 'test_model';
		$this->outputSchemaDir .= '/' . $package;
		
		if (!file_exists($this->outputSchemaDir))
		{
			$success = @mkdir($this->outputSchemaDir);
			if (!$success)
			{
				trigger_error('Could not create schema folder', E_USER_WARNING);
			}
		}

		// Convert schema to node format (no class prefix)
		$fixup = new Meshing_Schema_Fixup(
			$this->schemaDir . '/' . $this->schemas,
			$this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema()
		);
		$fixup->fixup($package);

		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
		$task->setOutputDir($this->modelDir);
		$task->run();
		
		// @todo More classes to add here
		// Find these classes
		$classes = array(
			'Event', 'EventPeer', 'EventQuery', 'Organiser', 'OrganiserPeer', 'OrganiserQuery'
		);
		foreach ($classes as $class)
		{
			$this->assertTrue(
				$this->classExists('MeshingTest' . $class, $package, 'TestModel'),
				'Checking generated class `' . $class . '` exists'
			);
		}
	}

	/**
	 * Tests the building of generated SQL
	 */
	public function testSqlBuilder()
	{
		$this->_testSqlBuilder();
	}

	/**
	 * Runs generated SQL against the configured db
	 */
	public function testSqlRunner()
	{
		$this->_testSqlRunner();
	}

	public function testConfBuilder()
	{
		$this->_testConfBuilder();
	}

	public function testModels()
	{
	}
}