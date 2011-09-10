<?php

/**
 * Description of Build
 *
 * @author jon
 */
class P2P_Console_Command_System_Build extends P2P_Console_Base implements P2P_Console_Interface
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
		$this->projectRoot = P2P_Utils::getProjectRoot();

		$verbose = $this->opts->verbose;
		if ($verbose)
		{
			echo "Generating... ";
		}

		if ($this->opts->classes)
		{
			$this->buildModel($verbose);
		}
		
		if ($this->opts->database)
		{
			$this->buildDatabase($verbose);
		}
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
		$extraPropsFile = $this->projectRoot . '/database/system/build.properties';
		$schemaDir = $this->projectRoot . '/database/system';
		$schemas = 'schema.xml';
		$outputDir = $this->projectRoot . "/database/models";

		// Create task, configure, then run
		$task = new P2P_Propel_ClassBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->setSchemaDir($schemaDir);
		$task->setSchemas($schemas);
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
		$this->buildConnections($verbose);

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
		$schemaDir = $this->projectRoot . '/database/system';
		$schemas = "schema.xml";
		$outputDir = $this->projectRoot . "/database/sql/system";
		$extraPropsFile = $this->projectRoot . '/database/system/build.properties';

		// Create task, configure, then run
		$task = new P2P_Propel_SqlBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->setSchemaDir($schemaDir);
		$task->setSchemas($schemas);
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
		$sqlDir = $this->projectRoot . '/database/sql/system';
		$mapFile = $this->projectRoot . '/database/system/sqldb.map';
		$extraPropsFile = $this->projectRoot . '/database/system/build.properties';

		$task = new P2P_Propel_SqlRunner();

		$task->setSqlDir($sqlDir);
		$task->setMapFile($mapFile);
		$task->addPropertiesFile($extraPropsFile);

		$task->run();		
	}

	/**
	 * Converts the known connections to XML and converts to a Propel-friendly conf file
	 * 
	 * @param boolean $verbose 
	 */
	protected function buildConnections($verbose)
	{
		// Regen only system connections
		$opts = array('--system-only');

		if (!$verbose)
		{
			$opts[] = '--quiet';
		}
		
		P2P_Console_Utils::runCommand('P2P_Console_Command_Connection_Regen', $opts);
	}
}
