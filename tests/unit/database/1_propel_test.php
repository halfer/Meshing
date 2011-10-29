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
class PropelGeneralTestCase extends Meshing_Test_DatabaseTestCase
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
	}

	/**
	 * Tests the building of standard model class files
	 */
	public function testClassBuilder()
	{
		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->schemaDir, $this->schemas);
		$task->setOutputDir($this->modelDir);
		$task->run();

		// @todo Use Meshing_Schema_Element to force the package name, remove it from the test schema
		$package = 'test_propel';

		// Find these classes
		$classes = array(
			'MeshingTestEvent', 'MeshingTestEventPeer', 'MeshingTestEventQuery',
			'MeshingTestOrganiser', 'MeshingTestOrganiserPeer', 'MeshingTestOrganiserQuery'
		);
		foreach ($classes as $class)
		{
			$this->assertTrue(
				$this->classExists($class, $package),
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
		Meshing_Utils::initialiseDb();
		
		try
		{
			$organiser = new MeshingTestOrganiser();
			$organiser->setName($orgName = 'Mr. Badger');

			$event = new MeshingTestEvent();
			$event->setName($eventName = 'Expert Burrowing In The Built Environment');
			$event->setMeshingTestOrganiser($organiser);
			$event->save();
			$ok = true;
		}
		catch (Exception $e)
		{
			$ok = false;
		}
		
		$this->assertTrue($ok, 'Save some rows to the test model');

		// Check they have been written okay
		$organiser = MeshingTestOrganiserQuery::create()->
			findOneByName($orgName);
		$event = MeshingTestEventQuery::create()->
			findOneByName($eventName);
		$this->assertTrue(
			($organiser instanceof MeshingTestOrganiser) &&
			($event instanceof MeshingTestEvent),
			'Retrieve rows from the database'
		);
	}
}
