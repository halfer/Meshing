<?php

/**
 * Description of Build
 *
 * @author jon
 */
class Meshing_Console_Command_System_Build extends Meshing_Console_Command_Connection_Base implements Meshing_Console_Interface
{
	private $projectRoot;

	public function getDescription()
	{
		return 'Builds the models and/or the database for the whole nodeset';
	}

	public function getOpts()
	{
		return array(
			'classes|c' => '(Re)build the system model classes',
			'database|d' => '(Re)build the system database',
			'verbose|v' => 'Print out information about the build',
		);
	}

	public function preRunCheck()
	{
		// Check that at least one of the options has been provided
		if (!$this->opts->classes && !$this->opts->database) {
			throw new Zend_Console_Getopt_Exception('Nothing to do.');
		}
	}

	public function run()
	{
		$this->projectRoot = Meshing_Utils::getProjectRoot();

		$verbose = $this->opts->verbose;
		if ($verbose)
		{
			echo "Generating... ";
		}

		// @todo Move this to a hidden developer command
		if ($this->opts->classes)
		{
			$this->buildModel($verbose);
		}
		
		if ($this->opts->database)
		{
			$this->buildDatabase($verbose);
			$this->runFixtures($verbose);
		}

		// @todo Need to build model-only for schema-node.xml
		// @todo Move this to a hidden developer command
	}

	/**
	 * Generates the system model
	 * 
	 * @todo Move the paths to the build.properties file
	 * 
	 * @param boolean $verbose 
	 */
	protected function buildModel($verbose)
	{
		// Set db type, schema and output folder here
		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() .
			'/build.properties';
		$schemaDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig();
		$schemas = 'schema.xml';
		$outputDir = $this->projectRoot . Meshing_Paths::PATH_MODELS_SYSTEM;

		// Create task, configure, then run
		$task = new Meshing_Propel_ClassBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($schemaDir, $schemas);
		$task->setOutputDir($outputDir);

		$task->run();
		
		if ($verbose)
		{
			echo "done\n";
			echo "Schemas: " . $schemaDir . "\n";
			echo "Output: " . $outputDir . "\n";
		}
	}

	/**
	 * Builds the SQL for the system database, and runs it (deletes the existing system tables)
	 * 
	 * @todo Move the paths to the build.properties file
	 * 
	 * @param boolean $verbose 
	 */
	protected function buildDatabase($verbose)
	{
		$this->buildSql($verbose);
		$this->runSql($verbose);
		$this->buildConnections($sys = true, $nonSys = false, !$verbose);

		// @todo More detail required here
		if ($verbose)
		{
			echo "done\n";			
		}
	}

	/**
	 * Builds the SQL for the system database (doesn't touch the db)
	 * 
	 * @todo Move the paths to the build.properties file
	 * 
	 * @param boolean $verbose 
	 */
	protected function buildSql($verbose)
	{
		$schemaDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig();
		$schemas = "schema.xml";
		$outputDir = $this->projectRoot . Meshing_Paths::PATH_SQL_SYSTEM;
		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() . '/build.properties';

		// Create task, configure, then run
		$task = new Meshing_Propel_SqlBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($schemaDir, $schemas);
		$task->setOutputDir($outputDir);

		$task->run();		
	}

	/**
	 * Runs the already-built SQL for the system db (deletes the existing system tables)
	 * 
	 * @todo Move the paths to the build.properties file
	 * 
	 * @param boolean $verbose 
	 */
	protected function runSql($verbose)
	{
		$sqlDir = $this->projectRoot . Meshing_Paths::PATH_SQL_SYSTEM;
		$mapFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() . '/sqldb.map';
		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() . '/build.properties';

		$task = new Meshing_Propel_SqlRunner();

		$task->setSqlDir($sqlDir);
		$task->setMapFile($mapFile);
		$task->addPropertiesFile($extraPropsFile);

		$task->run();		
	}

	protected function runFixtures($verbose)
	{
		$fixturesFile = $this->projectRoot . Meshing_Paths::PATH_SYSTEM_FIXTURES . '/fixtures.php';
		if (file_exists($fixturesFile))
		{
			$runner = new Meshing_Propel_FixturesRunner($fixturesFile);
			$runner->run();
		}
	}
}
