<?php

/**
 * Used to set up a database test
 * 
 * Note I've used a _test prefix here to avoid methods being detected by SimpleTest;
 * while they could be made public and without the underscore, but then we'd lose
 * the ability to determine execution order in relation to other test methods in
 * child classes.
 *
 * @author jon
 */
abstract class Meshing_Test_DatabaseTestCase extends UnitTestCase
{
	protected $package;
	
	/**
	 * Initialisation for all tests
	 * 
	 * We're using the constructor rather than setUp() as the latter is called once
	 * per test, and we want an init to be called once for all tests here.
	 */
	public function __construct($package, $label = false)
	{
		parent::__construct($label);
		$this->package = $package;

		$this->projectRoot = realpath(dirname(__FILE__) . '/../../..');
		$this->paths = Meshing_Utils::getPaths();

		$this->schemaDir = $this->projectRoot . $this->paths->getPathTestSchema();
		$this->outputSchemaDir = $this->projectRoot . $this->paths->getPathSchemasNodes() .
			'/' . $package;
		$this->schemas = 'test_schema1.xml';

		$this->modelDir = $this->projectRoot . $this->paths->getPathModelsNodes();
		$this->sqlDir = $this->projectRoot . $this->paths->getPathSqlNodes() .
			'/' . $package;
		$this->connSystemDir = $this->projectRoot . $this->paths->getPathConnsSystem();
		$this->connNodeDir = $this->projectRoot . $this->paths->getPathConnsNodes($package);

		// These all use the package name as a subfolder (the model one is done by Propel)
		$this->deleteFolderContents($this->outputSchemaDir, 'schema');
		$this->deleteFolderContents($this->modelDir . '/' . $package, 'model');
		$this->deleteFolderContents($this->sqlDir, 'sql');
		
		// This is common to all db tests (note also: the system dir contains the node dir)
		$this->deleteFolderContents($this->connSystemDir, 'connections');

		$this->createSchemaDir($this->outputSchemaDir);
	}

	protected function deleteFolderContents($folder, $purpose)
	{
		if (file_exists($folder))
		{
			// Preserve these, they are part of the folder structure
			$preserveList = array('.ignore');
			
			// Delete contents of specified folder
			$directory = new RecursiveDirectoryIterator($folder);
			$iterator = new RecursiveIteratorIterator(
				$directory,
				RecursiveIteratorIterator::CHILD_FIRST
			);
			
			$success = true;
			foreach ($iterator as $path)
			{
				$name = $path->__toString();
				if (!$this->ignoreName($preserveList, $name))
				{
					$success = ($path->isDir() ? @rmdir($name) : @unlink($name)) && $success;
				}
			}

			if (!$success)
			{
				trigger_error(
					"Failed to delete contents of $purpose folder",
					E_USER_WARNING
				);
			}
		}
	}

	protected function ignoreName(array $ignoreList, $path)
	{
		$match = false;
		foreach ($ignoreList as $ignore)
		{
			$match = preg_match("/$ignore\$/", $path);
			if ($match)
			{
				break;
			}
		}
		
		return (boolean) $match;
	}
	
	protected function classExists($model, $package, $prefix = '')
	{
		return file_exists(
			$this->modelDir . '/' . $package . '/' . $prefix . $model . '.php'
		);
	}

	protected function createSchemaDir($schemaDir)
	{
		if (!file_exists($schemaDir))
		{
			$success = @mkdir($schemaDir);
			if (!$success)
			{
				trigger_error('Could not create schema folder', E_USER_WARNING);
			}
		}
	}

	protected function doFixup($package = null, $tablePrefix = null)
	{
		// Convert schema to node format (no class prefix)
		$fixup = new Meshing_Schema_Fixup(
			$this->schemaDir . '/' . $this->schemas,
			$this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema()
		);
		$fixup->setBaseClass($this->getBaseClass());
		$fixup->setBasePeer($this->getBasePeer());
		$fixup->fixup($package ? $package : $this->getPackage(), $tablePrefix);
	}

	protected function getBaseClass()
	{
		return 'MeshingBaseObject';
	}

	protected function getBasePeer()
	{
		return 'MeshingBasePeer';
	}

