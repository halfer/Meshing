<?php

/**
 * Description of Delete
 *
 * @author jon
 */
class Meshing_Console_Command_Schema_Delete extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Deletes a schema XML document from the database';
	}

	public function getOpts()
	{
		return array(
			'name|n=s' => 'An identifying name for the schema',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('You need to specify which schema (use --name)');
		}

		// Check that the schema exists
		Meshing_Utils::initialiseDb();
		$this->schema = P2PSchemaQuery::create()->findOneByName($this->opts->name);
		if (!$this->schema)
		{
			throw new Zend_Console_Getopt_Exception('That schema is not registered');
		}

		// @todo Check that the schema is not in use on a node
		// ...
	}

	public function run()
	{
		$this->dropRecord();
		$this->deleteDirectories();
	}

	protected function dropRecord()
	{
		$this->schema->delete();
	}

	protected function deleteDirectories()
	{
		$projectRoot = Meshing_Utils::getProjectRoot();
		$schemaDir = $projectRoot . '/database/schemas/' . $this->opts->name;
		$modelDir = $projectRoot . '/database/models/' . $this->opts->name;
		
		echo "Done.\n";

		$ok = @rmdir($schemaDir);
		$ok = $ok && @rmdir($modelDir);
		
		if (!$ok)
		{
			echo "Not (yet) deleting empty dirs. Please run these, if safe:\n";
			echo "rm -rf " . $schemaDir . "\n";
			echo "rm -rf " . $modelDir . "\n";
		}
	}
}