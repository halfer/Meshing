<?php



/**
 * Skeleton subclass for performing query and update operations on the 'meshing_schema' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.system
 */
class MeshingSchemaPeer extends BaseMeshingSchemaPeer
{
	public static function getSchemaForNode($node)
	{
		// Check that a node class has been passed
		if (!method_exists($node, 'getSchemaId'))
		{
			throw new Exception('Object passed that is not an KnownNode');
		}
		
		return self::retrieveByPK($node->getSchemaId());
	}
}