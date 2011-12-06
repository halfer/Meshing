<?php


/**
 * Base class that represents a query for the 'meshing_schema_table' table.
 *
 * 
 *
 * @method     MeshingSchemaTableQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MeshingSchemaTableQuery orderBySchemaId($order = Criteria::ASC) Order by the schema_id column
 * @method     MeshingSchemaTableQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     MeshingSchemaTableQuery groupById() Group by the id column
 * @method     MeshingSchemaTableQuery groupBySchemaId() Group by the schema_id column
 * @method     MeshingSchemaTableQuery groupByName() Group by the name column
 *
 * @method     MeshingSchemaTableQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MeshingSchemaTableQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MeshingSchemaTableQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MeshingSchemaTableQuery leftJoinMeshingSchema($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingSchema relation
 * @method     MeshingSchemaTableQuery rightJoinMeshingSchema($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingSchema relation
 * @method     MeshingSchemaTableQuery innerJoinMeshingSchema($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingSchema relation
 *
 * @method     MeshingSchemaTable findOne(PropelPDO $con = null) Return the first MeshingSchemaTable matching the query
 * @method     MeshingSchemaTable findOneOrCreate(PropelPDO $con = null) Return the first MeshingSchemaTable matching the query, or a new MeshingSchemaTable object populated from the query conditions when no match is found
 *
 * @method     MeshingSchemaTable findOneById(int $id) Return the first MeshingSchemaTable filtered by the id column
 * @method     MeshingSchemaTable findOneBySchemaId(int $schema_id) Return the first MeshingSchemaTable filtered by the schema_id column
 * @method     MeshingSchemaTable findOneByName(string $name) Return the first MeshingSchemaTable filtered by the name column
 *
 * @method     array findById(int $id) Return MeshingSchemaTable objects filtered by the id column
 * @method     array findBySchemaId(int $schema_id) Return MeshingSchemaTable objects filtered by the schema_id column
 * @method     array findByName(string $name) Return MeshingSchemaTable objects filtered by the name column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingSchemaTableQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMeshingSchemaTableQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'MeshingSchemaTable', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MeshingSchemaTableQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MeshingSchemaTableQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MeshingSchemaTableQuery) {
			return $criteria;
		}
		$query = new MeshingSchemaTableQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    MeshingSchemaTable|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MeshingSchemaTablePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MeshingSchemaTablePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MeshingSchemaTablePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingSchemaTablePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the schema_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySchemaId(1234); // WHERE schema_id = 1234
	 * $query->filterBySchemaId(array(12, 34)); // WHERE schema_id IN (12, 34)
	 * $query->filterBySchemaId(array('min' => 12)); // WHERE schema_id > 12
	 * </code>
	 *
	 * @see       filterByMeshingSchema()
	 *
	 * @param     mixed $schemaId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterBySchemaId($schemaId = null, $comparison = null)
	{
		if (is_array($schemaId)) {
			$useMinMax = false;
			if (isset($schemaId['min'])) {
				$this->addUsingAlias(MeshingSchemaTablePeer::SCHEMA_ID, $schemaId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaId['max'])) {
				$this->addUsingAlias(MeshingSchemaTablePeer::SCHEMA_ID, $schemaId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingSchemaTablePeer::SCHEMA_ID, $schemaId, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaTablePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query by a related MeshingSchema object
	 *
	 * @param     MeshingSchema|PropelCollection $meshingSchema The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByMeshingSchema($meshingSchema, $comparison = null)
	{
		if ($meshingSchema instanceof MeshingSchema) {
			return $this
				->addUsingAlias(MeshingSchemaTablePeer::SCHEMA_ID, $meshingSchema->getId(), $comparison);
		} elseif ($meshingSchema instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingSchemaTablePeer::SCHEMA_ID, $meshingSchema->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByMeshingSchema() only accepts arguments of type MeshingSchema or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingSchema relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function joinMeshingSchema($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingSchema');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'MeshingSchema');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingSchema relation MeshingSchema object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingSchemaQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingSchemaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingSchema($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingSchema', 'MeshingSchemaQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MeshingSchemaTable $meshingSchemaTable Object to remove from the list of results
	 *
	 * @return    MeshingSchemaTableQuery The current query, for fluid interface
	 */
	public function prune($meshingSchemaTable = null)
	{
		if ($meshingSchemaTable) {
			$this->addUsingAlias(MeshingSchemaTablePeer::ID, $meshingSchemaTable->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseMeshingSchemaTableQuery
