<?php

/**
 * A simple hash provider and hash strategy provider
 *
 * Simply overload any method here and change the instantiation in Meshing_Paths,
 * to implement new hash types or hashing strategies.
 * 
 * @author jon
 */
abstract class Meshing_Hash_Strategy_Base
{
	const CACHE_COLUMN_SUFFIX = 'HASH_CACHE';

	protected $con;

	/**
	 * Set up Propel connection to use on any db ops required in this class
	 */
	public function __construct(PropelPDO $con = null)
	{
		$this->con = $con;
	}
	
	/**
	 * Gets hash of current object, or previous specified version
	 * 
	 * @param BaseObject $object
	 * @param integer $version The integer of the version required
	 */
	public function getHash(BaseObject $object, $version = null)
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
			$this->con
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
	public function calcHash(MeshingBaseObject $object, $hashFunction)
	{
		/* @var $vsnTableMap TableMap */
		/* @var $hashTableMap TableMap */
		$thisMap = $object->getRowMap();
		$vsnTableMap = $object->getVersionableMap();

		/* @var $columnMap ColumnMap */
		$values = array();
		foreach($this->getHashableColumns($object, $thisMap) as $columnMap)
		{
			$columnName = $columnMap->getName();

			// See if a cached hash exists for this column in the version table
			$hashColumnName = $columnName . self::CACHE_COLUMN_SUFFIX;
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
				$value = $this->getRowValue($object, $columnMap);
			}

			$values[] = $value;
		}

		// Last chance for child classes to modify before it gets hashed
		$values = $this->preHash($object, $values);

		return $hashFunction(implode('', $values));
	}

	protected function getHashableColumns(MeshingBaseObject $object, TableMap $tableMap)
	{
		return $tableMap->getColumns();
	}

	protected function preHash(MeshingBaseObject $object, array $values)
	{
		return $values;
	}

	/**
	 * Gets value for row table
	 * 
	 * Swaps foreign creator_node_id values for their unique FQDN value
	 * 
	 * @todo Better node table detection required (should use known prefix)
	 * @todo Fix column name hardwiring
	 * 
	 * @param MeshingBaseObject $object
	 * @param ColumnMap $columnMap
	 * @return mixed 
	 */
	protected function getRowValue(MeshingBaseObject $object, ColumnMap $columnMap)
	{
		// Get value for this column
		$columnName = $columnMap->getName();
		$value = $object->getByName($columnName, BasePeer::TYPE_RAW_COLNAME);

		// If the related table name ends with '_known_node' then we assume this is a
		// FK to a creator node ID.
		if ($columnMap->isForeignKey())
		{
			$match = '_known_node';
			$isNodeTable =
				$match == substr($columnMap->getRelatedTableName(), -strlen($match))
			;
			if ($isNodeTable && ($columnMap->getRelatedColumnName() == 'ID'))
			{
				$nodePeerName = $columnMap->getRelation()->getForeignTable()->getPeerClassname();
				$node = call_user_func(
					array($nodePeerName, 'retrieveByPK'),
					$value,
					$this->con
				);

				// If there is no related node, we really do have problems!
				if (!$node)
				{
					$primaryKey = $object->getPrimaryKey();
					if (is_array($primaryKey))
					{
						$primaryKey = '{' . implode(',', $primaryKey) . '}';
					}
					$type = get_class($object);
					throw new Exception("Row $primaryKey in table '$type' points to a non-existent node row");
				}

				$value = $node->getFqdn();
			}
		}

		return $value;
	}
}
