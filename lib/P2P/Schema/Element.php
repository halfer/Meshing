<?php

/**
 * Container for XML schemas
 *
 * @author jon
 */
class P2P_Schema_Element extends SimpleXMLElement
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
}
