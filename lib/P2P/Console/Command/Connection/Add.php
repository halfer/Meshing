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
		return array(
			'name|n=s' => 'A name to help you remember what this connection is for',
			'adaptor|a=s' => 'The PDO adaptor to use for this connection',
			'host|h=s' => 'The database host for this connection',
			'database|d=s' => 'The name of the database you wish to connect to',
			'user|u=s' => 'The username for this connection',
			'password|p=s' => 'The password for this connection',
			'password-file|f=s' => 'A text file containing the password for this connection',
			'test' => 'Tests the database connection',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('All connections need a name (use --name <name>).');			
		}

		// Check that the connection name is unique
		P2P_Utils::initialiseDb();
		if ($this->connectionExists($this->opts->name))
		{
			throw new Zend_Console_Getopt_Exception('That connection name is already taken');
		}

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

		// @todo Option 'password-file' requires implementation
		if ($this->opts->getOption('password-file'))
		{
			throw new Zend_Console_Getopt_Exception('This option is not currently implemented.');
		}
	}

	protected function connectionExists($name)
	{
		return (bool) P2PConnectionQuery::create()->findOneByName($name);
	}

	/**
	 * Creates a new, named connection
	 * 
	 * @todo Need to validate string lengths etc (or catch exceptions properly)
	 */
	public function run()
	{
		$this->writeRecord();
		$this->rebuildUserConnections();
		$this->testNewConnection();

		echo "Created user connection.\n";
	}

	/**
	 * Writes the connection record
	 * 
	 * @todo Need to validate string lengths etc (or catch exceptions properly)
	 */
	protected function writeRecord()
	{
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
			$connection->setUsername($this->opts->user);
		}
		if ($this->opts->password)
		{
			$connection->setPassword($this->opts->password);
		}
		$connection->save();
	}

	/**
	 * Recreates the connections config files
	 * 
	 * @todo Support --quiet flag in this command
	 */
	protected function rebuildUserConnections()
	{
		$this->buildConnections($sys = false, $nonSys = true, $quiet = false);		
	}

	/**
	 * Connect to the new connection, and throw exception if it fails
	 * 
	 * @return boolean
	 */
	protected function testNewConnection()
	{
		if ($this->opts->test)
		{
			P2P_Utils::initialiseDb();
			try
			{
				$conn = Propel::getConnection($this->opts->name);
			}
			catch (PropelException $e)
			{
				throw new P2P_Console_RunException($e->getMessage());
			}
		}

		return true;
	}
}