<?php

/**
 * Description of Add
 *
 * @author jon
 */
class P2P_Console_Command_Schema_Add extends P2P_Console_Base implements P2P_Console_Interface
{
	public function __construct($argv = array())
	{
		parent::__construct($argv);

		$this->projectRoot = P2P_Utils::getProjectRoot();
	}

	public function getDescription()
	{
		return 'Adds a schema XML document into the database';
	}

	public function getOpts()
	{
		//--file=f --name=n
		return array(
			'name|n=s' => 'An identifying name for the schema',
			'file|f=s' => 'The XML document to add',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('All schemas need an identifying name (use --name)');
		}

		if (!$this->opts->file)
		{
			throw new Zend_Console_Getopt_Exception('A schema XML file must be specified (use --file)');			
		}
		
		// Let's check that the file exists
		if (!file_exists($this->opts->file))
		{
			throw new Zend_Console_Getopt_Exception('The specified XML schema does not exist');
		}

		// @todo Do an XML validation check here
		// ...

		// Check that the schema name is not already taken
		P2P_Utils::initialiseDb();
		$schema = P2PSchemaQuery::create()->findOneByName($this->opts->name);
		if ($schema)
		{
			throw new Zend_Console_Getopt_Exception('That schema name is already in use');
		}

		// Try to create the folders required
		$this->schemaDir = $this->projectRoot . '/database/schemas/' . $this->opts->name;
		if (!is_dir($this->schemaDir))
		{
			if (!@mkdir($this->schemaDir))
			{
				throw new Zend_Console_Getopt_Exception(
					"Error when creating the schema folder '{$this->opts->name}', check permissions?"
				);
			}
		}
		$this->modelDir = $this->projectRoot . '/database/models/' . $this->opts->name;
		if (!is_dir($this->modelDir))
		{
			if (!@mkdir($this->modelDir))
			{
				throw new Zend_Console_Getopt_Exception(
					"Error when creating the model folder '{$this->opts->name}', check permissions?"
				);
			}
		}
	}

	/**
	 * Modifies and then builds a Propel schema
	 * 
	 * @todo Each table should have a versioned copy created automatically
	 * @todo Table names should be converted into something unique eg ModelJobsRole
	 * @todo An easier way to specify FKs?
	 */
	public function run()
	{
		$this->installXml();
		$this->writeRecord();
	}

	protected function installXml()
	{
		$schemaProc = 'schema.xml';
		$this->processIncludes(
			$this->opts->file,
			$this->schemaDir . DIRECTORY_SEPARATOR . $schemaProc
		);

		$extraPropsFile = $this->projectRoot . '/database/system/build.properties';

		// Create task, configure, then run
		$task = new P2P_Propel_ClassBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->setSchemaDir($this->schemaDir);
		$task->setSchemas($schemaProc);
		$task->setOutputDir($this->modelDir);

		$task->run();
		
		echo "Schemas: " . $this->schemaDir . "\n";
		echo "Output: " . $this->modelDir . "\n";		
	}

	/**
	 * Swaps &entity; references for system snippets
	 * 
	 * @param type $schema Full/relative path to user's schema
	 * @param type $outputFile Full path to output schema, where it is "installed"
	 */
	protected function processIncludes($schema, $outputFile)
	{
		$entities = array();

		// Find all entity refs in the doc
		$xml = file_get_contents($schema);
		$matches = array();
		preg_match_all('/&(\w+);/', $xml, $matches);
		
		if (array_key_exists(1, $matches))
		{
			foreach ($matches[1] as $match)
			{
				// Find matching entity file
				if (!array_key_exists($match, $entities))
				{
					$entities[$match] = file_get_contents(
						$this->projectRoot . '/database/system/snippets/' . $match . '.xml'
					);
				}
				
				// Replace all instances of this entity in the XML doc
				$xml = str_replace('&' . $match . ';', $entities[$match], $xml);
			}
		}
		
		file_put_contents($outputFile, $xml);
	}

	protected function writeRecord()
	{
		$schema = new P2PSchema();
		$schema->setName($this->opts->name);
		$schema->setInstalledAt(time());
		$schema->save();
	}
}