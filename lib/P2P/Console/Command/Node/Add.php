<?php

/**
 * Description of Add
 *
 * @author jon
 */
class P2P_Console_Command_Node_Add extends P2P_Console_Base implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Creates a new node instance';
	}

	public function getOpts()
	{
		return array(
			'name|n=s' => 'The name of the new node',
			'connection|c=s' => 'The name of the database connection to store this node',
			'schema|s=s' => 'The schema to build in this node',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('The node must have a name (use --name)');
		}

		if (!$this->opts->connection)
		{
			throw new Zend_Console_Getopt_Exception('The node must have a connection (use --connection)');
		}

		if (!$this->opts->schema)
		{
			throw new Zend_Console_Getopt_Exception('The node must have a schema (use --schema)');
		}

		// Check that the name supplied is unique
		P2P_Utils::initialiseDb();
		$node = P2POwnNodeQuery::create()->findOneByName($this->opts->name);
		if ($node)
		{
			throw new Zend_Console_Getopt_Exception('A node of that name already exists');
		}

		// Check that the connection exists
		$this->connection = P2PConnectionQuery::create()->findOneByName($this->opts->connection);
		if (!$this->connection)
		{
			throw new Zend_Console_Getopt_Exception('The specified connection is not registered');
		}

		// Check that the schema exists
		$this->schema = P2PSchemaQuery::create()->findOneByName($this->opts->schema);
		if (!$this->schema)
		{
			throw new Zend_Console_Getopt_Exception('The specified schema is not registered');
		}
		
		// @todo Check identity table on this connection to see whether a build requires confirmation
		echo "Doesn't yet build the schema, or check what's in the db first\n";
	}

	public function run()
	{
		$node = new P2POwnNode();
		$node->setname($this->opts->name);
		$node->setP2PConnection($this->connection);
		$node->setP2PSchema($this->schema);
		$node->save();
	}
}