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
	
	public function __construct($filename)
	{
		$this->xml = simplexml_load_file($filename, 'Meshing_Schema_Element');
		$this->filename = $filename;

		$this->snippetDir = Meshing_Utils::getProjectRoot() . Meshing_Paths::PATH_SYSTEM_SNIPPETS;

	}

	public function fixup($schemaName)
	{
		// Turn PKs into ordinary columns before adding our own tables (we need their keys ;-)
		$this->xml->makePrimaryKeysOrdinaryColumns();

		// Poke a block of XML into each table (contains new primary keys)
		$this->xml->addTableColumns($this->snippetDir . '/current_header.xml');

		// Add the id table first, so it gets prefixed in the same way as other tables
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
