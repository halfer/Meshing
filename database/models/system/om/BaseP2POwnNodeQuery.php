<?php


/**
 * Base class that represents a query for the 'p2p_own_node' table.
 *
 * 
 *
 * @method     P2POwnNodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     P2POwnNodeQuery orderBySchemaId($order = Criteria::ASC) Order by the schema_id column
 * @method     P2POwnNodeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     P2POwnNodeQuery orderByConnectionId($order = Criteria::ASC) Order by the connection_id column
 * @method     P2POwnNodeQuery orderByIsEnabled($order = Criteria::ASC) Order by the is_enabled column
 *
 * @method     P2POwnNodeQuery groupById() Group by the id column
 * @method     P2POwnNodeQuery groupBySchemaId() Group by the schema_id column
 * @method     P2POwnNodeQuery groupByName() Group by the name column
 * @method     P2POwnNodeQuery groupByConnectionId() Group by the connection_id column
 * @method     P2POwnNodeQuery groupByIsEnabled() Group by the is_enabled column
 *
 * @method     P2POwnNodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     P2POwnNodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     P2POwnNodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     P2POwnNodeQuery leftJoinMeshingSchema($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingSchema relation
 * @method     P2POwnNodeQuery rightJoinMeshingSchema($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingSchema relation
 * @method     P2POwnNodeQuery innerJoinMeshingSchema($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingSchema relation
 *
 * @method     P2POwnNodeQuery leftJoinP2PConnection($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2PConnection relation
 * @method     P2POwnNodeQuery rightJoinP2PConnection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2PConnection relation
 * @method     P2POwnNodeQuery innerJoinP2PConnection($relationAlias = null) Adds a INNER JOIN clause to the query using the P2PConnection relation
 *
 * @method     P2POwnNodeQuery leftJoinMeshingTrustLocalRelatedByFromOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustLocalRelatedByFromOwnNodeId relation
 * @method     P2POwnNodeQuery rightJoinMeshingTrustLocalRelatedByFromOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustLocalRelatedByFromOwnNodeId relation
 * @method     P2POwnNodeQuery innerJoinMeshingTrustLocalRelatedByFromOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustLocalRelatedByFromOwnNodeId relation
 *
 * @method     P2POwnNodeQuery leftJoinMeshingTrustLocalRelatedByToOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustLocalRelatedByToOwnNodeId relation
 * @method     P2POwnNodeQuery rightJoinMeshingTrustLocalRelatedByToOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustLocalRelatedByToOwnNodeId relation
 * @method     P2POwnNodeQuery innerJoinMeshingTrustLocalRelatedByToOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustLocalRelatedByToOwnNodeId relation
 *
 * @method     P2POwnNodeQuery leftJoinMeshingTrustRemoteRelatedByFromOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustRemoteRelatedByFromOwnNodeId relation
 * @method     P2POwnNodeQuery rightJoinMeshingTrustRemoteRelatedByFromOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustRemoteRelatedByFromOwnNodeId relation
 * @method     P2POwnNodeQuery innerJoinMeshingTrustRemoteRelatedByFromOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustRemoteRelatedByFromOwnNodeId relation
 *
 * @method     P2POwnNodeQuery leftJoinMeshingTrustRemoteRelatedByInOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustRemoteRelatedByInOwnNodeId relation
 * @method     P2POwnNodeQuery rightJoinMeshingTrustRemoteRelatedByInOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustRemoteRelatedByInOwnNodeId relation
 * @method     P2POwnNodeQuery innerJoinMeshingTrustRemoteRelatedByInOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustRemoteRelatedByInOwnNodeId relation
 *
 * @method     P2POwnNode findOne(PropelPDO $con = null) Return the first P2POwnNode matching the query
 * @method     P2POwnNode findOneOrCreate(PropelPDO $con = null) Return the first P2POwnNode matching the query, or a new P2POwnNode object populated from the query conditions when no match is found
 *
 * @method     P2POwnNode findOneById(int $id) Return the first P2POwnNode filtered by the id column
 * @method     P2POwnNode findOneBySchemaId(int $schema_id) Return the first P2POwnNode filtered by the schema_id column
 * @method     P2POwnNode findOneByName(string $name) Return the first P2POwnNode filtered by the name column
 * @method     P2POwnNode findOneByConnectionId(int $connection_id) Return the first P2POwnNode filtered by the connection_id column
 * @method     P2POwnNode findOneByIsEnabled(boolean $is_enabled) Return the first P2POwnNode filtered by the is_enabled column
 *
 * @method     array findById(int $id) Return P2POwnNode objects filtered by the id column
 * @method     array findBySchemaId(int $schema_id) Return P2POwnNode objects filtered by the schema_id column
 * @method     array findByName(string $name) Return P2POwnNode objects filtered by the name column
 * @method     array findByConnectionId(int $connection_id) Return P2POwnNode objects filtered by the connection_id column
 * @method     array findByIsEnabled(boolean $is_enabled) Return P2POwnNode objects filtered by the is_enabled column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseP2POwnNodeQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseP2POwnNodeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'P2POwnNode', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new P2POwnNodeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    P2POwnNodeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof P2POwnNodeQuery) {
			return $criteria;
		}
		$query = new P2POwnNodeQuery();
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
	 * @return    P2POwnNode|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = P2POwnNodePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(P2POwnNodePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(P2POwnNodePeer::ID, $keys, Criteria::IN);
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(P2POwnNodePeer::ID, $id, $comparison);
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterBySchemaId($schemaId = null, $comparison = null)
	{
		if (is_array($schemaId)) {
			$useMinMax = false;
			if (isset($schemaId['min'])) {
				$this->addUsingAlias(P2POwnNodePeer::SCHEMA_ID, $schemaId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaId['max'])) {
				$this->addUsingAlias(P2POwnNodePeer::SCHEMA_ID, $schemaId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(P2POwnNodePeer::SCHEMA_ID, $schemaId, $comparison);
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
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
		return $this->addUsingAlias(P2POwnNodePeer::NAME, $name, $comparison);
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
	 * @see       filterByP2PConnection()
	 *
	 * @param     mixed $connectionId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByConnectionId($connectionId = null, $comparison = null)
	{
		if (is_array($connectionId)) {
			$useMinMax = false;
			if (isset($connectionId['min'])) {
				$this->addUsingAlias(P2POwnNodePeer::CONNECTION_ID, $connectionId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($connectionId['max'])) {
				$this->addUsingAlias(P2POwnNodePeer::CONNECTION_ID, $connectionId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(P2POwnNodePeer::CONNECTION_ID, $connectionId, $comparison);
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByIsEnabled($isEnabled = null, $comparison = null)
	{
		if (is_string($isEnabled)) {
			$is_enabled = in_array(strtolower($isEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(P2POwnNodePeer::IS_ENABLED, $isEnabled, $comparison);
	}

	/**
	 * Filter the query by a related MeshingSchema object
	 *
	 * @param     MeshingSchema|PropelCollection $meshingSchema The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByMeshingSchema($meshingSchema, $comparison = null)
	{
		if ($meshingSchema instanceof MeshingSchema) {
			return $this
				->addUsingAlias(P2POwnNodePeer::SCHEMA_ID, $meshingSchema->getId(), $comparison);
		} elseif ($meshingSchema instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(P2POwnNodePeer::SCHEMA_ID, $meshingSchema->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    P2POwnNodeQuery The current query, for fluid interface
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
	 * Filter the query by a related P2PConnection object
	 *
	 * @param     P2PConnection|PropelCollection $p2PConnection The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByP2PConnection($p2PConnection, $comparison = null)
	{
		if ($p2PConnection instanceof P2PConnection) {
			return $this
				->addUsingAlias(P2POwnNodePeer::CONNECTION_ID, $p2PConnection->getId(), $comparison);
		} elseif ($p2PConnection instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(P2POwnNodePeer::CONNECTION_ID, $p2PConnection->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByP2PConnection() only accepts arguments of type P2PConnection or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2PConnection relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function joinP2PConnection($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2PConnection');
		
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
			$this->addJoinObject($join, 'P2PConnection');
		}
		
		return $this;
	}

	/**
	 * Use the P2PConnection relation P2PConnection object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2PConnectionQuery A secondary query class using the current class as primary query
	 */
	public function useP2PConnectionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2PConnection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2PConnection', 'P2PConnectionQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustLocal object
	 *
	 * @param     MeshingTrustLocal $meshingTrustLocal  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustLocalRelatedByFromOwnNodeId($meshingTrustLocal, $comparison = null)
	{
		if ($meshingTrustLocal instanceof MeshingTrustLocal) {
			return $this
				->addUsingAlias(P2POwnNodePeer::ID, $meshingTrustLocal->getFromOwnNodeId(), $comparison);
		} elseif ($meshingTrustLocal instanceof PropelCollection) {
			return $this
				->useMeshingTrustLocalRelatedByFromOwnNodeIdQuery()
					->filterByPrimaryKeys($meshingTrustLocal->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustLocalRelatedByFromOwnNodeId() only accepts arguments of type MeshingTrustLocal or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustLocalRelatedByFromOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustLocalRelatedByFromOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustLocalRelatedByFromOwnNodeId');
		
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
			$this->addJoinObject($join, 'MeshingTrustLocalRelatedByFromOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustLocalRelatedByFromOwnNodeId relation MeshingTrustLocal object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustLocalQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustLocalRelatedByFromOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustLocalRelatedByFromOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustLocalRelatedByFromOwnNodeId', 'MeshingTrustLocalQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustLocal object
	 *
	 * @param     MeshingTrustLocal $meshingTrustLocal  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustLocalRelatedByToOwnNodeId($meshingTrustLocal, $comparison = null)
	{
		if ($meshingTrustLocal instanceof MeshingTrustLocal) {
			return $this
				->addUsingAlias(P2POwnNodePeer::ID, $meshingTrustLocal->getToOwnNodeId(), $comparison);
		} elseif ($meshingTrustLocal instanceof PropelCollection) {
			return $this
				->useMeshingTrustLocalRelatedByToOwnNodeIdQuery()
					->filterByPrimaryKeys($meshingTrustLocal->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustLocalRelatedByToOwnNodeId() only accepts arguments of type MeshingTrustLocal or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustLocalRelatedByToOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustLocalRelatedByToOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustLocalRelatedByToOwnNodeId');
		
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
			$this->addJoinObject($join, 'MeshingTrustLocalRelatedByToOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustLocalRelatedByToOwnNodeId relation MeshingTrustLocal object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustLocalQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustLocalRelatedByToOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustLocalRelatedByToOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustLocalRelatedByToOwnNodeId', 'MeshingTrustLocalQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustRemote object
	 *
	 * @param     MeshingTrustRemote $meshingTrustRemote  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustRemoteRelatedByFromOwnNodeId($meshingTrustRemote, $comparison = null)
	{
		if ($meshingTrustRemote instanceof MeshingTrustRemote) {
			return $this
				->addUsingAlias(P2POwnNodePeer::ID, $meshingTrustRemote->getFromOwnNodeId(), $comparison);
		} elseif ($meshingTrustRemote instanceof PropelCollection) {
			return $this
				->useMeshingTrustRemoteRelatedByFromOwnNodeIdQuery()
					->filterByPrimaryKeys($meshingTrustRemote->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustRemoteRelatedByFromOwnNodeId() only accepts arguments of type MeshingTrustRemote or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustRemoteRelatedByFromOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustRemoteRelatedByFromOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustRemoteRelatedByFromOwnNodeId');
		
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
			$this->addJoinObject($join, 'MeshingTrustRemoteRelatedByFromOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustRemoteRelatedByFromOwnNodeId relation MeshingTrustRemote object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustRemoteRelatedByFromOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustRemoteRelatedByFromOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustRemoteRelatedByFromOwnNodeId', 'MeshingTrustRemoteQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustRemote object
	 *
	 * @param     MeshingTrustRemote $meshingTrustRemote  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustRemoteRelatedByInOwnNodeId($meshingTrustRemote, $comparison = null)
	{
		if ($meshingTrustRemote instanceof MeshingTrustRemote) {
			return $this
				->addUsingAlias(P2POwnNodePeer::ID, $meshingTrustRemote->getInOwnNodeId(), $comparison);
		} elseif ($meshingTrustRemote instanceof PropelCollection) {
			return $this
				->useMeshingTrustRemoteRelatedByInOwnNodeIdQuery()
					->filterByPrimaryKeys($meshingTrustRemote->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustRemoteRelatedByInOwnNodeId() only accepts arguments of type MeshingTrustRemote or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustRemoteRelatedByInOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustRemoteRelatedByInOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustRemoteRelatedByInOwnNodeId');
		
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
			$this->addJoinObject($join, 'MeshingTrustRemoteRelatedByInOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustRemoteRelatedByInOwnNodeId relation MeshingTrustRemote object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustRemoteRelatedByInOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustRemoteRelatedByInOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustRemoteRelatedByInOwnNodeId', 'MeshingTrustRemoteQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     P2POwnNode $p2POwnNode Object to remove from the list of results
	 *
	 * @return    P2POwnNodeQuery The current query, for fluid interface
	 */
	public function prune($p2POwnNode = null)
	{
		if ($p2POwnNode) {
			$this->addUsingAlias(P2POwnNodePeer::ID, $p2POwnNode->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseP2POwnNodeQuery
