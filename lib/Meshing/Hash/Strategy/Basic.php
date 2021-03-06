<?php

/**
 * A simple hash provider and hash strategy provider
 *
 * Simply overload any method here and change the instantiation in Meshing_Paths,
 * to implement new hash types or hashing strategies.
 * 
 * @author jon
 */
class Meshing_Hash_Strategy_Basic
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
	 * Note: version number is sanity-checked in MeshingBaseObject->getHash()
	 * 
	 * @param BaseObject $object
	 * @param integer $version The integer of the version required
	 */
	public function getHash(BaseObject $object, $version = null)
	{
		// Return null if not saved, as there is no previous hash to get
		if ($object->isNew())
		{
			return null;
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
			$crit->add($vsnColName, $version);
		}

		// Grabs the latest/only row depending on above criteria
		$row = call_user_func(
			array($object->getVersionablePeerName(), 'doSelectOne'),
			$crit,
			$this->con
		);

		// There's a gap between saving a row and its version row. So, if we're in an insert
		// and using the Version hash provider, we must catch having no versionable row.
		if (!$row)
		{
			return null;
		}

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
	 * So it might look like this: hash(a + b + c + hash(blob_d) + ...)
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

			$values[] = $value . $this->getValueTerminator($value);
		}

		// Last chance for child classes to modify before it gets hashed
		$values = $this->preHash($object, $values);

		return $hashFunction(implode('', $values));
	}

	protected function getHashableColumns(MeshingBaseObject $object, TableMap $tableMap)
	{
		return $tableMap->getColumns();
	}

	public function getValueTerminator($value)
	{
		return (is_null($value) ? 0 : 1) . '|';
	}

	protected function preHash(MeshingBaseObject $object, array $values)
	{
		return $values;
	}

	/**
	 * Gets value for row table
	 * 
	 * Swaps foreign creator_node_id values for their unique FQDN value. Note that the other
	 * part(s) to a primary or foreign key is set by the creator and is the same in all nodes,
	 * so may be hashed without causing difference problems between nodes.
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
