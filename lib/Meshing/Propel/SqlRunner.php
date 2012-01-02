<?php

/**
 * Task to run (generated) SQL
 *
 * @author jon
 */
class Meshing_Propel_SqlRunner extends Meshing_Propel_ConnectionTask
{
	protected $mapFile;
	protected $url, $userid, $password;

	public function setSqlDir($sqlDir)
	{
		$this->inputDir = $sqlDir;
	}

	public function setMapFile($mapFile)
	{
		$this->mapFile = $mapFile;
	}

	/**
	 * Sets up the SQL running task
	 * 
	 * Currently we continue on errors - useful since table creation scripts usually
	 * delete tables prior to creating them, so if a table doesn't exist, we would want it
	 * to continue. However some errors need actioning - e.g. sql for PostgreSQL incorrectly
	 * run against MySQL etc.
	 * 
	 * @todo Perhaps we should output errors as warnings?
	 * 
	 * @param Project $project
	 * @return PropelSQLExec 
	 */
	protected function createTask(Project $project)
	{
		require_once 'task/PropelSQLExec.php';
		require_once 'config/GeneratorConfig.php';
		$task = new PropelSQLExec();

		$task->setSrcDir(new PhingFile($this->inputDir));

		// Setting the map file requires that the project is added in first
		$task->setProject($project);

		// The map file specifies what sql files should use which connection
		$task->setSqlDbMap(new PhingFile($this->mapFile));

		// The db details may be specified in Propel properties instead
		if (!$this->url)
		{
			$this->url = $this->getProperty('propel.database.url');
		}

		$task->setUrl($this->url);
		$task->setUserid($this->userid);
		$task->setPassword($this->password);

		$task->setAutoCommit(true);
		$task->setOnerror('continue');
		
		return $task;
	}

	protected function preRunCheck()
	{
		if (!$this->inputDir)
		{
			throw new Exception('No SQL directory specified');
		}

		if (!$this->mapFile)
		{
			throw new Exception('No map file specified');
		}
		
		if (!$this->propertyExists('propel.database.url') && !$this->url)
		{
			throw new Exception('Database credentials not specified');
		}
	}
}
