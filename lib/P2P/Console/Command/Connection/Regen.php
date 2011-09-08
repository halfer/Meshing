<?php

/**
 * Description of Add
 *
 * @author jon
 */
class P2P_Console_Command_Connection_Regen extends P2P_Console_Stub implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Regenerates the config files for the database';
	}

	public function getOpts()
	{
		return array();
	}

	public function preRunCheck()
	{
	}

	public function run()
	{
		$projectRoot = P2P_Utils::getProjectRoot();

		$schemaDir = $projectRoot . '/database/system';
		$schemas = "schema.xml";
		$xmlFile = $projectRoot . '/database/system/runtime-conf.xml';
		$outputDir = $projectRoot . '/database/connections';
		$outputFile = 'database-conf.php';
		$extraPropsFile = $projectRoot . '/database/system/build.properties';

		$task = new P2P_Propel_ConfBuilder();
		
		$task->setSchemaDir($schemaDir);
		$task->setSchemas($schemas);
		$task->setXmlFile($xmlFile);
		$task->setOutputDir($outputDir);
		$task->setOutputFile($outputFile);
		$task->addPropertiesFile($extraPropsFile);

		$task->run();

		// Create a Propel runtime XML containing all connections 
		$this->createRuntimeXml(
			$projectRoot . '/database/system',
			'runtime-conf.xml',
			'runtime-conf-all.xml'
		);
	}

	/**
	 * Get XML version of runtime file, return temp version
	 */
	protected function createRuntimeXml($dir, $runTime, $newRunTime)
	{
		// Ensure the file exists
		$path = $dir . DIRECTORY_SEPARATOR . $runTime;
		if (!is_readable($path))
		{
			throw new Exception("Can't load '$runTime' runtime configuration");
		}
		
		// Load up the XML doc
		$xml = simplexml_load_file($path);
		print_r($xml);
		
		// @todo create a new XML file here, process in Propel, then delete it
	}

	protected function deleteRuntimeXml($tempName)
	{
		unlink($tempName);
	}
}