	/**
	 * Tests to build model classes, and optionally to test that build
	 * 
	 * @param string $prefix
	 * @param boolean $runTests 
	 */
	protected function _testClassBuilder($prefix = null, $runTests = true)
	{
		$task = new Meshing_Propel_ClassBuilder();
		$task->setPropelConnection(Meshing_Utils::CONN_NODE_TEST_1);
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
		$task->setOutputDir($this->modelDir);
		$task->run();

		// Find these classes
		if ($runTests)
		{
			$package = $this->getPackage();
			foreach ($this->expectedClasses() as $class)
			{
				foreach (array('', 'Peer', 'Query') as $classSuffix)
				{
					$this->assertTrue(
						$this->classExists($class . $classSuffix, $package, $prefix),
						'Checking generated class `' . $class . $classSuffix . '` exists'
					);
				}
			}
		}
	}

	/**
	 * This is the basic list of expected classes
	 * 
	 * @return array
	 */
	protected function expectedClasses()
	{
		return array(
			'TestEvent', 'TestOrganiser',
		);
	}

	/**
	 * Generates SQL from a schema, and optionally tests it
	 */
	protected function _testSqlBuilder($runTests = true)
	{
		$task = new Meshing_Propel_SqlBuilder();
		$task->setPropelConnection(Meshing_Utils::CONN_NODE_TEST_1);
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
		$task->setOutputDir($this->sqlDir);
		$task->run();

		if ($runTests)
		{
			$this->assertTrue(
				file_exists($this->sqlDir . '/schema.sql'),
				'Checking generated SQL exists'
			);
		}
	}

	/**
	 * Runs generated SQL against the configured db
	 */
	protected function _testSqlRunner($runTests = true, $conName = Meshing_Utils::CONN_NODE_TEST_1)
	{
		$mapFile = $this->projectRoot . $this->paths->getFileDbMap();
		
		$task = new Meshing_Propel_SqlRunner();
		$task->setSqlDir($this->sqlDir);
		$task->setMapFile($mapFile);
		$task->setPropelConnection($conName);

		try
		{
			$task->run();
		}
		catch (BuildException $e)
		{
			echo "Error running SQL file, check build properties (map: " . $this->paths->getFileDbMap() . ")\n";
			exit();
		}

		// No tests here at the moment - we'll connect to test db later
		if ($runTests)
		{
			
		}
	}

	/**
	 * Build runtime configuration files, optionally testing them
	 * 
	 * @param type $runTests 
	 */
	protected function _testConfBuilder($runTests = true)
	{
		$xmlFile = $this->projectRoot . $this->paths->getFileRuntimeXml();
		$outputFile = $this->paths->getLeafRuntimePhp();

		$task = new Meshing_Propel_ConfBuilder();
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
		$task->setXmlFile($xmlFile);
		$task->setOutputDir($this->connNodeDir);
		$task->setOutputFile($outputFile);
		$task->setPropelConnection(Meshing_Utils::CONN_NODE_TEST_1);
		$task->run();

		if ($runTests)
		{
			$this->assertTrue(
				file_exists($this->connNodeDir . '/' . $outputFile),
				'Check connections file has been generated'
			);

			$this->assertTrue(
				file_exists($this->connNodeDir . '/classmap-' . $outputFile),
				'Check classmap file has been generated'
			);
		}
	}

	protected function getPackage()
	{
		return $this->package;
	}

	/**
	 * Initialise the test system and test node databases
	 * 
	 * Can't init the test node db in the constructor, since the conf file may not be created
	 */
	protected function initConnections()
	{
		Meshing_Utils::initialiseDb($testMode = true);
		Meshing_Utils::initialiseNodeDbs($this->package, $testMode);
		$this->conSystem = Propel::getConnection(Meshing_Utils::CONN_SYSTEM_TEST);
		$this->conNode = Propel::getConnection(Meshing_Utils::CONN_NODE_TEST_1);
	}

	/**
	 * Creates a new KnownNode for node models
	 * 
	 * @param PropelPDO $con PDO connection object
	 * @return TestModelKnownNode 
	 */
	protected function createKnownNode(BaseObject $node, PropelPDO $con = null)
	{
		$this->initConnections();

		// Look up schema, and create an empty one if required
		$schema = MeshingSchemaQuery::create()->
			findOneByName($this->package, $this->conSystem);
		if (!$schema)
		{
			$schema = new MeshingSchema();
			$schema->setName($this->package);
			$schema->setInstalledAt(time());
			$schema->save($this->conSystem);
		}

		/* @var $node TestModelKnownNode */
		$node->setName('Us!');
		$node->setFqdn('http://example.com/path');
		$node->setSchemaId($schema->getId());
		$node->save($con);

		return $node;
	}
}
