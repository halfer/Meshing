<?php

/**
 * Container for XML schemas
 *
 * @author jon
 */
class Meshing_Schema_Element extends SimpleXMLElement
{
	/**
	 * Reprefixes the tables just in this schema (leaving other schemas in the same build untouched)
	 *
	 * @param string $tablePrefix
	 */
	public function prefixTablesManually($tablePrefix)
	{
		// Loop through tables and change their name manually
		foreach ($this->xpath('/database/table') as $table)
		{
			$tableNames[] = (string) $table['name'];
			$table['name'] = $tablePrefix . $table['name'];
		}

		// Fix any foreign keys that point within this schema
		foreach ($this->xpath('/database/table/foreign-key') as $foreignKey)
		{
			if (array_search($foreignKey['foreignTable'], $tableNames) !== false)
			{
				$foreignKey['foreignTable'] = $tablePrefix . $foreignKey['foreignTable'];
			}
		}
	}

	/**
	 * Takes a copy of the table name, adds the supplied prefix, then camel-cases the result
	 * 
	 * @param string $tablePrefix A prefix in lower-case underscored format
	 */
	public function setClassPrefix($tablePrefix)
	{
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		foreach ($this->xpath('/database/table') as $table)
		{
			$table['phpName'] = $filter->filter($tablePrefix . '_' . $table['name']);
		}
	}

	public function setPackageName($tablePrefix)
	{
		$this['package'] = $tablePrefix;
		
		// Clear package attribute in tables
		foreach ($this->xpath('/database/table') as $table)
		{
			unset($table['package']);
		}		
	}

	public function insertTable($xmlFile)
	{
		/* @var $snippet SimpleXMLElement */
		$snippet = simplexml_load_file($xmlFile);
		$this->copyXml($snippet, $this);
	}

	/**
	 * Pops a new element in as a child of the root element into the "to" target
	 * 
	 * @param SimpleXMLElement $from
	 * @param SimpleXMLElement $to
	 * @return SimpleXMLElement The newly created element
	 */
	protected function copyXml(SimpleXMLElement $from, SimpleXMLElement $to)
	{
		// Create a new branch in the target, as per the source
		$fromValue = (string) $from;
		if ($fromValue)
		{
			$toChild = $to->addChild($from->getName(), (string) $from);
		}
		else
		{
			$toChild = $to->addChild($from->getName());
		}

		// Copy attributes across
		foreach ($from->attributes() as $name => $value)
		{
			$toChild->addAttribute($name, $value);
		}

		// Copy any children across, recursively
		foreach ($from->children() as $fromChild)
		{
			$this->copyXml($fromChild, $toChild);
		}

		return $toChild;
	}

	/**
	 * Sets/unsets the name attribute in the root element
	 * 
	 * @param string $connName
	 */
	public function setConnectionName($connName = null)
	{
		if (is_null($connName))
		{
			unset($this['name']);
		}
		else
		{
			$this['name'] = $connName;
		}
	}

	/**
	 * Strips all primary key columns from the schema
	 * 
	 * Note: not currently used, but may be useful in the future (8 Oct 2011)
	 */
	public function removePrimaryKeys()
	{
		$keys = $this->xml->xpath('/database/table/column[@primaryKey="true"]');
		/* @var $keyColumn Meshing_Schema_Element */
		foreach ($keys as $keyColumn)
		{
			unset($keyColumn[0]);
		}
	}

	public function makePrimaryKeysOrdinaryColumns()
	{
		// Standard xpath search
		//$search = '/database/table/column[@primaryKey="true"]';
		
		// Temporary fix to avoid user-supplied versionable tables
		$search = $this->xpathGetNonVersionedTables() . '/column[@primaryKey="true"]';
		
		$keys = $this->xml->xpath($search);
		/* @var $keyColumn Meshing_Schema_Element */
		foreach ($keys as $keyColumn)
		{
			unset($keyColumn['primaryKey']);
		}
	}

	/**
	 * Returns an XPath search string to get non-versioned tables
	 * 
	 * @return string
	 */
	protected function xpathGetNonVersionedTables()
	{
		$match = $this->xpathAttributeEndsWith('name', '_versionable');

		return "/database/table[not($match)]";
	}

	/**
	 * Returns an XPath search string to get <reference> nodes we've added in the fixup process
	 * 
	 * @return string
	 */
	public function xpathGetForeignKeyReferences()
	{
		$match = $this->xpathAttributeEndsWith('local', '_creator_node_id');

		return "reference[$match]";
	}

	protected function xpathAttributeEndsWith($attribute, $suffix)
	{
		return "
			substring(
				@$attribute,
				string-length(@$attribute) - string-length('$suffix') + 1
			)
			= '$suffix'
		";
	}

	/**
	 * For every single/composite FK found, a creator column & reference is added
	 * 
	 * @return array List of foreign keys that were repaired
	 */
	public function repairForeignKeys()
	{
		$fks = $this->xml->xpath('/database/table/foreign-key');
		
		foreach ($fks as $foreignKey)
		{
			// Choose foreign ref col name
			$tableName = $foreignKey['foreignTable'];
			$colName = $tableName . '_creator_node_id';

			// Insert <reference> node
			$ref = $foreignKey->addChild('reference');
			$ref['local'] = $colName;
			$ref['foreign'] = 'creator_node_id';

			// Insert a new <column> as referred to in <reference>
			$fkColumn = $foreignKey->getParentNode()->addChild('column');
			$fkColumn['name'] = $colName;
			$fkColumn['type'] = 'integer';
			$fkColumn['required'] = 'true';
		}
		
		return $fks;
	}

	/**
	 * Returns the object parent of the current node
	 * 
	 * @return Meshing_Schema_Element 
	 */
    public function getParentNode()
    {
        return current($this->xpath('parent::*'));
    }

	/**
	 * Adds the specified block to all tables
	 * 
	 * If wrapped in a <dummy-root> for parsing purposes, this is stripped
	 * 
	 * @param string $xmlFile
	 * @param array $tableList Apply to this array of tables (or all if empty)
	 */
	public function addTableColumns($xmlFile, $tableList = array())
	{
		$snippet = simplexml_load_file($xmlFile);
		
		if ($snippet->getName() == 'dummy-root')
		{
			$snippet = $snippet->children();
		}

		// Use the table list if specified, otherwise use all tables
		if (!$tableList)
		{
			$tableList = $this->getTables();
		}

		foreach ($tableList as $table)
		{
			// $snippet is an array of columns, so need to iterate thru them
			foreach ($snippet as $element)
			{
				$this->copyXml($element, $table);
			}
		}
	}

	public function duplicateTables($namePrefix, $nameSuffix)
	{
		$tables = array();
		foreach ($this->xpath($this->xpathGetNonVersionedTables()) as $table)
		{
			$tables[] = $this->duplicateTable($table, $namePrefix, $nameSuffix);
		}

		return $tables;
	}

	/**
	 * Duplicates the specified table, renaming with the specified pre/suffixes
	 * 
	 * @param SimpleXMLElement $table
	 * @param string $namePrefix
	 * @param string $nameSuffix
	 * @return SimpleXMLElement 
	 */
	protected function duplicateTable(SimpleXMLElement $table, $namePrefix, $nameSuffix)
	{
		$newTable = $this->copyXml($table, $this);
		$newTable['name'] = $namePrefix . $table['name'] . $nameSuffix;
		
		return $newTable;
	}

	/**
	 * Gets the full set of SimpleXMLElement table elements
	 * 
	 * May return any iterable type containing tables (array, SimpleXMLElement, etc)
	 * 
	 * @return SimpleXMLElement
	 */
	public function getTables()
	{
		return $this->xpath('/database/table');
	}

	/**
	 * Creates a change table for every table in the schema
	 * 
	 * Should be called after the primary keys in $tables are fixed up
	 */
	public function createChangeTables($xmlFile, $tables)
	{
		$xmlString = file_get_contents($xmlFile);
		$xmlTable = simplexml_load_string($xmlString);

		$changeTables = array();
		foreach($tables as $table)
		{
			/* @var $changeTable SimpleXMLElement */
			$currentTable = (string) $table['name'];
			$xmlTable['name'] = $currentTable;
			$changeTable = $this->duplicateTable($xmlTable, '', '_sent_change');

			// Create foreign key node
			$foreignKey = $changeTable->addChild('foreign-key');
			$foreignKey['foreignTable'] = $currentTable;

			// Get primary keys from $table and copy them into $changeTable
			$keys = $table->xpath('column[@primaryKey="true"]');
			foreach ($keys as $key)
			{
				$foreignName = (string) $key['name'];
				$localName = 'key_' . $foreignName;
				$foreignKeyCol = $this->copyXml($key, $changeTable);
				$foreignKeyCol[ 'name' ] = $localName;

				// We don't want the new foreign key to have any PK features
				unset($foreignKeyCol['primaryKey']);
				unset($foreignKeyCol['autoIncrement']);

				// Populate foreign key constraint
				$ref = $foreignKey->addChild('reference');
				$ref['local'] = $localName;
				$ref['foreign'] = $foreignName;
			}

			$changeTables[] = $changeTable;
		}

		return $changeTables;
	}

	/**
	 * Sets a baseClass attribute at the <database> level
	 * 
	 * @param string $class 
	 */
	public function setCustomBaseClass($class)
	{
		$this['baseClass'] = $class;
	}

	public function setCustomBasePeer($class)
	{
		$this['basePeer'] = $class;		
	}

	/**
	 * Remove auto-increment behaviour from original PK in versionable table
	 */
	public function removeVersionableAutoIncrementing()
	{
		$match = $this->xpathAttributeEndsWith('name', '_versionable');
		$match = "/database/table[$match]/column[@primaryKey=\"true\"][@autoIncrement=\"true\"]";

		foreach ($this->xpath($match) as $column)
		{
			unset($column['autoIncrement']);
		}
	}

	/**
	 * Sets all versionable non-PK columns as nullable (essential for row inserts)
	 */
	public function removeVersionableRequiredAttributes()
	{
		$match = $this->xpathAttributeEndsWith('name', '_versionable');
		$match = "/database/table[$match]/column[not(@primaryKey=\"true\")][@required=\"true\"]";

		foreach ($this->xpath($match) as $column)
		{
			unset($column['required']);
		}		
	}

	public function setBaseClasses($class, $peer, $tableList = array())
	{
		foreach ($tableList as $table)
		{
			$table['baseClass'] = $class;
			$table['basePeer'] = $peer;
		}
	}
}
