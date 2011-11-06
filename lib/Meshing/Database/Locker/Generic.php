<?php

/**
 * Provides a table locking facility for a specific database
 *
 * @author jon
 */
class Meshing_Database_Locker_Generic
{
	protected $con;

	public function __construct(PropelPDO $con)
	{
		$this->con = $con;
	}

	public function obtainTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->con->beginTransaction();
		// @todo This is probably specific to PostgreSQL - move to specific class
		$this->con->exec('LOCK TABLE ' . $table . ' IN SHARE ROW EXCLUSIVE MODE');

		return true;
	}

	public function releaseTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->con->commit();

		return true;
	}
}
