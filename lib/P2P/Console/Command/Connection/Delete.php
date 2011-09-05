<?php

/**
 * Description of Delete
 *
 * @author jon
 */
class P2P_Console_Command_Connection_Delete extends P2P_Console_Command_Connection_Base implements P2P_Console_Interface
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
		
		P2P_Utils::initialiseDb();

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
		$this->rebuildConfigFiles();		
	}
}