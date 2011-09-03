<?php

namespace P2PT/System\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use P2PT/System\Connection;
use P2PT/System\OwnNodePeer;
use P2PT/System\OwnNodeQuery;
use P2PT/System\Schema;

/**
 * Base class that represents a query for the 'own_node' table.
 *
 * 
 *
 * @method     OwnNodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     OwnNodeQuery orderBySchemaId($order = Criteria::ASC) Order by the schema_id column
 * @method     OwnNodeQuery orderByShortName($order = Criteria::ASC) Order by the short_name column
 * @method     OwnNodeQuery orderByConnectionId($order = Criteria::ASC) Order by the connection_id column
 * @method     OwnNodeQuery orderByIsEnabled($order = Criteria::ASC) Order by the is_enabled column
 *
 * @method     OwnNodeQuery groupById() Group by the id column
 * @method     OwnNodeQuery groupBySchemaId() Group by the schema_id column
 * @method     OwnNodeQuery groupByShortName() Group by the short_name column
 * @method     OwnNodeQuery groupByConnectionId() Group by the connection_id column
 * @method     OwnNodeQuery groupByIsEnabled() Group by the is_enabled column
 *
 * @method     OwnNodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     OwnNodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     OwnNodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     OwnNodeQuery leftJoinSchema($relationAlias = null) Adds a LEFT JOIN clause to the query using the Schema relation
 * @method     OwnNodeQuery rightJoinSchema($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Schema relation
 * @method     OwnNodeQuery innerJoinSchema($relationAlias = null) Adds a INNER JOIN clause to the query using the Schema relation
 *
 * @method     OwnNodeQuery leftJoinConnection($relationAlias = null) Adds a LEFT JOIN clause to the query using the Connection relation
 * @method     OwnNodeQuery rightJoinConnection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Connection relation
 * @method     OwnNodeQuery innerJoinConnection($relationAlias = null) Adds a INNER JOIN clause to the query using the Connection relation
 *
 * @method     OwnNode findOne(PropelPDO $con = null) Return the first OwnNode matching the query
 * @method     OwnNode findOneOrCreate(PropelPDO $con = null) Return the first OwnNode matching the query, or a new OwnNode object populated from the query conditions when no match is found
 *
 * @method     OwnNode findOneById(int $id) Return the first OwnNode filtered by the id column
 * @method     OwnNode findOneBySchemaId(int $schema_id) Return the first OwnNode filtered by the schema_id column
 * @method     OwnNode findOneByShortName(string $short_name) Return the first OwnNode filtered by the short_name column
 * @method     OwnNode findOneByConnectionId(int $connection_id) Return the first OwnNode filtered by the connection_id column
 * @method     OwnNode findOneByIsEnabled(boolean $is_enabled) Return the first OwnNode filtered by the is_enabled column
 *
 * @method     array findById(int $id) Return OwnNode objects filtered by the id column
 * @method     array findBySchemaId(int $schema_id) Return OwnNode objects filtered by the schema_id column
 * @method     array findByShortName(string $short_name) Return OwnNode objects filtered by the short_name column
 * @method     array findByConnectionId(int $connection_id) Return OwnNode objects filtered by the connection_id column
 * @method     array findByIsEnabled(boolean $is_enabled) Return OwnNode objects filtered by the is_enabled column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseOwnNodeQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseOwnNodeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'default', $modelName = 'P2PT/System\\OwnNode', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new OwnNodeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    OwnNodeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof OwnNodeQuery) {
			return $criteria;
		}
		$query = new OwnNodeQuery();
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
	 * @return    OwnNode|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = OwnNodePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(OwnNodePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(OwnNodePeer::ID, $keys, Criteria::IN);
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
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(OwnNodePeer::ID, $id, $comparison);
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
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterBySchemaId($schemaId = null, $comparison = null)
	{
		if (is_array($schemaId)) {
			$useMinMax = false;
			if (isset($schemaId['min'])) {
				$this->addUsingAlias(OwnNodePeer::SCHEMA_ID, $schemaId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaId['max'])) {
				$this->addUsingAlias(OwnNodePeer::SCHEMA_ID, $schemaId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OwnNodePeer::SCHEMA_ID, $schemaId, $comparison);
	}

	/**
	 * Filter the query on the short_name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByShortName('fooValue');   // WHERE short_name = 'fooValue'
	 * $query->filterByShortName('%fooValue%'); // WHERE short_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $shortName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByShortName($shortName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($shortName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $shortName)) {
				$shortName = str_replace('*', '%', $shortName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(OwnNodePeer::SHORT_NAME, $shortName, $comparison);
	}

	/**
	 * Filter the query on the connection_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByConnectionId(1234); // WHERE connection_id = 1234
	 * $query->filterByConnectionId(array(12, 34)); // WHERE connection_id IN (12, 34)
	 * $query->filterByConnectionId(array('min' => 12)); // WHERE connection_id > 12
	 * </code>
	 *
	 * @see       filterByConnection()
	 *
	 * @param     mixed $connectionId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByConnectionId($connectionId = null, $comparison = null)
	{
		if (is_array($connectionId)) {
			$useMinMax = false;
			if (isset($connectionId['min'])) {
				$this->addUsingAlias(OwnNodePeer::CONNECTION_ID, $connectionId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($connectionId['max'])) {
				$this->addUsingAlias(OwnNodePeer::CONNECTION_ID, $connectionId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OwnNodePeer::CONNECTION_ID, $connectionId, $comparison);
	}

	/**
	 * Filter the query on the is_enabled column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByIsEnabled(true); // WHERE is_enabled = true
	 * $query->filterByIsEnabled('yes'); // WHERE is_enabled = true
	 * </code>
	 *
	 * @param     boolean|string $isEnabled The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByIsEnabled($isEnabled = null, $comparison = null)
	{
		if (is_string($isEnabled)) {
			$is_enabled = in_array(strtolower($isEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(OwnNodePeer::IS_ENABLED, $isEnabled, $comparison);
	}

	/**
	 * Filter the query by a related Schema object
	 *
	 * @param     Schema|PropelCollection $schema The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterBySchema($schema, $comparison = null)
	{
		if ($schema instanceof Schema) {
			return $this
				->addUsingAlias(OwnNodePeer::SCHEMA_ID, $schema->getId(), $comparison);
		} elseif ($schema instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OwnNodePeer::SCHEMA_ID, $schema->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    OwnNodeQuery The current query, for fluid interface
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
	 * Filter the query by a related Connection object
	 *
	 * @param     Connection|PropelCollection $connection The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function filterByConnection($connection, $comparison = null)
	{
		if ($connection instanceof Connection) {
			return $this
				->addUsingAlias(OwnNodePeer::CONNECTION_ID, $connection->getId(), $comparison);
		} elseif ($connection instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OwnNodePeer::CONNECTION_ID, $connection->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByConnection() only accepts arguments of type Connection or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Connection relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function joinConnection($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Connection');
		
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
			$this->addJoinObject($join, 'Connection');
		}
		
		return $this;
	}

	/**
	 * Use the Connection relation Connection object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \P2PT/System\ConnectionQuery A secondary query class using the current class as primary query
	 */
	public function useConnectionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinConnection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Connection', '\P2PT/System\ConnectionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     OwnNode $ownNode Object to remove from the list of results
	 *
	 * @return    OwnNodeQuery The current query, for fluid interface
	 */
	public function prune($ownNode = null)
	{
		if ($ownNode) {
			$this->addUsingAlias(OwnNodePeer::ID, $ownNode->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseOwnNodeQuery
