<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise();

// Init simpletest
require_once 'simpletest/autorun.php';

class SchemaElementTestCase extends UnitTestCase
{
	public function setUp()
	{
		// Create test XML object
		$filename = realpath(dirname(__FILE__)) . '/files/test_schema1.xml';
		$this->xml = simplexml_load_file($filename, 'Meshing_Schema_Element');
    }

	public function testPrefixing()
	{
		// Grab all the table names
		$tableNames = array();
		foreach ($this->xml->xpath('/database/table') as $table)
		{
			$tableNames[] = (string) $table['name'];
		}
		
		// Grab all the foreign table names
		$fTableNames = array();
		foreach ($this->xml->xpath('/database/table/foreign-key') as $i => $table)
		{
			$fTableNames[] = (string) $table['foreignTable'];
		}
		
		// Do the prefixing op
		$prefix = 'hello';
		$this->xml->prefixTablesManually($prefix);

		// Test the table changes first
		$ok = true;
		foreach ($this->xml->xpath('/database/table') as $i => $table)
		{
			$tableName = (string) $table['name'];
			$ok = $ok && ($tableName == $prefix . $tableNames[$i]);
		}
		$this->assertTrue($ok, 'Checking table prefixing');

		// Test the foreign table references as well
		$ok = true;
		foreach ($this->xml->xpath('/database/table/foreign-key') as $i => $table)
		{
			$tableName = (string) $table['foreignTable'];			
			$ok = $ok && ($tableName == $prefix . $fTableNames[$i]);
		}
		$this->assertTrue($ok, 'Checking prefixing on foreign key references');
	}

	public function testPackageName()
	{
		
	}

	public function testInsertTable()
	{
		
	}

	public function testConnName()
	{
		
	}
}