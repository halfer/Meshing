<?php


/**
 * Base class that represents a query for the 'p2p_schema_table' table.
 *
 * 
 *
 * @method     P2PSchemaTableQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     P2PSchemaTableQuery orderBySchemaId($order = Criteria::ASC) Order by the schema_id column
 * @method     P2PSchemaTableQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     P2PSchemaTableQuery orderByRowOrdCurrent($order = Criteria::ASC) Order by the row_ord_current column
 *
 * @method     P2PSchemaTableQuery groupById() Group by the id column
 * @method     P2PSchemaTableQuery groupBySchemaId() Group by the schema_id column
 * @method     P2PSchemaTableQuery groupByName() Group by the name column
 * @method     P2PSchemaTableQuery groupByRowOrdCurrent() Group by the row_ord_current column
 *
 * @method     P2PSchemaTableQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     P2PSchemaTableQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     P2PSchemaTableQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     P2PSchemaTableQuery leftJoinP2PSchema($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2PSchema relation
 * @method     P2PSchemaTableQuery rightJoinP2PSchema($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2PSchema relation
 * @method     P2PSchemaTableQuery innerJoinP2PSchema($relationAlias = null) Adds a INNER JOIN clause to the query using the P2PSchema relation
 *
 * @method     P2PSchemaTable findOne(PropelPDO $con = null) Return the first P2PSchemaTable matching the query
 * @method     P2PSchemaTable findOneOrCreate(PropelPDO $con = null) Return the first P2PSchemaTable matching the query, or a new P2PSchemaTable object populated from the query conditions when no match is found
 *
 * @method     P2PSchemaTable findOneById(int $id) Return the first P2PSchemaTable filtered by the id column
 * @method     P2PSchemaTable findOneBySchemaId(int $schema_id) Return the first P2PSchemaTable filtered by the schema_id column
 * @method     P2PSchemaTable findOneByName(string $name) Return the first P2PSchemaTable filtered by the name column
 * @method     P2PSchemaTable findOneByRowOrdCurrent(int $row_ord_current) Return the first P2PSchemaTable filtered by the row_ord_current column
 *
 * @method     array findById(int $id) Return P2PSchemaTable objects filtered by the id column
 * @method     array findBySchemaId(int $schema_id) Return P2PSchemaTable objects filtered by the schema_id column
 * @method     array findByName(string $name) Return P2PSchemaTable objects filtered by the name column
 * @method     array findByRowOrdCurrent(int $row_ord_current) Return P2PSchemaTable objects filtered by the row_ord_current column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseP2PSchemaTableQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseP2PSchemaTableQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'default', $modelName = 'P2PSchemaTable', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new P2PSchemaTableQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    P2PSchemaTableQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof P2PSchemaTableQuery) {
			return $criteria;
		}
		$query = new P2PSchemaTableQuery();
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
	 * @return    P2PSchemaTable|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = P2PSchemaTablePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(P2PSchemaTablePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(P2PSchemaTablePeer::ID, $keys, Criteria::IN);
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
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(P2PSchemaTablePeer::ID, $id, $comparison);
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
	 * @see       filterByP2PSchema()
	 *
	 * @param     mixed $schemaId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterBySchemaId($schemaId = null, $comparison = null)
	{
		if (is_array($schemaId)) {
			$useMinMax = false;
			if (isset($schemaId['min'])) {
				$this->addUsingAlias(P2PSchemaTablePeer::SCHEMA_ID, $schemaId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaId['max'])) {
				$this->addUsingAlias(P2PSchemaTablePeer::SCHEMA_ID, $schemaId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(P2PSchemaTablePeer::SCHEMA_ID, $schemaId, $comparison);
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
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
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
		return $this->addUsingAlias(P2PSchemaTablePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the row_ord_current column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRowOrdCurrent(1234); // WHERE row_ord_current = 1234
	 * $query->filterByRowOrdCurrent(array(12, 34)); // WHERE row_ord_current IN (12, 34)
	 * $query->filterByRowOrdCurrent(array('min' => 12)); // WHERE row_ord_current > 12
	 * </code>
	 *
	 * @param     mixed $rowOrdCurrent The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByRowOrdCurrent($rowOrdCurrent = null, $comparison = null)
	{
		if (is_array($rowOrdCurrent)) {
			$useMinMax = false;
			if (isset($rowOrdCurrent['min'])) {
				$this->addUsingAlias(P2PSchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($rowOrdCurrent['max'])) {
				$this->addUsingAlias(P2PSchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(P2PSchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent, $comparison);
	}

	/**
	 * Filter the query by a related P2PSchema object
	 *
	 * @param     P2PSchema|PropelCollection $p2PSchema The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function filterByP2PSchema($p2PSchema, $comparison = null)
	{
		if ($p2PSchema instanceof P2PSchema) {
			return $this
				->addUsingAlias(P2PSchemaTablePeer::SCHEMA_ID, $p2PSchema->getId(), $comparison);
		} elseif ($p2PSchema instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(P2PSchemaTablePeer::SCHEMA_ID, $p2PSchema->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByP2PSchema() only accepts arguments of type P2PSchema or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2PSchema relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function joinP2PSchema($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2PSchema');
		
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
			$this->addJoinObject($join, 'P2PSchema');
		}
		
		return $this;
	}

	/**
	 * Use the P2PSchema relation P2PSchema object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2PSchemaQuery A secondary query class using the current class as primary query
	 */
	public function useP2PSchemaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2PSchema($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2PSchema', 'P2PSchemaQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     P2PSchemaTable $p2PSchemaTable Object to remove from the list of results
	 *
	 * @return    P2PSchemaTableQuery The current query, for fluid interface
	 */
	public function prune($p2PSchemaTable = null)
	{
		if ($p2PSchemaTable) {
			$this->addUsingAlias(P2PSchemaTablePeer::ID, $p2PSchemaTable->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseP2PSchemaTableQuery
