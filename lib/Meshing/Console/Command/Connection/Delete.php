<?php

/**
 * Description of Delete
 *
 * @author jon
 */
class Meshing_Console_Command_Connection_Delete extends Meshing_Console_Command_Connection_Base implements Meshing_Console_Interface
{
	private $connection;

	public function getDescription()
	{
		return 'Deletes the specified database connection';
	}

	public function getOpts()
	{
		return array(
			'name|n=s' => 'The name of the connection to delete',
		);
	}

	public function preRunCheck()
	{
		$name = $this->opts->name;
		if (!$name)
		{
			throw new Zend_Console_Getopt_Exception('The connection name must be specified.');			
		}

		// @todo Check that this connection isn't in use

		Meshing_Utils::initialiseDb();

		$this->connection = P2PConnectionQuery::create()->findOneByName($name);
		if (!$this->connection)
		{
			throw new Zend_Console_Getopt_Exception('No such connection.');
		}
	}

	public function run()
	{
		// Delete the row
		$this->connection->delete();

		// Recreate the connections config files
		// @todo Support --quiet flag in this command
		$this->buildConnections($sys = false, $nonSys = true, $quiet = false);
	}
}