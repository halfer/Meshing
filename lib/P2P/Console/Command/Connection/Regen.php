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
			$projectRoot . '/database/system/runtime-conf.xml',
			$projectRoot . '/database/connections/runtime-conf-regen.xml'
		);
	}

	/**
	 * Get XML version of runtime file, return temp version
	 */
	protected function createRuntimeXml($runTime, $newRunTime)
	{
		// Ensure the file exists
		if (!is_readable($runTime))
		{
			throw new Exception("Can't load runtime configuration");
		}

		// Ensure the new file won't overwrite the old one!
		if ( $runTime == $newRunTime )
		{
			throw new Exception('The new XML location must be different to the existing one');
		}

		// Load up the XML doc
		$xml = simplexml_load_file($runTime);

		// @todo Validate XML file

		// Grab the connections known to the system (@todo would we want more than 50!?)
		P2P_Utils::initialiseDb();
		$c = new Criteria();
		$c->setLimit(50);
		$connections = P2PConnectionPeer::doSelect($c);
		
		// Add each connection in as a datasource
		/* @var $connection P2PConnection */
		foreach ($connections as $connection)
		{
			// Build DSN string
			$dsn = $connection->getAdaptor() . ':' .
				'host=' . $connection->getHost() . ' ' .
				'dbname=xxx ' .
				'user=' . $connection->getUser() . ' ' .
				'password=' . $connection->getPassword();

			// Modify XML document
			$element = $xml->propel->datasources->addChild('datasource');
			$element['id'] = $connection->getName();
			$inner1 = $element->addChild('adaptor', $connection->getAdaptor());
			$inner2 = $element->addChild('connection');
			$inner2->addChild('dsn', $dsn);
			$inner2->addChild('user', $connection->getUser());
			$inner2->addChild('password', $connection->getPassword());
		}

		// Write out modified XML doc to new file
		$xml->asXml($newRunTime);

		// @todo create a new XML file here, process in Propel, then delete it
		echo "Built, but need to add dbname support\n";
	}

	protected function deleteRuntimeXml($tempName)
	{
		unlink($tempName);
	}
}