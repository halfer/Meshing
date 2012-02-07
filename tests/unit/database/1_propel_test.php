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
	public function __construct($label = false)
	{
		parent::__construct('test_propel', $label);
	}

	/**
	 * Tests the building of standard model class files
	 */
	public function testClassBuilder()
	{
		// Copy schema and reset package name
		$xml = simplexml_load_file(
			$this->schemaDir . '/' . $this->schemas,
			'Meshing_Schema_Element'
		);
		$xml->setPackageName($this->getPackage());

		// Reset the default connection to anything known. We won't use this, but it's a
		// good idea as Propel bombs out if the connection cannot be found, even if it is
		// always accessed via a specified connection. This is also part of the Fixup
		// process, but we're not using that here.
		$xml->setConnectionName(Meshing_Utils::SYSTEM_CONNECTION);

		$xml->asXml($this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema());
		
		// Do generation of classes and all checking
		$this->_testClassBuilder();
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
		$this->initConnections();

		try
		{
			$organiser = new TestOrganiser();
			$organiser->setName($orgName = 'Mr. Badger');

			$event = new TestEvent();
			$event->setName($eventName = 'Expert Burrowing In The Built Environment');
			$event->setTestOrganiser($organiser);
			$event->save($this->conNode);
			$ok = true;
		}
		catch (Exception $e)
		{
			$ok = false;
		}
		
		$this->assertTrue($ok, 'Save some rows to the test model');

		// Check they have been written okay
		$organiser = TestOrganiserQuery::create()->
			findOneByName($orgName, $this->conNode);
		$event = TestEventQuery::create()->
			findOneByName($eventName, $this->conNode);
		$this->assertTrue(
			($organiser instanceof TestOrganiser) &&
			($event instanceof TestEvent),
			'Retrieve rows from the database'
		);
	}
}
