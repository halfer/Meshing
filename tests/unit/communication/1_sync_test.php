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
 * Tests the communication systems between nodes
 *
 * @author jon
 */
class BasicSyncTestCase extends Meshing_Test_ModelTestCase
{
	public function __construct($label = false)
	{
		// This creates the system db and one node
		parent::__construct('test_model', $label);

		// This creates a copy of the same node on a second test connection
		$this->_testSqlRunner($runTests = false, $conName = Meshing_Utils::CONN_NODE_TEST_2);
		$this->conNode2 = Propel::getConnection(Meshing_Utils::CONN_NODE_TEST_2);
	
		// Set up a known node for the first node
		Meshing_Utils::initialiseNodeDbs('test_model');
		$this->node1 = $this->createKnownNode(new TestModelKnownNode(), $this->conNode);
	}

	/**
	 * Testing syncing node 1 containing a few rows with node 2, which is empty 
	 */
	public function testSimpleSync1()
	{
		// Set up data in node 1
		$fixtures = $this->projectRoot . Meshing_Utils::getPaths()->getFixturesPath();
		$data = require_once( $fixtures . '/simpleSync1.php' );
		$dbUtils = new Meshing_Database_Utils();
		$dbUtils->writeVersionableData($data, $this->node1, $this->conNode);

		// @todo Sync data into node 2 here :)
	}
}
