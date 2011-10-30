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
	 * Tests the building of standard model class files
	 */
	public function testClassBuilder()
	{
		$package = 'test_propel';
		$this->setPackage($package);

		// Copy schema and reset package name
		$xml = simplexml_load_file(
			$this->schemaDir . '/' . $this->schemas,
			'Meshing_Schema_Element'
		);
		$xml->setPackageName($package);
		$xml->asXml($this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema());
		
		// Do generation of classes and all checking
		$this->_testClassBuilder($package);
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
