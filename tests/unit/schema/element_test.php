<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise(new Meshing_Paths());

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
		foreach ($this->xml->xpath('/database/table/foreign-key') as $i => $foreignKey)
		{
			$tableName = (string) $foreignKey['foreignTable'];			
			$ok = $ok && ($tableName == $prefix . $fTableNames[$i]);
		}
		$this->assertTrue($ok, 'Checking prefixing on foreign key references');
	}

	/**
	 * Checks the package name is set correctly
	 */
	public function testPackageName()
	{		
		// First value changes it from empty, second checks it can be changed
		foreach (array( 'bonjour', 'au_revoir' ) as $packageName)
		{
			// Set up random package names on existing tables
			foreach ($this->xml->xpath('/database/table') as $table)
			{
				$table['package'] = 'package_' . rand(1, 1000);
			}

			// Reset database-level package name
			$this->xml->setPackageName($packageName);		
			$post = $this->getAttribute($this->xml, 'package');
			$this->assertTrue($packageName == $post, 'Setting schema database package name');
			
			// Check that all table-level packages are unset
			$ok = true;
			foreach ($this->xml->xpath('/database/table') as $table)
			{
				$val = $this->getAttribute($table, 'package');
				if (!is_null($val))
				{
					$ok = false;
				}
			}
			$this->assertTrue($ok, 'Checking all table-level package names are cleared');
		}
	}

	protected function getAttribute(Meshing_Schema_Element $xml, $name)
	{
		$attribs = (array) $xml->attributes();
		$value = null;
		if (array_key_exists('@attributes', $attribs))
		{
			if (array_key_exists($name, $attribs['@attributes']))
			{
				$value = $attribs['@attributes'][$name];
			}
		}

		return $value;
	}

	/**
	 * Tests that one table copies ok into another schema
	 *
	 * @todo Check that the structure is copied completely & accurately
	 */
	public function testInsertTable()
	{
		// Grab table to insert
		$filename = realpath(dirname(__FILE__)) . '/files/insert_table.xml';
		$this->xml->insertTable($filename);

		// This should exist
		$newTables = $this->xml->xpath('/database/table[@name="saucer_sightings"]');
		$this->assertTrue((boolean) $newTables, 'Insert table into existing schema');

		// This should not exist
		$newTables = $this->xml->xpath('/database/table[@name="badger_sightings"]');
		$this->assertFalse((boolean) $newTables, 'A table that should not exist appears to exist');
	}

	public function testConnName()
	{
		$connName = 'guten_tag';
		$this->xml->setConnectionName($connName);		
		$post = $this->getAttribute($this->xml, 'name');
		$this->assertTrue($connName == $post, 'Setting schema connection name');		
	}

	public function testGetParent()
	{
		foreach ($this->xml->xpath('/database/table/foreign-key') as $foreignKey)
		{
			$parent = $foreignKey->getParentNode();
			$this->assertEqual($parent->getName(), 'table', 'Checking getting parent node');
		}

		foreach ($this->xml->xpath('/database/table') as $table)
		{
			$parent = $table->getParentNode();
			$this->assertEqual($parent->getName(), 'database', 'Checking getting parent node');
		}
	}

	public function testRepairForeignKeys()
	{
		$fks = $this->xml->repairForeignKeys();
		
		// Check that each <foreign-key> block has a reference to the new local creator column
		foreach ($fks as $foreignKey)
		{
			$ref = $foreignKey->xpath($foreignKey->xpathGetForeignKeyReferences());
			$ref = count($ref) == 1 ? $ref[0] : null;
			$this->assertTrue(
				($ref instanceof Meshing_Schema_Element),
				'Checking foreign keys each have one new creator node reference'
			);

			// Check that the table parent of the fk has a new column
			$foreignTableName = $ref['local'];
			$newKeyColumn = $foreignKey->getParentNode()->xpath(
				'column[@name="' . $foreignTableName . '"]'
			);
			$newKeyColumn = count($newKeyColumn) == 1 ? $newKeyColumn[0] : null;
			$this->assertTrue(
				$newKeyColumn instanceof Meshing_Schema_Element,
				'Checking foreign keys are accompanied by one new foreign key column'
			);
		}
	}
}