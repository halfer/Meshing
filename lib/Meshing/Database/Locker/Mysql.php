<?php

/**
 * Provides a table locking facility for MySQL
 *
 * @author jon
 */
class Meshing_Database_Locker_Mysql
{
	protected $con;

	public function __construct(PropelPDO $con)
	{
		$this->con = $con;
	}

	public function obtainTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->con->beginTransaction();
		// @todo Fix this to whatever mysql requires
		$this->con->exec('LOCK TABLES ' . $table . ' WRITE');

		return true;
	}

	public function releaseTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->con->exec('UNLOCK TABLES');

		return true;
	}
}
