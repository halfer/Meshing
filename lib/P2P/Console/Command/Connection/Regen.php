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

		// Ensure the new file won't overwrite the old one!
		if ( $runTime == $newRunTime )
		{
			throw new Exception('The new XML location must be different to the existing one');
		}

		// Load up the XML doc
		$xml = simplexml_load_file($path);
		
		// Create new datasource xml element
		$element = $xml->propel->datasources->addChild('datasource');
		$element['id'] = 'propel-conn-name';
		$inner1 = $element->addChild('adaptor', 'pgsql');
		$inner2 = $element->addChild('connection');
		$inner2->addChild('dsn', 'pgsql:host=localhost dbname=p2p2 user=jon password=');
		$inner2->addChild('user', 'jon');
		$inner2->addChild('password', '');

		// Write out modified XML doc to new file
		$xml->asXml($dir . DIRECTORY_SEPARATOR . $newRunTime);

		// @todo create a new XML file here, process in Propel, then delete it
		throw new Exception('Demo implementation only');
	}

	protected function deleteRuntimeXml($tempName)
	{
		unlink($tempName);
	}
}