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
}
