<?php

namespace P2PT/System\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use P2PT/System\Schema;
use P2PT/System\SchemaTablePeer;
use P2PT/System\SchemaTableQuery;

/**
 * Base class that represents a query for the 'schema_table' table.
 *
 * 
 *
 * @method     SchemaTableQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SchemaTableQuery orderBySchemaId($order = Criteria::ASC) Order by the schema_id column
 * @method     SchemaTableQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SchemaTableQuery orderByRowOrdCurrent($order = Criteria::ASC) Order by the row_ord_current column
 *
 * @method     SchemaTableQuery groupById() Group by the id column
 * @method     SchemaTableQuery groupBySchemaId() Group by the schema_id column
 * @method     SchemaTableQuery groupByName() Group by the name column
 * @method     SchemaTableQuery groupByRowOrdCurrent() Group by the row_ord_current column
 *
 * @method     SchemaTableQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SchemaTableQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SchemaTableQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SchemaTableQuery leftJoinSchema($relationAlias = null) Adds a LEFT JOIN clause to the query using the Schema relation
 * @method     SchemaTableQuery rightJoinSchema($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Schema relation
 * @method     SchemaTableQuery innerJoinSchema($relationAlias = null) Adds a INNER JOIN clause to the query using the Schema relation
 *
 * @method     SchemaTable findOne(PropelPDO $con = null) Return the first SchemaTable matching the query
 * @method     SchemaTable findOneOrCreate(PropelPDO $con = null) Return the first SchemaTable matching the query, or a new SchemaTable object populated from the query conditions when no match is found
 *
 * @method     SchemaTable findOneById(int $id) Return the first SchemaTable filtered by the id column
 * @method     SchemaTable findOneBySchemaId(int $schema_id) Return the first SchemaTable filtered by the schema_id column
 * @method     SchemaTable findOneByName(string $name) Return the first SchemaTable filtered by the name column
 * @method     SchemaTable findOneByRowOrdCurrent(int $row_ord_current) Return the first SchemaTable filtered by the row_ord_current column
 *
 * @method     array findById(int $id) Return SchemaTable objects filtered by the id column
 * @method     array findBySchemaId(int $schema_id) Return SchemaTable objects filtered by the schema_id column
 * @method     array findByName(string $name) Return SchemaTable objects filtered by the name column
 * @method     array findByRowOrdCurrent(int $row_ord_current) Return SchemaTable objects filtered by the row_ord_current column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseSchemaTableQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSchemaTableQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'default', $modelName = 'P2PT/System\\SchemaTable', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SchemaTableQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SchemaTableQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SchemaTableQuery) {
			return $criteria;
		}
		$query = new SchemaTableQuery();
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
	 * @return    SchemaTable|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SchemaTablePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SchemaTablePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SchemaTablePeer::ID, $keys, Criteria::IN);
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
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SchemaTablePeer::ID, $id, $comparison);
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
	 * @see       filterBySchema()
	 *
	 * @param     mixed $schemaId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterBySchemaId($schemaId = null, $comparison = null)
	{
		if (is_array($schemaId)) {
			$useMinMax = false;
			if (isset($schemaId['min'])) {
				$this->addUsingAlias(SchemaTablePeer::SCHEMA_ID, $schemaId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaId['max'])) {
				$this->addUsingAlias(SchemaTablePeer::SCHEMA_ID, $schemaId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaTablePeer::SCHEMA_ID, $schemaId, $comparison);
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
	 * @return    SchemaTableQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaTablePeer::NAME, $name, $comparison);
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
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterByRowOrdCurrent($rowOrdCurrent = null, $comparison = null)
	{
		if (is_array($rowOrdCurrent)) {
			$useMinMax = false;
			if (isset($rowOrdCurrent['min'])) {
				$this->addUsingAlias(SchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($rowOrdCurrent['max'])) {
				$this->addUsingAlias(SchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaTablePeer::ROW_ORD_CURRENT, $rowOrdCurrent, $comparison);
	}

	/**
	 * Filter the query by a related Schema object
	 *
	 * @param     Schema|PropelCollection $schema The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function filterBySchema($schema, $comparison = null)
	{
		if ($schema instanceof Schema) {
			return $this
				->addUsingAlias(SchemaTablePeer::SCHEMA_ID, $schema->getId(), $comparison);
		} elseif ($schema instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SchemaTablePeer::SCHEMA_ID, $schema->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBySchema() only accepts arguments of type Schema or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Schema relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function joinSchema($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Schema');
		
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
			$this->addJoinObject($join, 'Schema');
		}
		
		return $this;
	}

	/**
	 * Use the Schema relation Schema object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \P2PT/System\SchemaQuery A secondary query class using the current class as primary query
	 */
	public function useSchemaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSchema($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Schema', '\P2PT/System\SchemaQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SchemaTable $schemaTable Object to remove from the list of results
	 *
	 * @return    SchemaTableQuery The current query, for fluid interface
	 */
	public function prune($schemaTable = null)
	{
		if ($schemaTable) {
			$this->addUsingAlias(SchemaTablePeer::ID, $schemaTable->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSchemaTableQuery
