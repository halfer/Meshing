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
		$this->doFixup();

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
				'TestEventVersionable', 'TestOrganiserVersionable'
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
		$this->initConnections();

		// Create an entry to satisfy later constraints
		$node = $this->createKnownNode(new TestModelKnownNode(), $this->conNode);

		try
		{
			$organiser = new TestModelTestOrganiser();
			$organiser->setCreatorNodeId($node->getPrimaryKey());
			$organiser->setName($orgName = 'Mr. Badger');

			$event = new TestModelTestEvent();
			$event->setCreatorNodeId($node->getPrimaryKey());
			$event->setName($eventName = 'Expert Burrowing In The Built Environment');
			$event->setTestModelTestOrganiser($organiser);
			$event->save($this->conNode);
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
		$organiser = TestModelTestOrganiserQuery::create()->
			findOneByName($orgName, $this->conNode);
		$event = TestModelTestEventQuery::create()->
			findOneByName($eventName, $this->conNode);
		$this->assertTrue(
			($organiser instanceof TestModelTestOrganiser) &&
			($event instanceof TestModelTestEvent),
			'Retrieve rows from the database'
		);
	}
}