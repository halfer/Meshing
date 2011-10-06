<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise();

// Init simpletest
require_once 'simpletest/autorun.php';

class SchemaElementTestCase extends UnitTestCase
{
	public function testCreation()
	{
		// Create test XML file
		$filename = realpath(dirname(__FILE__)) . '/files/test_schema1.xml';
		$xml = simplexml_load_file($filename, 'Meshing_Schema_Element');
		
		$this->prefixing($xml);
		// @todo setPackageName
		// @todo insertTable
		// @todo setConnectionName
	}

	public function prefixing(Meshing_Schema_Element $xml)
	{
		// Grab all the table names
		$tableNames = array();
		foreach ($xml->xpath('/database/table') as $i => $table)
		{
			$tableNames[] = (string) $table['name'];
		}
		
		$prefix = 'hello';
		$xml->prefixTablesManually($prefix);
		
		$ok = true;
		foreach ($xml->xpath('/database/table') as $i => $table)
		{
			$tableName = (string) $table['name'];
			$ok = $ok && ($tableName == $prefix . $tableNames[$i]);
		}
		$this->assertTrue($ok, 'Checking table prefixing');
	}
}