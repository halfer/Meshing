<?php

/**
 * Description of Connection
 *
 * @author jon
 */
class Meshing_Database_Connection extends PropelPDO
{
	protected $classId;

	public function __construct($dsn, $username = null, $password = null, $driver_options = array())
	{
		parent::__construct($dsn, $username, $password, $driver_options);
		$this->classId = md5(
			$dsn . ',' . $username . ',' . $password . ',' . implode(',', $driver_options)
		);
	}

	public function __toString()
	{
		return $this->classId;
	}
}
