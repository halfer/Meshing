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

	public function parseOpts()
	{
	}

	public function preRunCheck()
	{
		
	}

	/**
	 * Modifies and then builds a Propel schema
	 * 
	 * @todo Each table should have a versioned copy created automatically
	 * @todo Table names should be converted into something unique eg JobsDotComRole
	 * @todo An easier way to specify FKs?
	 */
	public function run()
	{
		// Set db type, schema and output folder here
		$extraPropsFile = $this->projectRoot . '/database/system/build.properties';
		$schemaDir = $this->projectRoot . '/database/schemas/jobs';
		$schemaRaw = 'schema.xml';
		$schemaProc = 'schema-p.xml';
		$outputDir = $this->projectRoot . "/database/models/jobs";
		
		$this->processIncludes($schemaDir, $schemaRaw, $schemaProc);

		// Create task, configure, then run
		$task = new P2P_Propel_ClassBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->setSchemaDir($schemaDir);
		$task->setSchemas($schemaProc);
		$task->setOutputDir($outputDir);

		$task->run();
		
		echo "This is the processing of a hardwired schema\n";
		echo "Schemas: " . $schemaDir . "\n";
		echo "Output: " . $outputDir . "\n";
	}

	protected function processIncludes($dir, $schema, $outputFile)
	{
		$entities = array();

		// Find all entity refs in the doc
		$xml = file_get_contents($dir . DIRECTORY_SEPARATOR . $schema);
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
		
		file_put_contents($dir . DIRECTORY_SEPARATOR . $outputFile, $xml);
	}
}