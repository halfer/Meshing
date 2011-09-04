<?php

abstract class P2P_Propel_Task
{
	protected $customProps = array();
	protected $propertiesFile;
	protected $inputDir;
	protected $outputDir;

	public function __construct()
	{
		// @todo These should have an auto-loader
		require_once 'phing/Phing.php';
		require_once 'phing/Project.php';
		require_once 'phing/types/FileSet.php';
		require_once 'phing/system/io/PhingFile.php';
		require_once 'phing/system/util/Properties.php';
	}

	/**
	 * Can this go in SchemaTask instead?
	 */
	public function setPropertiesFile($propertiesFile)
	{
		$this->propertiesFile = $propertiesFile;
	}

	public function run()
	{
		$this->preRunCheck();

		Phing::startup();
		$project = new Project();

		$this->initPhingProperties($project);

		$task = $this->createTask($project);
		
		$this->runTask($project, $task);
		
		$this->postRun();
	}
	
	abstract function preRunCheck();

	protected function initPhingProperties(Project $project)
	{
		// Read in default properties file if it has been specified
		$properties = new Properties();
		if ($this->propertiesFile)
		{
			$properties->load(new PhingFile($this->propertiesFile));
		}
		
		// Add any custom values
		foreach( $this->customProps as $key => $value ) {
			$properties->put($key, $value);
		}

		// Then swap out placeholder values
		foreach ( $properties->getProperties() as $key => $value )
		{
			$value = ProjectConfigurator::replaceProperties($project, $value, $properties->getProperties());
			$project->setProperty($key, $value);
		}
	}

	abstract function createTask(Project $project);

	public function runTask(Project $project, Task $task)
	{
		// Add if the client has not already done so
		if (!$task->getProject())
		{
			$task->setProject($project);				
		}

		$task->main();
	}

	public function postRun()
	{
		
	}
}