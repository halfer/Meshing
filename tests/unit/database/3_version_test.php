<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class PropelVersionTestCase extends Meshing_Test_DatabaseTestCase
{
	public function __construct($label = false)
	{
		// Same package name as test 2
		parent::__construct('test_model', $label);
		
		// Clear db away from previous tests
		$this->doFixup();
		$this->_testClassBuilder("TestModel", $runTests = false);
		$this->_testSqlBuilder($runTests);
		$this->_testConfBuilder($runTests);
		$this->_testSqlRunner($runTests);
	}

	public function testVersion()
	{
		Meshing_Utils::initialiseDb();
		$con = Propel::getConnection('test');

		// Create an entry to satisfy later constraints
		$node = $this->createKnownNode($con);

		try
		{
			$organiser = new TestModelMeshingTestOrganiser();
			$organiser->setCreatorNodeId($node->getPrimaryKey());
			$organiser->setName($orgName = 'Mr. Badger');
			$organiser->save($con);
			$ok = true;
		}
		catch (Exception $e)
		{
			$ok = false;
		}
		
		// @todo Add some versioning tests here
	}
}