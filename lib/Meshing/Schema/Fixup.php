<?php

/**
 * Takes an XML schema and makes necessary modifications for Meshing
 *
 * @author jon
 */
class Meshing_Schema_Fixup
{
	/* @var $xml Meshing_Schema_Element */
	protected $xml;
	protected $filename;
	
	public function __construct($inFilename, $outFilename)
	{
		$this->xml = simplexml_load_file($inFilename, 'Meshing_Schema_Element');
		$this->filename = $outFilename;

		$this->snippetDir = Meshing_Utils::getProjectRoot() . Meshing_Utils::getPaths()->getPathSystemSnippets();

	}

	public function fixup($schemaName)
	{
		// Change existing FKs into composite keys (add creator node col)
		$this->xml->repairForeignKeys();
		
		// Save the real tables in an array
		$realTables = $this->xml->getTables();

		// Duplicate all the tables and get their refs in another array
		$versionableTables = $this->xml->duplicateTables(
			$prefix = '',
			$suffix = '_versionable'
		);

		// Poke a block of XML into each real table (contains primary keys)
		$this->xml->addTableColumns(
			$this->snippetDir . '/current_header.xml',
			$realTables
		);

		// Poke a block of XML into each versionable table (ditto)
		$this->xml->addTableColumns(
			$this->snippetDir . '/versionable_header.xml',
			$versionableTables
		);

		// Add the identity table, so it gets prefixed in the same way as other tables
		$this->xml->insertTable($this->snippetDir . '/node_identity.xml');

		// Now add the known nodes table
		$this->xml->insertTable($this->snippetDir . '/known_nodes.xml');

		// Use the schema name as a table prefix and as a package name
		$prefix = strtolower($schemaName);
		$this->xml->prefixTablesManually($prefix . '_');
		$this->xml->setPackageName($prefix);

		// Models need a real Propel conn as default (but we will always use a non-default conn)
		$this->xml->setConnectionName(Meshing_Utils::SYSTEM_CONNECTION);
		
		// Save the file under the same name
		$this->xml->asXML($this->filename);
	}
}
