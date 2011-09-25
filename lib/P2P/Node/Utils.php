<?php

/**
 * Various util methods to 
 *
 * @author jon
 */
class P2P_Node_Utils
{
	/**
	 * Derives the name of the node ID class given a schema name
	 * 
	 * @param string $schemaName
	 */
	public static function getIdentityClassName($schemaName)
	{
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		$prefix = $filter->filter($schemaName);
		
		return $prefix . 'MeshingIdentity';
	}
}
