<?php

/**
 * Space to put in customised methods for node peers
 *
 * @author jon
 */
class MeshingBasePeer extends BasePeer
{
	public static function countOldVersions($primaryKey, PropelPDO $con = null, $rowClass = null)
	{
		return self::createTempRow($primaryKey, $rowClass)->countOldVersions($con);
	}

	public static function countNewVersions($primaryKey, PropelPDO $con = null, $rowClass = null)
	{
		return self::createTempRow($primaryKey, $rowClass)->countNewVersions($con);
	}

	public static function countVersions($primaryKey, PropelPDO $con = null, $rowClass = null)
	{
		return self::createTempRow($primaryKey, $rowClass)->countVersions($con);
	}

	/**
	 * Returns temporary instance of the row class
	 * 
	 * @param mixed $primaryKey
	 * @param string $rowClass Must be supplied for PHP <5.3
	 * @return MeshingBaseObject 
	 */
	protected static function createTempRow($primaryKey, $rowClass)
	{
		if (!$rowClass)
		{
			if (function_exists('get_called_class'))
			{
				$rowClass = constant(get_called_class() . '::OM_CLASS');
			}
			else
			{
				throw new Exception(
					'The count methods require a peerClass parameter on PHP <5.3'
				);
			}
		}

		// Cheat by creating a temporary instance of this row
		$object = new $rowClass();
		$object->setPrimaryKey($primaryKey);

		return $object;
	}
}