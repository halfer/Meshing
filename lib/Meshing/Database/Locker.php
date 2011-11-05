<?php

/**
 * Provides a table locking facility
 *
 * @author jon
 */
class Meshing_Database_Locker
{
	const READ = 1;
	const WRITE = 2;
	
	public static function getInstance(PropelPDO $con)
	{
		// Get the database type
		$type = $con->getAttribute(PDO::ATTR_DRIVER_NAME);
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		$type = $filter->filter($type);
		$class = 'Meshing_Database_Locker_' . $type;

		// @todo This seems to hang things, replace with a file_exists check
		//if (!class_exists($class, $autoload = false))
		//{
		//	throw new Exception("The locking system doesn't yet support a $type database");
		//}

		return new $class;
	}

	// @todo Move these to a driver-specific class
	public static function obtainTableLock(PropelPDO $con, $table, $lockType)
	{
		return true;
	}

	public static function releaseTableLock(PropelPDO $con, $table, $lockType)
	{
		return true;
	}
}
