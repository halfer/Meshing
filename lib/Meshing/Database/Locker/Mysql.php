<?php

/**
 * Provides a table locking facility for MySQL
 *
 * @author jon
 */
class Meshing_Database_Locker_Mysql
{
	protected $con;
	protected $lockTable;
	protected $lockType;

	public function __construct(PropelPDO $con)
	{
		$this->con = $con;
	}

	public function obtainTableLock($table, $lockType = Meshing_Database_Locker::READ)
	{
		$this->lockTable = $table;
		$this->lockType = $lockType;

		return true;
	}

	/**
	 * Accessing other tables during lock status requires a lock in MySQL :(
	 * 
	 * NB: the locks must all be done in one statement.
	 */
	public function obtainTableAccess(array $tables, $lockType = Meshing_Database_Locker::READ)
	{
		// We want to lock the actual table we want to lock, of course!
		$tables[] = $this->lockTable;

		// Lock all the tables at once (write for the primary lock, read for everything else)
		$sql = 'LOCK TABLES ' . implode( ' READ, ', $tables ) . ' WRITE';
		$ok = (false !== $this->con->exec($sql));

		return $ok;
	}

	/**
	 * Release all locks
	 */
	public function releaseTableLocks()
	{
		$ok = (false !== $this->con->exec('UNLOCK TABLES'));

		return $ok;
	}
}
