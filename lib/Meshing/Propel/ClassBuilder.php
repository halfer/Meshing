<?php

/**
 * Description of ClassBuilder
 *
 * @author jon
 */
class Meshing_Propel_ClassBuilder extends Meshing_Propel_SchemaTask
{
	protected function createTask(Project $project)
	{
		require_once 'task/PropelOMTask.php';
		$task = new PropelOMTask();

		$this->schemaConfiguration($task);

		// Create a directory structure to match the package names
		$task->setPackageObjectModel('1');
		
		return $task;
	}
}