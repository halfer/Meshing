<?php

/**
 * Description of Add
 *
 * @author jon
 */
class P2P_Console_Command_Connection_Add extends P2P_Console_Stub implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Creates a connection to allow a node to connect to a database';
	}

	public function getOpts()
	{
		return array(
			'name|n=s' => 'A name to help you remember what this connection is for',
			'host|h=s' => 'The database host for this connection',
			'user|u=s' => 'The username for this connection',
			'password|p=s' => 'The password for this connection',
			'password-file|f=s' => 'A text file containing the password for this connection',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Exception('All connections need a name');			
		}
	
		if (!$this->opts->host)
		{
			throw new Exception('All connections need a host');
		}
		
		if ($this->opts->getOption('password-file'))
		{
			throw new Exception('This option is not currently implemented');
		}
	}

	public function run()
	{
		$this->projectRoot = P2P_Utils::getProjectRoot();

		$Connection = new Connection();
	}
}