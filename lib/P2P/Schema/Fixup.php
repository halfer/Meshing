<?php

/**
 * Takes an XML schema and makes necessary modifications for Meshing
 *
 * @author jon
 */
class P2P_Schema_Fixup
{
	/* @var $xml P2P_Schema_Element */
	protected $xml;
	protected $filename;
	
	public function __construct($filename)
	{
		$this->xml = simplexml_load_file($filename, 'P2P_Schema_Element');
		$this->filename = $filename;
	}

	public function fixup($schemaName)
	{
		// Do this first, so it gets prefixed in the same way as other tables
		$this->xml->insertTable(
			P2P_Utils::getProjectRoot() . '/database/system/snippets/node_identity.xml'
		);

		// Use the schema name as a table prefix and as a package name
		$prefix = strtolower($schemaName);
		$this->xml->prefixTablesManually($prefix . '_');
		$this->xml->setPackageName($prefix);

		// Models need a real Propel conn as default (but we will always use a non-default conn)
		$this->xml->setConnectionName(P2P_Utils::SYSTEM_CONNECTION);
		
		// Save the file under the same name
		$this->xml->asXML($this->filename);
	}
}