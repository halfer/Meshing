<?php

/**
 * Abstract task used by SqlBuilder and ConfBuilder
 *
 * @author jon
 */
abstract class Meshing_Propel_SchemaTask extends Meshing_Propel_Task
{
	protected $schemas = array();
	
	public function __construct()
	{
		parent::__construct();

		// Sets up default Propel build properties
		$projectPath = Meshing_Utils::getProjectRoot();
		$propertiesFile = $projectPath . '/vendor/propel-1.6/generator/default.properties';
		$this->addPropertiesFile($propertiesFile);
	}

	/**
	 * Add a schema dir/wildcarded-file pair to the task
	 * 
	 * @param string $schemaDir Directory specification
	 * @param string $schemaFiles File specification (believe this can contain wildcards)
	 */
	public function addSchemas($schemaDir, $schemaFiles)
	{
		$this->schemas[] = array($schemaDir, $schemaFiles);
	}

	/**
	 * This grabs the schemaFiles value, if only one has been provided
	 * 
	 * @see Meshing_Propel_SqlBuilder::postRun
	 */
	public function getSchemaFiles()
	{
		if (count($this->schemas) != 1)
		{
			throw new Exception('There is not exactly one schema file to return');
		}

		return $this->schemas[0][1];
	}

	public function setOutputDir($outputDir)
	{
		if (file_exists($outputDir))
		{
			if (!is_dir($outputDir))
			{
				throw new Exception('The output directory must be a directory');
			}
		}
		else
		{
			mkdir($outputDir);
		}
		
		$this->outputDir = $outputDir;
	}

	public function setDatabaseType($type)
	{
		$this->customProps['propel.database'] = $type;
	}

	protected function preRunCheck()
	{
		if (!$this->schemas)
		{
			throw new Exception('No schemas specified');
		}
		
		if (!$this->outputDir)
		{
			throw new Exception('No output directory specified');
		}

		if (!$this->propertyExists('propel.database'))
		{
			throw new Exception('No database type specified');
		}
	}

	protected function schemaConfiguration(Task $task)
	{
		// Adds schema(s) to task
		foreach ($this->schemas as $pair)
		{
			$fileSet = new FileSet();
			$fileSet->setDir($pair[0]);
			$fileSet->setIncludes($pair[1]);
			$task->addSchemaFileset($fileSet);
		}

		// Sets up output dir, for class, SQL or conf output
		$task->setOutputDirectory(new PhingFile($this->outputDir));
	}
}
