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
	public function __construct($label = false)
	{
		parent::__construct('test_model', $label);
	}

	/**
	 * Tests the building of node model class files
	 */
	public function testClassBuilder()
	{
		// Convert schema to node format (no class prefix)
		$fixup = new Meshing_Schema_Fixup(
			$this->schemaDir . '/' . $this->schemas,
			$this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema()
		);
		$fixup->fixup($this->getPackage());

		// Do generation of classes and all checking
		$this->_testClassBuilder('TestModel');
	}

	/**
	 * This is an extended list of expected classes
	 * 
	 * @return array
	 */
	protected function expectedClasses()
	{
		return parent::expectedClasses() +
			array(
				'KnownNode', 'MeshingIdentity',
				'MeshingTestEventVersionable', 'MeshingTestOrganiserVersionable'
			);
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

	/**
	 * Test fixed-up models
	 * 
	 * The fixup process removes the db connection from the schema, so we need to
	 * manually specify it here.
	 */
	public function testModels()
	{
		Meshing_Utils::initialiseDb();
		$con = Propel::getConnection('test');

		// Create an entry to satisfy later constraints
		$node = new TestModelKnownNode();
		$node->setName('Us!');
		$node->save($con);
		$nodeId = $node->getPrimaryKey();

		try
		{
			$organiser = new TestModelMeshingTestOrganiser();
			$organiser->setCreatorNodeId($nodeId);
			$organiser->setName($orgName = 'Mr. Badger');

			$event = new TestModelMeshingTestEvent();
			$event->setCreatorNodeId($nodeId);
			$event->setName($eventName = 'Expert Burrowing In The Built Environment');
			$event->setTestModelMeshingTestOrganiser($organiser);
			$event->save($con);
			$ok = true;
		}
		catch (Exception $e)
		{
			// @todo Remove this temporary error reporting
			echo 'Error: ' . $e->getMessage() . "\n";
			$ok = false;
		}
		
		$this->assertTrue($ok, 'Save some rows to the test model');

		// Check they have been written okay
		$organiser = TestModelMeshingTestOrganiserQuery::create()->
			findOneByName($orgName, $con);
		$event = TestModelMeshingTestEventQuery::create()->
			findOneByName($eventName, $con);
		$this->assertTrue(
			($organiser instanceof TestModelMeshingTestOrganiser) &&
			($event instanceof TestModelMeshingTestEvent),
			'Retrieve rows from the database'
		);
	}
}