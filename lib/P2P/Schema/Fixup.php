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

		$prefix = strtolower($schemaName);
		$this->xml->prefixTablesManually($prefix . '_');
		$this->xml->setPackageName($prefix);
		
		// Save the file under the same name
		$this->xml->asXML($this->filename);
	}
}
