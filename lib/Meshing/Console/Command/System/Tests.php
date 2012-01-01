<?php

/**
 * Description of Tests
 *
 * @author jon
 */
class Meshing_Console_Command_System_Tests extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Runs the specified unit tests for Meshing';
	}

	public function getOpts()
	{
	}

	public function preRunCheck()
	{
		if (array_key_exists(0, $this->argv))
		{
			$path = '/' . $this->argv[0];
		}
		else
		{
			$path = '';
		}

		// Add the path to the standard test directory location
		$this->testDir = Meshing_Utils::getProjectRoot() .
			Meshing_Utils::getPaths()->getPathSystemTests() . $path;

		if (!is_dir($this->testDir) && !is_file($this->testDir))
		{
			throw new Meshing_Console_RunException(
				'That location does not resolve to a test or a test folder'
			);
		}
	}

	/**
	 * Tests either a single file or a directory full of 'em
	 */
	public function run()
	{
		$this->buildTestSystemDatabase();

		if (is_file($this->testDir))
		{
			require_once $this->testDir;
		}
		else
		{
			$this->testAll($this->testDir);
		}
	}

	/**
	 * Builds a system db for the test environment
	 * 
	 * @todo This replicates some code in Command/System/Build - needs to be much more DRY
	 */
	protected function buildTestSystemDatabase()
	{
		// Load the Meshing_Test_Paths class
		$projectRoot = Meshing_Utils::getProjectRoot();
		require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
		Meshing_Utils::reinitialise(new Meshing_Test_Paths());

		$paths = Meshing_Utils::getPaths();

		// Build a system connection file
		$task = new Meshing_Propel_ConfBuilder();
		$task->addSchemas(
			$projectRoot . $paths->getPathDbConfig(),
			$paths->getLeafStandardSchema()
		);
		$task->setXmlFile($projectRoot . $paths->getFileRuntimeXml());
		$task->setPropelConnection(Meshing_Utils::CONN_SYSTEM_TEST);
		$task->setOutputDir($projectRoot . $paths->getPathConnsSystem());
		$task->setOutputFile($paths->getLeafRuntimePhp());
		$task->run();

		// Build the SQL for a test system database
		$task = new Meshing_Propel_SqlBuilder();
		$task->addSchemas(
			$projectRoot . $paths->getPathDbConfig(),
			$paths->getLeafStandardSchema()
		);
		$task->setOutputDir($projectRoot . $paths->getPathSqlSystem());
		$task->setPropelConnection(Meshing_Utils::CONN_SYSTEM_TEST);
		$task->run();

		// Run the sql
		$task = new Meshing_Propel_SqlRunner();
		$task->setSqlDir($projectRoot . $paths->getPathSqlSystem());
		$task->setMapFile($projectRoot . $paths->getFileDbMap());
		$task->setPropelConnection(Meshing_Utils::CONN_SYSTEM_TEST);
		$task->run();
	}

	public function testAll($testDir)
	{
		// Iterate across this dir for files matching *_test.php
		$directory = new RecursiveDirectoryIterator($testDir);
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator(
			$iterator, '/^.+_test\.php$/i',
			RecursiveRegexIterator::GET_MATCH
		);
		$regex->next();

		while ($regex->valid())
		{
			$item = $regex->current();
			require_once $item[0];

			$regex->next();
		}
	}

	public function isHiddenCommand()
	{
		return true;
	}
}
