<?php

/**
 * Description of WithoutVersion
 *
 * @author jon
 */
class Meshing_Hash_Strategy_WithoutVersion extends Meshing_Hash_Strategy_Base
{
	protected function getHashableColumns(TableMap $tableMap)
	{
		return $tableMap->getColumns();
	}
}
