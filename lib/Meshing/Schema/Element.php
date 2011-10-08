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
		$suffix = '_versionable';
		$match = "
			substring(
				@name,
				string-length(@name) - string-length('$suffix') + 1
			)
			= '$suffix'
		";
		$search = "
			/database/table[not($match)]/column[@primaryKey=\"true\"]
		";
		
		$keys = $this->xml->xpath($search);
		/* @var $keyColumn Meshing_Schema_Element */
		foreach ($keys as $keyColumn)
		{
			unset($keyColumn['primaryKey']);
		}
	}

	/**
	 * Adds the specified block to all tables
	 * 
	 * If wrapped in a <dummy-root> for parsing purposes, this is stripped
	 * 
	 * @param string $xmlFile 
	 */
	public function addTableColumns($xmlFile)
	{
		$snippet = simplexml_load_file($xmlFile);
		
		if ($snippet->getName() == 'dummy-root')
		{
			$snippet = $snippet->children();
		}
		
		foreach ($this->xpath('/database/table') as $table)
		{
			// Temporary fix to avoid user-supplied version tables
			if (!preg_match('/_versionable$/', $table['name']))
			{
				// $snippet is an array of columns, so need to iterate thru them
				foreach ($snippet as $element)
				{
					$this->copyXml($element, $table);
				}
			}
		}
	}
}
