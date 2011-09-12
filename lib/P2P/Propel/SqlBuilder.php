<?php

/**
 * Description of SqlBuilder
 *
 * @author jon
 */
class P2P_Propel_SqlBuilder extends P2P_Propel_SchemaTask
{
	protected function createTask(Project $project)
	{
		require_once 'phing/types/Mapper.php';
		require_once 'task/AbstractPropelDataModelTask.php';
		require_once 'task/PropelSQLTask.php';
		$task = new PropelSQLTask();

		$this->schemaConfiguration($task);
		
		// Mapper requires that the project is added in first
		$task->setProject($project);

		// This affects the source name I think, not the output name
		$mapper = $task->createMapper();
		$mapper->setType('identity');
		
		return $task;
	}

	/**
	 * Renames the output file (*.xml) to a more sensible name (*.sql)
	 * 
	 * Note: this is used by child class P2P_Propel_SqlBuilder to
	 * work out the output SQL file's name. Perhaps there is a better
	 * mechanism in Propel to determine what the output file is going to
	 * be. What would it be if two schemas were to be added, since it
	 * cannot take both of their names?
	 */
	protected function postRun()
	{
		// Rename the "*.xml" SQL file to "*.sql"
		rename(
			$this->outputDir . DIRECTORY_SEPARATOR . $this->getSchemaFiles(),
			$this->outputDir . DIRECTORY_SEPARATOR . 'schema.sql'
		);
	}
}
