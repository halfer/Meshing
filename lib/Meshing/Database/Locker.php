<?php

/**
 * Provides a table locking facility
 *
 * @author jon
 */
class Meshing_Database_Locker
{
	const READ = 1;

	/**
	 * Gets suitable table-locking class for client
	 * 
	 * @param PropelPDO $con
	 * @return Meshing_Database_Locker_Generic
	 */
	public static function getInstance(PropelPDO $con)
	{
		$class = self::getClassName($con);

		// @todo This seems to hang things, replace with a file_exists check
		//if (!class_exists($class, $autoload = false))
		//{
		//	throw new Exception("The locking system doesn't yet support a $type database");
		//}

		return new $class($con);
	}

	protected static function getClassName(PropelPDO $con)
	{
		// Get the database type
		$type = $con->getAttribute(PDO::ATTR_DRIVER_NAME);
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		$type = $filter->filter($type);
		$class = 'Meshing_Database_Locker_' . $type;

		return $class;
	}
}
