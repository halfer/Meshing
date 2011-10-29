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
	 * Initialisation for all tests
	 * 
	 * We're using the constructor rather than setUp() as the latter is called once
	 * per test, and we want an init to be called once for all tests here.
	 */
	public function __construct($label = false)
	{
		parent::__construct($label);
		
		$this->fixedSchemaDir = $this->projectRoot . $this->paths->getPathSchemasNodes();

		$this->deleteFolderContents($this->fixedSchemaDir, 'schema');
	}

	/**
	 * Tests the building of node model class files
	 */
	public function testClassBuilder()
	{
		$package = 'test_model';

		// Convert schema to node format (no class prefix)
		$fixup = new Meshing_Schema_Fixup(
			$this->schemaDir . '/' . $this->schemas,
			$this->fixedSchemaDir . '/' . $this->schemas
		);
		$fixup->fixup($package);

		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->fixedSchemaDir, $this->schemas);
		$task->setOutputDir($this->modelDir);
		$task->run();

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