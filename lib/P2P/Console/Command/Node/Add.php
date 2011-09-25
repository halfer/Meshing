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
	}

	public function run()
	{
		// @todo Check "identity" table on this connection to see whether a build requires --force
		
		// @todo Create SQL and run SQL on this connection
		$projectRoot = P2P_Utils::getProjectRoot();
		$this->buildSql($projectRoot);
		$this->runSql($projectRoot);
		
		$this->writeRecord();
	}

	/**
	 * Builds the SQL for the node database (doesn't touch the db)
	 * 
	 * Note: it's tempting to build SQL in schema:add, and then run it against any node that uses
	 * the schema. However we can't do that, since we could have one schema across two database
	 * types (unlikely but possible).
	 * 
	 * @todo This is nearly an exact copy from system:build, fix this
	 * 
	 * @param string $projectRoot 
	 */
	protected function buildSql($projectRoot)
	{
		$schemaDir = $projectRoot . '/database/schemas/' . $this->opts->schema;
		$schemas = "schema.xml";
		$outputDir = $projectRoot . '/database/sql/' . $this->opts->name;
		$extraPropsFile = $projectRoot . '/database/system/build.properties';

		// Create task, configure, then run
		$task = new P2P_Propel_SqlBuilder();

		$task->addPropertiesFile($extraPropsFile);
		$task->addSchemas($schemaDir, $schemas);
		$task->setOutputDir($outputDir);

		$task->run();		
	}

	/**
	 * Runs the already-built SQL for the system db (deletes the existing system tables)
	 * 
	 * @todo This is similar to system:build, fix this?
	 * 
	 * @param string $projectRoot 
	 */
	protected function runSql($projectRoot)
	{
		$sqlDir = $projectRoot . '/database/sql/' . $this->opts->name;
		$mapFile = $projectRoot . '/database/system/sqldb.map';

		$task = new P2P_Propel_SqlRunner();
		$task->setSqlDir($sqlDir);
		$task->setMapFile($mapFile);

		// Set build properties
		$task->addProperty('propel.database', $this->connection->getAdaptor());
		$task->addProperty('propel.database.url', $this->connection->getCalculatedDsn());
		$task->addProperty('propel.database.user', $this->connection->getUsername());
		$task->addProperty('propel.database.password', $this->connection->getPassword());

		$task->run();
	}

	protected function writeRecord()
	{
		$node = new P2POwnNode();
		$node->setname($this->opts->name);
		$node->setP2PConnection($this->connection);
		$node->setP2PSchema($this->schema);
		$node->save();		
	}
}