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
	/**
	 * Initialisation for all tests
	 * 
	 * We're using the constructor rather than setUp() as the latter is called once
	 * per test, and we want an init to be called once for all tests here.
	 */
	public function __construct($label = false)
	{
		parent::__construct($label);

		$this->projectRoot = realpath(dirname(__FILE__) . '/../../..');
		$this->paths = Meshing_Utils::getPaths();
		$this->schemaDir = $this->projectRoot . $this->paths->getPathDbConfig();
		$this->extraPropsFile = $this->projectRoot . $this->paths->getPathDbConfig() .
			'/build.properties';
		$this->modelDir = $this->projectRoot . $this->paths->getPathModelsNodes();
		$this->sqlDir = $this->projectRoot . $this->paths->getPathSqlSystem();
		$this->connDir = $this->projectRoot . $this->paths->getPathConnsSystem();
		
		$this->schemas = 'test_schema1.xml';

		$this->deleteFolderContents($this->modelDir, 'model');
		$this->deleteFolderContents($this->sqlDir, 'sql');
		$this->deleteFolderContents($this->connDir, 'connections');
	}

	protected function deleteFolderContents($folder, $purpose)
	{
		if (file_exists($folder))
		{
			// @todo Convert this to PHP, so as to avoid OS-specific call
			$isWindows = (
				(PHP_OS == 'WIN32') ||
				(PHP_OS == 'WINNT') ||
				(PHP_OS == 'Windows')
			);
			if (!$isWindows)
			{
				$command = 'rm -rf ' . $folder . '/*';
				$return = null;
				@system($command, $return);
				if ($return)
				{
					trigger_error(
						"Failed to delete contents of $purpose folder",
						E_USER_WARNING
					);
				}
			}
		}		
	}

	/**
	 * Tests the building of model class files
	 */
	public function testClassBuilder()
	{
		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->schemaDir, $this->schemas);
		$task->setOutputDir($this->modelDir);
		$task->run();

		$this->package = 'test-db';

		// Find these classes
		$classes = array(
			'Event', 'EventPeer', 'EventQuery', 'Organiser', 'OrganiserPeer', 'OrganiserQuery'
		);
		foreach ($classes as $class)
		{
			$this->assertTrue(
				$this->classExists('MeshingTest' . $class),
				'Checking generated class `' . $class . '` exists'
			);
		}
	}

	protected function classExists($model)
	{
		return file_exists(
			$this->modelDir . '/' . $this->package . '/' . $model . '.php'
		);
	}

	/**
	 * Tests the building of generated SQL
	 */
	public function testSqlBuilder()
	{
		$task = new Meshing_Propel_SqlBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->schemaDir, $this->schemas);
		$task->setOutputDir($this->sqlDir);
		$task->run();
		
		$this->assertTrue(
			file_exists($this->sqlDir . '/schema.sql'),
			'Checking generated SQL exists'
		);
	}

	/**
	 * Runs generated SQL against the configured db
	 */
	public function testSqlRunner()
	{
		$mapFile = $this->projectRoot . $this->paths->getFileDbMap();
		
		$task = new Meshing_Propel_SqlRunner();
		$task->setSqlDir($this->sqlDir);
		$task->setMapFile($mapFile);
		$task->addPropertiesFile($this->extraPropsFile);

		$task->run();
		
		// No tests here at the moment - we'll connect to test db later
	}

	public function testConfBuilder()
	{
		$xmlFile = $this->projectRoot . $this->paths->getFileRuntimeXml();
		$outputFile = $this->paths->getLeafRuntimePhp();

		$task = new Meshing_Propel_ConfBuilder();
		$task->addSchemas($this->schemaDir, $this->schemas);
		$task->setXmlFile($xmlFile);
		$task->setOutputDir($this->connDir);
		$task->setOutputFile($outputFile);
		$task->addPropertiesFile($this->extraPropsFile);
		$task->run();
		
		$this->assertTrue(
			file_exists($this->connDir . '/' . $outputFile),
			'Check connections file has been generated'
		);
		
		$this->assertTrue(
			file_exists($this->connDir . '/classmap-' . $outputFile),
			'Check classmap file has been generated'
		);
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
