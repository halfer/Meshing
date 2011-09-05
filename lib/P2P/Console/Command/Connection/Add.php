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
			throw new Zend_Console_Getopt_Exception('All connections need a name.');			
		}
	
		if (!$this->opts->host)
		{
			throw new Zend_Console_Getopt_Exception('All connections need a host.');
		}
		
		if ($this->opts->getOption('password-file'))
		{
			throw new Zend_Console_Getopt_Exception('This option is not currently implemented.');
		}
	}

	/**
	 * Creates a new, named connection
	 * 
	 * @todo Need to validate string lengths etc (or catch exceptions properly)
	 */
	public function run()
	{
		$Connection = new P2PConnection();
		$Connection->setName($this->opts->name);
		$Connection->setHost($this->opts->host);
		if ($this->opts->user)
		{
			$Connection->setUser($this->opts->user);
		}
		if ($this->opts->password)
		{
			$Connection->setPassword($this->opts->password);
		}
		$Connection->save();
	}
}