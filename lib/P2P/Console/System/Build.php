<?php

/**
 * Description of Build
 *
 * @author jon
 */
class P2P_Console_System_Build implements P2P_Console_Interface
{
	private $opts;
	private $projectRoot;

	public function __construct($argv = array())
	{
		$this->argv = $argv;
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
		$this->opts = new Zend_Console_Getopt($this->getOpts(), $this->argv);
		$this->opts->parse();

		// Check that at least one of the options has been provided
		if (!$this->opts->classes && !$this->opts->database) {
			throw new Zend_Console_Getopt_Exception('Nothing to do.');
		}
	}

	public function run()
	{
		$this->projectRoot = P2P_Utils::getProjectRoot();

		$verbose = $this->opts->verbose;
		
		if ($this->opts->classes)
		{
			$this->buildModel($verbose);
		}
		
		if ($this->opts->database)
		{
			$this->buildSql($verbose);
			$this->runSql($verbose);
		}
	}

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
	}

	protected function buildSql($verbose)
	{
		
	}

	protected function runSql($verbose)
	{
		
	}
}
