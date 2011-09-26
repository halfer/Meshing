<?php

abstract class Meshing_Propel_Task
{
	protected $fileProps = array();
	protected $customProps = array();
	protected $propertiesFiles = array();
	// @todo Not all tasks have an input dir - move this to sub-classes that need it?
	protected $inputDir;
	// @todo Not all tasks have an output dir - move this to sub-classes that need it?
	protected $outputDir;

	public function __construct()
	{
		// @todo These should have an auto-loader
		require_once 'phing/Phing.php';
		require_once 'phing/Project.php';
		require_once 'phing/types/FileSet.php';
		require_once 'phing/system/io/PhingFile.php';
		require_once 'phing/system/util/Properties.php';

		// Needs calling quite early (e.g. PhingFile won't work without it)
		Phing::startup();
	}

	/**
	 * Permits an arbitrary number of property files to be added
	 */
	public function addPropertiesFile($propertiesFile)
	{
		if (!file_exists($propertiesFile))
		{
			throw new Exception('Properties file does not exist');
		}
		
		$properties = new Properties();
		$properties->load(new PhingFile($propertiesFile));

		$this->fileProps = array_merge(
			$this->fileProps,
			$properties->getProperties()
		);
	}

	protected function propertyExists($property)
	{
		$filePropExists = array_key_exists($property, $this->fileProps);
		$custPropExists = array_key_exists($property, $this->customProps);
		
		return $filePropExists || $custPropExists;
	}

	public function addProperty($key, $value)
	{
		$this->customProps[$key] = $value;
	}

	protected function getProperty($property)
	{
		$props = array_merge($this->fileProps, $this->customProps);
		
		return array_key_exists($property, $props) ? $props[$property] : null;
	}

	public function run()
	{
		$this->preRunCheck();

		$project = new Project();

		$this->initPhingProperties($project);

		$task = $this->createTask($project);
		
		$this->runTask($project, $task);
		
		$this->postRun();
	}
	
	abstract protected function preRunCheck();

	protected function initPhingProperties(Project $project)
	{
		// Apply all file properties, then all non-file properties
		$properties = new Properties();
		foreach($this->fileProps as $key => $value)
		{
			$properties->put($key, $value);
		}
		foreach($this->customProps as $key => $value)
		{
			$properties->put($key, $value);
		}

		// Then swap out placeholder values
		foreach ( $properties->getProperties() as $key => $value )
		{
			$value = ProjectConfigurator::replaceProperties($project, $value, $properties->getProperties());
			$project->setProperty($key, $value);
		}
	}

	abstract protected function createTask(Project $project);

	protected function runTask(Project $project, Task $task)
	{
		// Add if the client has not already done so
		if (!$task->getProject())
		{
			$task->setProject($project);				
		}

		$task->main();
	}

	protected function postRun()
	{
		
	}
}