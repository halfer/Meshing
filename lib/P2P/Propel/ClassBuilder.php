<?php

/**
 * Description of ClassBuilder
 *
 * @author jon
 */
class P2P_Propel_ClassBuilder extends P2P_Propel_SchemaTask
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
