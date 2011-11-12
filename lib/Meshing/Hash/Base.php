<?php

/**
 * A simple hash provider and hash strategy provider
 *
 * Simply overload any method here and change the instantiation in Meshing_Paths,
 * to implement new hash types or hashing strategies.
 * 
 * @author jon
 */
class Meshing_Hash_Base
{
	/**
	 * Gets hash of current object, or previous specified version
	 * 
	 * @param PropelPDO $con The integer of the version required
	 * @param integer $version
	 */
	public function getHash(BaseObject $object, PropelPDO $con = null, $version = null)
	{
		// Initial check (@todo maybe it would be OK to return null here?)
		if ($object->isNew())
		{
			throw new Exception('New rows do not have hashes set');
		}

		$crit = $object->getSelectAllVersionsCriteria();
		$vsnColName = constant($object->getVersionablePeerName() . '::VERSION');

		if (is_null($version))
		{
			// To get the current item, save a select by grabbing the latest version row
			$crit->addDescendingOrderByColumn($vsnColName);
		}
		else
		{
			// Do some checks on the supplied version number
			if ($version < 1)
			{
				throw new Exception('The version number must be 1 or greater');
			}

			$maxVersion = $object->countVersions($con);
			if ($version > $maxVersion)
			{
				throw new Exception('There are not that many versions for this row');
			}

			$crit->add($vsnColName, $version);
		}

		// Grabs the latest/only row depending on above criteria
		$row = call_user_func(
			array($object->getVersionablePeerName(), 'doSelectOne'),
			$crit,
			$con
		);

		return $row->getMeshingHash();
	}

	/**
	 * Calculate hash for this row
	 * 
	 * The hashing strategy is suggested to be thus. Ordinary columns are concatenated
	 * in their table order, and the hashing function applied to the result. However
	 * for selected columns (usually lazy-loaded ones) their value is replaced with
	 * a cached copy of the function applied to that column only. This ensures that
	 * a hash can be re-calculated without having to load lazy-loaded columns, which
	 * may be slow and memory-hungry.
	 * 
	 * So it might look a bit like this:
	 * 
	 *		hash(a + b + c + hash(blob_d) + ...)
	 * 
	 * The cached hashes may be stored either in the same versionable table, or a
	 * parallel table (the former to start with, as it's easier).
	 * 
	 * @author jon
	 */
	public function calcHash(BaseObject $object, $hashFunction)
	{
		/* @var $vsnTableMap TableMap */
		/* @var $hashTableMap TableMap */
		$thisMapName = $object->getMapName();
		$thisTableMap = new $thisMapName();
		$vsnMapName = $object->getVersionableMapName();
		$vsnTableMap = new $vsnMapName();

		/* @var $columnMap ColumnMap */
		$values = array();
		foreach($thisTableMap->getColumns() as $columnMap)
		{
			$columnName = $columnMap->getName();

			// See if a cached hash exists for this column (@todo avoid hard-wired suffix)
			$hashColumnName = $columnName . '_HASH_CACHE';
			$isCached = $vsnTableMap->containsColumn($hashColumnName);

			if ($isCached)
			{
				// Get hash; bomb out if it doesn't exist (even nulls are hashed)
				$hash = $object->getByName($hashColumnName, BasePeer::TYPE_RAW_COLNAME);
				if (!$hash)
				{
					throw new Exception("No hash found for column '$columnName'");
				}
				$value = $hashFunction($hash);
			}
			else
			{
				// Trivial case - just concatenate the column value
				$value = $object->getByName($columnName, BasePeer::TYPE_RAW_COLNAME);		
			}

			$values[] = $value;
		}

		return $hashFunction(implode('', $values));
	}
}
