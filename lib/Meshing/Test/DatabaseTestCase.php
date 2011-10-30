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

		$this->schemaDir = $this->projectRoot . $this->paths->getPathDbConfig();
		$this->outputSchemaDir = $this->projectRoot . $this->paths->getPathSchemasNodes() .
			'/' . $package;
		$this->schemas = 'test_schema1.xml';

		$this->extraPropsFile = $this->projectRoot . $this->paths->getPathDbConfig() .
			'/build.properties';
		$this->modelDir = $this->projectRoot . $this->paths->getPathModelsNodes();
		$this->sqlDir = $this->projectRoot . $this->paths->getPathSqlNodes() .
			'/' . $package;
		$this->connDir = $this->projectRoot . $this->paths->getPathConnsSystem();

		// These all use the package name as a subfolder
		$this->deleteFolderContents($this->outputSchemaDir, 'schema');
		$this->deleteFolderContents($this->modelDir . '/' . $package, 'model');
		$this->deleteFolderContents($this->sqlDir, 'sql');
		
		// This is common to all db tests
		$this->deleteFolderContents($this->connDir, 'connections');

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

	protected function _testClassBuilder($prefix = null)
	{
		$task = new Meshing_Propel_ClassBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
		$task->setOutputDir($this->modelDir);
		$task->run();

		// Find these classes
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

	/**
	 * This is the basic list of expected classes
	 * 
	 * @return array
	 */
	protected function expectedClasses()
	{
		return array(
			'MeshingTestEvent', 'MeshingTestOrganiser',
		);
	}

	/**
	 * Tests the building of generated SQL
	 */
	protected function _testSqlBuilder()
	{
		$task = new Meshing_Propel_SqlBuilder();
		$task->addPropertiesFile($this->extraPropsFile);
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
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
	protected function _testSqlRunner()
	{
		$mapFile = $this->projectRoot . $this->paths->getFileDbMap();
		
		$task = new Meshing_Propel_SqlRunner();
		$task->setSqlDir($this->sqlDir);
		$task->setMapFile($mapFile);
		$task->addPropertiesFile($this->extraPropsFile);

		$task->run();
		
		// No tests here at the moment - we'll connect to test db later
	}

	protected function _testConfBuilder()
	{
		$xmlFile = $this->projectRoot . $this->paths->getFileRuntimeXml();
		$outputFile = $this->paths->getLeafRuntimePhp();

		$task = new Meshing_Propel_ConfBuilder();
		$task->addSchemas($this->outputSchemaDir, $this->paths->getLeafStandardSchema());
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

	protected function getPackage()
	{
		return $this->package;
	}
}
