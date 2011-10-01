<?php


/**
 * Base class that represents a query for the 'meshing_trust_remote' table.
 *
 * 
 *
 * @method     MeshingTrustRemoteQuery orderByFromOwnNodeId($order = Criteria::ASC) Order by the from_own_node_id column
 * @method     MeshingTrustRemoteQuery orderByInOwnNodeId($order = Criteria::ASC) Order by the in_own_node_id column
 * @method     MeshingTrustRemoteQuery orderByKnownNodeId($order = Criteria::ASC) Order by the known_node_id column
 * @method     MeshingTrustRemoteQuery orderByDirection($order = Criteria::ASC) Order by the direction column
 * @method     MeshingTrustRemoteQuery orderByTrustTypeId($order = Criteria::ASC) Order by the trust_type_id column
 *
 * @method     MeshingTrustRemoteQuery groupByFromOwnNodeId() Group by the from_own_node_id column
 * @method     MeshingTrustRemoteQuery groupByInOwnNodeId() Group by the in_own_node_id column
 * @method     MeshingTrustRemoteQuery groupByKnownNodeId() Group by the known_node_id column
 * @method     MeshingTrustRemoteQuery groupByDirection() Group by the direction column
 * @method     MeshingTrustRemoteQuery groupByTrustTypeId() Group by the trust_type_id column
 *
 * @method     MeshingTrustRemoteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MeshingTrustRemoteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MeshingTrustRemoteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MeshingTrustRemoteQuery leftJoinFromOwnNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the FromOwnNode relation
 * @method     MeshingTrustRemoteQuery rightJoinFromOwnNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FromOwnNode relation
 * @method     MeshingTrustRemoteQuery innerJoinFromOwnNode($relationAlias = null) Adds a INNER JOIN clause to the query using the FromOwnNode relation
 *
 * @method     MeshingTrustRemoteQuery leftJoinP2POwnNodeRelatedByInOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2POwnNodeRelatedByInOwnNodeId relation
 * @method     MeshingTrustRemoteQuery rightJoinP2POwnNodeRelatedByInOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2POwnNodeRelatedByInOwnNodeId relation
 * @method     MeshingTrustRemoteQuery innerJoinP2POwnNodeRelatedByInOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the P2POwnNodeRelatedByInOwnNodeId relation
 *
 * @method     MeshingTrustRemoteQuery leftJoinMeshingTrustType($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustType relation
 * @method     MeshingTrustRemoteQuery rightJoinMeshingTrustType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustType relation
 * @method     MeshingTrustRemoteQuery innerJoinMeshingTrustType($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustType relation
 *
 * @method     MeshingTrustRemote findOne(PropelPDO $con = null) Return the first MeshingTrustRemote matching the query
 * @method     MeshingTrustRemote findOneOrCreate(PropelPDO $con = null) Return the first MeshingTrustRemote matching the query, or a new MeshingTrustRemote object populated from the query conditions when no match is found
 *
 * @method     MeshingTrustRemote findOneByFromOwnNodeId(int $from_own_node_id) Return the first MeshingTrustRemote filtered by the from_own_node_id column
 * @method     MeshingTrustRemote findOneByInOwnNodeId(int $in_own_node_id) Return the first MeshingTrustRemote filtered by the in_own_node_id column
 * @method     MeshingTrustRemote findOneByKnownNodeId(int $known_node_id) Return the first MeshingTrustRemote filtered by the known_node_id column
 * @method     MeshingTrustRemote findOneByDirection(string $direction) Return the first MeshingTrustRemote filtered by the direction column
 * @method     MeshingTrustRemote findOneByTrustTypeId(int $trust_type_id) Return the first MeshingTrustRemote filtered by the trust_type_id column
 *
 * @method     array findByFromOwnNodeId(int $from_own_node_id) Return MeshingTrustRemote objects filtered by the from_own_node_id column
 * @method     array findByInOwnNodeId(int $in_own_node_id) Return MeshingTrustRemote objects filtered by the in_own_node_id column
 * @method     array findByKnownNodeId(int $known_node_id) Return MeshingTrustRemote objects filtered by the known_node_id column
 * @method     array findByDirection(string $direction) Return MeshingTrustRemote objects filtered by the direction column
 * @method     array findByTrustTypeId(int $trust_type_id) Return MeshingTrustRemote objects filtered by the trust_type_id column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingTrustRemoteQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMeshingTrustRemoteQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'MeshingTrustRemote', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MeshingTrustRemoteQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MeshingTrustRemoteQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MeshingTrustRemoteQuery) {
			return $criteria;
		}
		$query = new MeshingTrustRemoteQuery();
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
	 * <code>
	 * $obj = $c->findPk(array(12, 34, 56), $con);
	 * </code>
	 * @param     array[$from_own_node_id, $in_own_node_id, $known_node_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    MeshingTrustRemote|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MeshingTrustRemotePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $key[1], Criteria::EQUAL);
		$this->addUsingAlias(MeshingTrustRemotePeer::KNOWN_NODE_ID, $key[2], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$cton2 = $this->getNewCriterion(MeshingTrustRemotePeer::KNOWN_NODE_ID, $key[2], Criteria::EQUAL);
			$cton0->addAnd($cton2);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the from_own_node_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFromOwnNodeId(1234); // WHERE from_own_node_id = 1234
	 * $query->filterByFromOwnNodeId(array(12, 34)); // WHERE from_own_node_id IN (12, 34)
	 * $query->filterByFromOwnNodeId(array('min' => 12)); // WHERE from_own_node_id > 12
	 * </code>
	 *
	 * @see       filterByFromOwnNode()
	 *
	 * @param     mixed $fromOwnNodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByFromOwnNodeId($fromOwnNodeId = null, $comparison = null)
	{
		if (is_array($fromOwnNodeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $fromOwnNodeId, $comparison);
	}

	/**
	 * Filter the query on the in_own_node_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByInOwnNodeId(1234); // WHERE in_own_node_id = 1234
	 * $query->filterByInOwnNodeId(array(12, 34)); // WHERE in_own_node_id IN (12, 34)
	 * $query->filterByInOwnNodeId(array('min' => 12)); // WHERE in_own_node_id > 12
	 * </code>
	 *
	 * @see       filterByP2POwnNodeRelatedByInOwnNodeId()
	 *
	 * @param     mixed $inOwnNodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByInOwnNodeId($inOwnNodeId = null, $comparison = null)
	{
		if (is_array($inOwnNodeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $inOwnNodeId, $comparison);
	}

	/**
	 * Filter the query on the known_node_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByKnownNodeId(1234); // WHERE known_node_id = 1234
	 * $query->filterByKnownNodeId(array(12, 34)); // WHERE known_node_id IN (12, 34)
	 * $query->filterByKnownNodeId(array('min' => 12)); // WHERE known_node_id > 12
	 * </code>
	 *
	 * @param     mixed $knownNodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByKnownNodeId($knownNodeId = null, $comparison = null)
	{
		if (is_array($knownNodeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustRemotePeer::KNOWN_NODE_ID, $knownNodeId, $comparison);
	}

	/**
	 * Filter the query on the direction column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDirection('fooValue');   // WHERE direction = 'fooValue'
	 * $query->filterByDirection('%fooValue%'); // WHERE direction LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $direction The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByDirection($direction = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($direction)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $direction)) {
				$direction = str_replace('*', '%', $direction);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingTrustRemotePeer::DIRECTION, $direction, $comparison);
	}

	/**
	 * Filter the query on the trust_type_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTrustTypeId(1234); // WHERE trust_type_id = 1234
	 * $query->filterByTrustTypeId(array(12, 34)); // WHERE trust_type_id IN (12, 34)
	 * $query->filterByTrustTypeId(array('min' => 12)); // WHERE trust_type_id > 12
	 * </code>
	 *
	 * @see       filterByMeshingTrustType()
	 *
	 * @param     mixed $trustTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByTrustTypeId($trustTypeId = null, $comparison = null)
	{
		if (is_array($trustTypeId)) {
			$useMinMax = false;
			if (isset($trustTypeId['min'])) {
				$this->addUsingAlias(MeshingTrustRemotePeer::TRUST_TYPE_ID, $trustTypeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($trustTypeId['max'])) {
				$this->addUsingAlias(MeshingTrustRemotePeer::TRUST_TYPE_ID, $trustTypeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingTrustRemotePeer::TRUST_TYPE_ID, $trustTypeId, $comparison);
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode|PropelCollection $p2POwnNode The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByFromOwnNode($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $p2POwnNode->getId(), $comparison);
		} elseif ($p2POwnNode instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $p2POwnNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByFromOwnNode() only accepts arguments of type P2POwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FromOwnNode relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function joinFromOwnNode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FromOwnNode');
		
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
			$this->addJoinObject($join, 'FromOwnNode');
		}
		
		return $this;
	}

	/**
	 * Use the FromOwnNode relation P2POwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useFromOwnNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFromOwnNode($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FromOwnNode', 'P2POwnNodeQuery');
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode|PropelCollection $p2POwnNode The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByP2POwnNodeRelatedByInOwnNodeId($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $p2POwnNode->getId(), $comparison);
		} elseif ($p2POwnNode instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $p2POwnNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByP2POwnNodeRelatedByInOwnNodeId() only accepts arguments of type P2POwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2POwnNodeRelatedByInOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function joinP2POwnNodeRelatedByInOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2POwnNodeRelatedByInOwnNodeId');
		
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
			$this->addJoinObject($join, 'P2POwnNodeRelatedByInOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the P2POwnNodeRelatedByInOwnNodeId relation P2POwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useP2POwnNodeRelatedByInOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2POwnNodeRelatedByInOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2POwnNodeRelatedByInOwnNodeId', 'P2POwnNodeQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustType object
	 *
	 * @param     MeshingTrustType|PropelCollection $meshingTrustType The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustType($meshingTrustType, $comparison = null)
	{
		if ($meshingTrustType instanceof MeshingTrustType) {
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::TRUST_TYPE_ID, $meshingTrustType->getId(), $comparison);
		} elseif ($meshingTrustType instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustRemotePeer::TRUST_TYPE_ID, $meshingTrustType->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByMeshingTrustType() only accepts arguments of type MeshingTrustType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustType relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustType');
		
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
			$this->addJoinObject($join, 'MeshingTrustType');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustType relation MeshingTrustType object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustTypeQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustType', 'MeshingTrustTypeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MeshingTrustRemote $meshingTrustRemote Object to remove from the list of results
	 *
	 * @return    MeshingTrustRemoteQuery The current query, for fluid interface
	 */
	public function prune($meshingTrustRemote = null)
	{
		if ($meshingTrustRemote) {
			$this->addCond('pruneCond0', $this->getAliasedColName(MeshingTrustRemotePeer::FROM_OWN_NODE_ID), $meshingTrustRemote->getFromOwnNodeId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(MeshingTrustRemotePeer::IN_OWN_NODE_ID), $meshingTrustRemote->getInOwnNodeId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond2', $this->getAliasedColName(MeshingTrustRemotePeer::KNOWN_NODE_ID), $meshingTrustRemote->getKnownNodeId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseMeshingTrustRemoteQuery
