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

	// Default base class names
	protected $baseName = 'MeshingBaseObject';
	protected $basePeer = 'MeshingBasePeer';
	
	public function __construct($inFilename, $outFilename)
	{
		$this->xml = simplexml_load_file($inFilename, 'Meshing_Schema_Element');
		$this->filename = $outFilename;

		$this->snippetDir = Meshing_Utils::getProjectRoot() . Meshing_Utils::getPaths()->getPathSystemSnippets();

	}

	/**
	 * Applies the standard 'fixup' process to node schemas
	 *
	 * @param string $schemaName The folder name that the resulting model will be accessed under
	 * @param string $tablePrefix Usually the same
	 */
	public function fixup($schemaName, $tablePrefix = null)
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

		// Use base classes only for real tables (not KnownNodes or Versionables)
		$this->xml->setBaseClasses($this->baseName, $this->basePeer, $realTables);

		// Make various changes to versionable tables
		$this->xml->removeVersionableAutoIncrementing();
		$this->xml->removeVersionableRequiredAttributes();

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

		// Do class prefixing before table prefixing, since it uses unprefixed table names
		if ($tablePrefix)
		{
			$this->xml->setClassPrefix($schemaName);
			$this->xml->prefixTablesManually($tablePrefix . '_');
		}
		else
		{
			$this->xml->prefixTablesManually($schemaName . '_');			
		}

		// Use the schema name as a package name
		$this->xml->setPackageName($schemaName);
		
		// Save the file under the same name
		$this->xml->asXML($this->filename);
	}

	public function setBaseClass($baseName)
	{
		$this->baseName = $baseName;
	}

	public function setBasePeer($basePeer)
	{
		$this->basePeer = $basePeer;
	}
}
