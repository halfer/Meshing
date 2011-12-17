<?php

/**
 * Provides a table locking facility for PostgreSQL
 *
 * @author jon
 */
class Meshing_Database_Locker_Pgsql
{
	protected $con;

	public function __construct(PropelPDO $con)
	{
		$this->con = $con;
	}

	public function obtainTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->con->beginTransaction();
		$this->con->exec('LOCK TABLE ' . $table . ' IN SHARE ROW EXCLUSIVE MODE');

		return true;
	}

	/**
	 * Dummy routine for this driver - accessing other tables doesn't require a lock
	 */
	public function obtainTableAccess(array $tables, $lockType = Meshing_Database_Locker::READ)
	{
		return true;
	}

	/**
	 * Release all locks
	 */
	public function releaseTableLocks()
	{
		$this->con->commit();

		return true;
	}
}
