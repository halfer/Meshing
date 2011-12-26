<?php

/**
 * Various util methods to 
 *
 * @author jon
 */
class Meshing_Node_Utils
{
	/**
	 * Returns a classname for a given schema & class
	 * 
	 * @param string $schemaName
	 * @param string $className
	 * @return string
	 */
	public static function getNodeClassName($schemaName, $className)
	{
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		$prefix = $filter->filter($schemaName);
		
		return $prefix . $className;		
	}

	/**
	 * Derives the name of the node ID class, given a schema name
	 * 
	 * @param string $schemaName
	 */
	public static function getIdentityClassName($schemaName)
	{
		return self::getNodeClassName($schemaName, 'MeshingIdentity');
	}

	/**
	 * Derives the name of the node ID peer class, given a schema name
	 * 
	 * @param type $schemaName
	 * @return type 
	 */
	public static function getIdentityPeerClassName($schemaName)
	{
		return self::getIdentityClassName($schemaName) . 'Peer';
	}

	public static function getConnectionForNode(P2POwnNode $node)
	{
		$conName = $node->getP2PConnection()->getName();

		return Propel::getConnection($conName);
	}
}
