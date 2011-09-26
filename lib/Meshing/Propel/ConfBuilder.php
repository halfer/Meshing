<?php

/**
 * Description of ConfBuilder
 *
 * @author jon
 */
class Meshing_Propel_ConfBuilder extends Meshing_Propel_SchemaTask
{
	protected $xmlFile;
	protected $outputFile;
	
	protected function preRunCheck()
	{
		// Also check the rules defined by the parent task
		parent::preRunCheck();

		if (!$this->xmlFile)
		{
			throw new Exception('No XML configuration file specified');
		}

		if (!$this->outputFile)
		{
			throw new Exception('No configuration output file specified');
		}
		
		// @todo If we pass all the tests, rebuild the XML runtime connections file
		// ...
	}

	public function setXmlFile($xmlFile)
	{
		$this->xmlFile = $xmlFile;
	}

	public function setOutputFile($outputFile)
	{
		$this->outputFile = $outputFile;
	}

	/**
	 * Returns a task to be run by Meshing_Console_Task
	 * 
	 * @param Project $project
	 * @return PropelConvertConfTask 
	 */
	protected function createTask(Project $project)
	{
		require_once 'task/PropelConvertConfTask.php';
		$task = new PropelConvertConfTask();

		$this->schemaConfiguration($task);
		$task->setXmlConfFile(new PhingFile($this->xmlFile));
		$task->setOutputFile($this->outputFile);
		
		return $task;
	}
}
