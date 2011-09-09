<?php

/**
 * Description of Add
 *
 * @author jon
 */
class P2P_Console_Command_Connection_Add extends P2P_Console_Command_Connection_Base implements P2P_Console_Interface
{
	const ILLEGAL_NAME = 'p2p';
	
	public function getDescription()
	{
		return 'Creates a connection to allow a node to connect to a database';
	}

	public function getOpts()
	{
		// @todo Support --test, the purpose for which is obvious!

		return array(
			'name|n=s' => 'A name to help you remember what this connection is for',
			'adaptor|a=s' => 'The PDO adaptor to use for this connection',
			'host|h=s' => 'The database host for this connection',
			'database|d=s' => 'The name of the database you wish to connect to',
			'user|u=s' => 'The username for this connection',
			'password|p=s' => 'The password for this connection',
			'password-file|f=s' => 'A text file containing the password for this connection',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('All connections need a name (use --name <name>).');			
		}

		// @todo Check that the connection name is unique

		if (!$this->opts->adaptor)
		{
			throw new Zend_Console_Getopt_Exception('All connections need an adaptor (use --adaptor <adaptor>)');
		}

		// @todo Check the adaptor exists in Propel

		if (!$this->opts->host)
		{
			throw new Zend_Console_Getopt_Exception('All connections need a host (use --host <host>).');
		}

		if ($this->opts->name == self::ILLEGAL_NAME)
		{
			throw new Zend_Console_Getopt_Exception('That name is reserved for the system; please choose another');
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
		P2P_Utils::initialiseDb();
		
		$connection = new P2PConnection();
		$connection->setName($this->opts->name);
		$connection->setAdaptor($this->opts->adaptor);
		$connection->setHost($this->opts->host);
		if ($this->opts->database)
		{
			$connection->setDatabase($this->opts->database);
		}
		if ($this->opts->user)
		{
			$connection->setUser($this->opts->user);
		}
		if ($this->opts->password)
		{
			$connection->setPassword($this->opts->password);
		}
		$connection->save();

		// Recreate the connections config files
		$this->rebuildConfigFiles();
	}
}