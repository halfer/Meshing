<?php

/**
 * Description of Add
 *
 * @author jon
 */
class Meshing_Console_Command_Schema_Add extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function __construct($argv = array())
	{
		parent::__construct($argv);

		$this->projectRoot = Meshing_Utils::getProjectRoot();
	}

	public function getDescription()
	{
		return 'Adds a schema XML document into the database';
	}

	public function getOpts()
	{
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

		// @todo Test whether the input XML file already has a schema, unless --force is present
		// ...

		// @todo Do an XML validation check here
		// ...

		// Check that the schema name is not already taken
		Meshing_Utils::initialiseDb();
		$schema = MeshingSchemaQuery::create()->findOneByName($this->opts->name);
		if ($schema)
		{
			throw new Zend_Console_Getopt_Exception('That schema name is already in use');
		}

		// Try to create the folders required
		$this->schemaDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathSchemasNodes() . '/' .
			$this->opts->name;
		if (!is_dir($this->schemaDir))
		{
			if (!@mkdir($this->schemaDir))
			{
				throw new Zend_Console_Getopt_Exception(
					"Error when creating the schema folder '{$this->opts->name}', check permissions?"
				);
			}
		}
	}

	/**
	 * Modifies and then builds a Propel schema
	 */
	public function run()
	{
		$this->installXml();
		$this->writeRecord();
		$this->createConf();
	}

	protected function installXml()
	{
		$schemaProc = 'schema.xml';
		$this->doFixups(
			$this->opts->file,
			$this->schemaDir . DIRECTORY_SEPARATOR . $schemaProc,
			$this->opts->name
		);

		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() .
			'/build.properties';
		$modelDir = $this->projectRoot . Meshing_Utils::getPaths()->getPathModelsNodes();

		// Create task, configure, then run
		$task = new Meshing_Propel_ClassBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($this->schemaDir, $schemaProc);
		$task->setOutputDir($modelDir);

		$task->run();
		
		echo "Schemas: " . $this->schemaDir . "\n";
		echo "Output: " . $modelDir . "\n";		
	}

	/**
	 * Swaps &entity; references for system snippets
	 * 
	 * @todo As of 8 Oct 2011, this is no longer used. May be useful in future?
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
						$this->projectRoot . Meshing_Utils::getPaths()->getPathSystemSnippets() . '/' .
							$match . '.xml'
					);
				}
				
				// Replace all instances of this entity in the XML doc
				$xml = str_replace('&' . $match . ';', $entities[$match], $xml);
			}
		}
		
		file_put_contents($outputFile, $xml);
	}

	/**
	 * Modify the schema 
	 */
	protected function doFixups($schemaFileIn, $schemaFileOut, $schemaName)
	{
		$fixup = new Meshing_Schema_Fixup($schemaFileIn, $schemaFileOut);
		$fixup->fixup($schemaName);
	}

	protected function writeRecord()
	{
		$schema = new MeshingSchema();
		$schema->setName($this->opts->name);
		$schema->setInstalledAt(time());
		$schema->save();
	}

	protected function createConf()
	{
		$configName = 'database-conf.php';
		$this->convertConf(
			$this->projectRoot . Meshing_Utils::getPaths()->getFileRuntimeXml(),
			$this->projectRoot . Meshing_Utils::getPaths()->getPathConnsNodes() . '/' . $this->opts->name,
			$configName
		);

		// We only want the autoloading file, not the connections file... deleting to be tidy!
		$configPath = $this->projectRoot .
			Meshing_Utils::getPaths()->getPathConnsNodes() .
			$this->opts->name . '/' . $configName;
		@unlink($configPath);
	}

	/**
	 * Creates a PHP configuration and classmaps files
	 * 
	 * @todo Merge this with Regen::convertConf, put them both in
	 * Meshing_Console_Command_Connection_Base.
	 */
	protected function convertConf($runTime, $outputDir, $outputFile)
	{
		$schemas = "schema.xml";
		$extraPropsFile = $this->projectRoot . Meshing_Utils::getPaths()->getPathDbConfig() .
			'/build.properties';

		$task = new Meshing_Propel_ConfBuilder();
		
		$task->addSchemas($this->schemaDir, $schemas);
		$task->setXmlFile($runTime);
		$task->setOutputDir($outputDir);
		$task->setOutputFile($outputFile);
		$task->addPropertiesFile($extraPropsFile);

		$task->run();		
	}
}