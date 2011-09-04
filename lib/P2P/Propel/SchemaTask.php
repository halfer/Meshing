<?php

/**
 * Description of SchemaTask
 *
 * @author jon
 */
abstract class P2P_Propel_SchemaTask extends P2P_Propel_Task
{
	protected $schemaFiles;
	
	public function __construct()
	{
		parent::__construct();

		// Sets up default Propel build properties
		$projectPath = P2P_Utils::getProjectRoot();
		$propertiesFile = $projectPath . '/vendor/propel-1.6/generator/default.properties';
		$this->addPropertiesFile($propertiesFile);
	}

	public function setSchemaDir($schemaDir)
	{
		$this->inputDir = $schemaDir;
	}

	public function setSchemas($schemaFiles)
	{
		$this->schemaFiles = $schemaFiles;
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
		if (!$this->inputDir)
		{
			throw new Exception('No schema directory specified');
		}
		
		if (!$this->outputDir)
		{
			throw new Exception('No output directory specified');
		}

		if (!$this->schemaFiles)
		{
			throw new Exception('No schema(s) specified');
		}

		if (!$this->propertyExists('propel.database'))
		{
			throw new Exception('No database type specified');
		}
	}

	protected function schemaConfiguration(Task $task)
	{
		// Adds schema(s) to task
		$fileSet = new FileSet();
		$fileSet->setDir($this->inputDir);
		$fileSet->setIncludes($this->schemaFiles);
		$task->addSchemaFileset($fileSet);

		// Sets up output dir, for class or SQL output
		$task->setOutputDirectory(new PhingFile($this->outputDir));
	}
}
