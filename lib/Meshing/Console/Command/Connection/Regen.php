<?php

/**
 * Description of Add
 *
 * @author jon
 */
class Meshing_Console_Command_Connection_Regen extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function __construct($argv = array())
	{
		parent::__construct($argv);
		
		$this->projectRoot = Meshing_Utils::getProjectRoot();
	}

	public function getDescription()
	{
		return 'Regenerates the database connection config files';
	}

	public function getOpts()
	{
		return
			array(
				'system|s' => 'Regen the system connections config file',
				'non-system|n' => 'Regen the user connections config file',
			) +
			$this->optQuiet();
	}

	public function preRunCheck()
	{
		if (!$this->opts->system && !$this->opts->{'non-system'})
		{
			throw new Zend_Console_Getopt_Exception('Nothing to do');
		}
	}

	public function run()
	{
		$outputDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathConnsSystem();
		$outputFile = 'database-conf.php';

		// If the PHP config files are missing, regen just system ones to start with
		$conf1 = $outputDir . DIRECTORY_SEPARATOR . $outputFile;
		$conf2 = $outputDir . DIRECTORY_SEPARATOR . 'classmap-' . $outputFile;
		if (!is_readable($conf1) || !is_readable($conf2) || $this->opts->{'system'})
		{
			// Create a Propel runtime XML for just the system connection
			$xmlFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() .
				'/runtime-conf.xml';
			$this->convertConf($xmlFile, $outputDir, $outputFile);
			
			if (!$this->opts->quiet)
			{
				echo "Generated system connections config file.\n";
			}
		}

		// If non-system connections are specified, do them all
		if ($this->opts->{'non-system'})
		{
			// Create a Propel runtime XML containing all connections		
			$xmlFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathConnsNodes() .
				'/runtime-conf-regen.xml';
			$this->createRuntimeXml(
				$this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() . '/runtime-conf.xml',
				$xmlFile
			);

			// Then generate the connections file again, against the new config
			$this->convertConf($xmlFile, $outputDir, $outputFile);

			if (!$this->opts->quiet)
			{
				echo "Generated user connections config file.\n";
			}

			// Finally delete the temp XML file
			$this->deleteRuntimeXml($xmlFile);
		}
	}

	/**
	 * Takes an XML config file and converts it to PHP config files
	 * 
	 * @param string $runTime Full pathname of the XML config file
	 * @param string $outputDir Path of the output directory
	 * @param string $outputFile Base leafname of the output PHP file
	 */
	protected function convertConf($runTime, $outputDir, $outputFile)
	{
		$schemaDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig();
		$schemas = "schema.xml";
		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() .
			'/build.properties';

		$task = new Meshing_Propel_ConfBuilder();
		
		$task->addSchemas($schemaDir, $schemas);
		$task->setXmlFile($runTime);
		$task->setOutputDir($outputDir);
		$task->setOutputFile($outputFile);
		$task->addPropertiesFile($extraPropsFile);

		$task->run();		
	}

	/**
	 * Get XML version of default runtime file, returns temp version to convert to PHP
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
		Meshing_Utils::initialiseDb();
		$c = new Criteria();
		$c->setLimit(50);
		$connections = P2PConnectionPeer::doSelect($c);
		
		// Add each connection in as a datasource
		/* @var $connection P2PConnection */
		foreach ($connections as $connection)
		{
			// Modify XML document
			$element = $xml->propel->datasources->addChild('datasource');
			$element['id'] = $connection->getName();
			$inner1 = $element->addChild('adapter', $connection->getAdaptor());
			$inner2 = $element->addChild('connection');
			$inner2->addChild('dsn', $connection->getCalculatedDsn());
			$inner2->addChild('user', $connection->getUsername());
			$inner2->addChild('password', $connection->getPassword());
		}

		// Write out modified XML doc to new file
		$xml->asXml($newRunTime);
	}

	protected function deleteRuntimeXml($tempName)
	{
		unlink($tempName);
	}
}