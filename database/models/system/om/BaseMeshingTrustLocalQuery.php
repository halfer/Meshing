<?php


/**
 * Base class that represents a query for the 'meshing_trust_local' table.
 *
 * 
 *
 * @method     MeshingTrustLocalQuery orderByFromOwnNodeId($order = Criteria::ASC) Order by the from_own_node_id column
 * @method     MeshingTrustLocalQuery orderByToOwnNodeId($order = Criteria::ASC) Order by the to_own_node_id column
 * @method     MeshingTrustLocalQuery orderByDirection($order = Criteria::ASC) Order by the direction column
 * @method     MeshingTrustLocalQuery orderByType($order = Criteria::ASC) Order by the type column
 *
 * @method     MeshingTrustLocalQuery groupByFromOwnNodeId() Group by the from_own_node_id column
 * @method     MeshingTrustLocalQuery groupByToOwnNodeId() Group by the to_own_node_id column
 * @method     MeshingTrustLocalQuery groupByDirection() Group by the direction column
 * @method     MeshingTrustLocalQuery groupByType() Group by the type column
 *
 * @method     MeshingTrustLocalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MeshingTrustLocalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MeshingTrustLocalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MeshingTrustLocalQuery leftJoinP2POwnNodeRelatedByFromOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2POwnNodeRelatedByFromOwnNodeId relation
 * @method     MeshingTrustLocalQuery rightJoinP2POwnNodeRelatedByFromOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2POwnNodeRelatedByFromOwnNodeId relation
 * @method     MeshingTrustLocalQuery innerJoinP2POwnNodeRelatedByFromOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the P2POwnNodeRelatedByFromOwnNodeId relation
 *
 * @method     MeshingTrustLocalQuery leftJoinP2POwnNodeRelatedByToOwnNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2POwnNodeRelatedByToOwnNodeId relation
 * @method     MeshingTrustLocalQuery rightJoinP2POwnNodeRelatedByToOwnNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2POwnNodeRelatedByToOwnNodeId relation
 * @method     MeshingTrustLocalQuery innerJoinP2POwnNodeRelatedByToOwnNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the P2POwnNodeRelatedByToOwnNodeId relation
 *
 * @method     MeshingTrustLocalQuery leftJoinMeshingTrustType($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustType relation
 * @method     MeshingTrustLocalQuery rightJoinMeshingTrustType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustType relation
 * @method     MeshingTrustLocalQuery innerJoinMeshingTrustType($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustType relation
 *
 * @method     MeshingTrustLocal findOne(PropelPDO $con = null) Return the first MeshingTrustLocal matching the query
 * @method     MeshingTrustLocal findOneOrCreate(PropelPDO $con = null) Return the first MeshingTrustLocal matching the query, or a new MeshingTrustLocal object populated from the query conditions when no match is found
 *
 * @method     MeshingTrustLocal findOneByFromOwnNodeId(int $from_own_node_id) Return the first MeshingTrustLocal filtered by the from_own_node_id column
 * @method     MeshingTrustLocal findOneByToOwnNodeId(int $to_own_node_id) Return the first MeshingTrustLocal filtered by the to_own_node_id column
 * @method     MeshingTrustLocal findOneByDirection(string $direction) Return the first MeshingTrustLocal filtered by the direction column
 * @method     MeshingTrustLocal findOneByType(int $type) Return the first MeshingTrustLocal filtered by the type column
 *
 * @method     array findByFromOwnNodeId(int $from_own_node_id) Return MeshingTrustLocal objects filtered by the from_own_node_id column
 * @method     array findByToOwnNodeId(int $to_own_node_id) Return MeshingTrustLocal objects filtered by the to_own_node_id column
 * @method     array findByDirection(string $direction) Return MeshingTrustLocal objects filtered by the direction column
 * @method     array findByType(int $type) Return MeshingTrustLocal objects filtered by the type column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingTrustLocalQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMeshingTrustLocalQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'MeshingTrustLocal', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MeshingTrustLocalQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MeshingTrustLocalQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MeshingTrustLocalQuery) {
			return $criteria;
		}
		$query = new MeshingTrustLocalQuery();
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
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 * @param     array[$from_own_node_id, $to_own_node_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    MeshingTrustLocal|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MeshingTrustLocalPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
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
	 * @see       filterByP2POwnNodeRelatedByFromOwnNodeId()
	 *
	 * @param     mixed $fromOwnNodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByFromOwnNodeId($fromOwnNodeId = null, $comparison = null)
	{
		if (is_array($fromOwnNodeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $fromOwnNodeId, $comparison);
	}

	/**
	 * Filter the query on the to_own_node_id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByToOwnNodeId(1234); // WHERE to_own_node_id = 1234
	 * $query->filterByToOwnNodeId(array(12, 34)); // WHERE to_own_node_id IN (12, 34)
	 * $query->filterByToOwnNodeId(array('min' => 12)); // WHERE to_own_node_id > 12
	 * </code>
	 *
	 * @see       filterByP2POwnNodeRelatedByToOwnNodeId()
	 *
	 * @param     mixed $toOwnNodeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByToOwnNodeId($toOwnNodeId = null, $comparison = null)
	{
		if (is_array($toOwnNodeId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $toOwnNodeId, $comparison);
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
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MeshingTrustLocalPeer::DIRECTION, $direction, $comparison);
	}

	/**
	 * Filter the query on the type column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByType(1234); // WHERE type = 1234
	 * $query->filterByType(array(12, 34)); // WHERE type IN (12, 34)
	 * $query->filterByType(array('min' => 12)); // WHERE type > 12
	 * </code>
	 *
	 * @see       filterByMeshingTrustType()
	 *
	 * @param     mixed $type The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByType($type = null, $comparison = null)
	{
		if (is_array($type)) {
			$useMinMax = false;
			if (isset($type['min'])) {
				$this->addUsingAlias(MeshingTrustLocalPeer::TYPE, $type['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($type['max'])) {
				$this->addUsingAlias(MeshingTrustLocalPeer::TYPE, $type['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingTrustLocalPeer::TYPE, $type, $comparison);
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode|PropelCollection $p2POwnNode The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByP2POwnNodeRelatedByFromOwnNodeId($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $p2POwnNode->getId(), $comparison);
		} elseif ($p2POwnNode instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $p2POwnNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByP2POwnNodeRelatedByFromOwnNodeId() only accepts arguments of type P2POwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2POwnNodeRelatedByFromOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function joinP2POwnNodeRelatedByFromOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2POwnNodeRelatedByFromOwnNodeId');
		
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
			$this->addJoinObject($join, 'P2POwnNodeRelatedByFromOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the P2POwnNodeRelatedByFromOwnNodeId relation P2POwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useP2POwnNodeRelatedByFromOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2POwnNodeRelatedByFromOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2POwnNodeRelatedByFromOwnNodeId', 'P2POwnNodeQuery');
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode|PropelCollection $p2POwnNode The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByP2POwnNodeRelatedByToOwnNodeId($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $p2POwnNode->getId(), $comparison);
		} elseif ($p2POwnNode instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $p2POwnNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByP2POwnNodeRelatedByToOwnNodeId() only accepts arguments of type P2POwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2POwnNodeRelatedByToOwnNodeId relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function joinP2POwnNodeRelatedByToOwnNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2POwnNodeRelatedByToOwnNodeId');
		
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
			$this->addJoinObject($join, 'P2POwnNodeRelatedByToOwnNodeId');
		}
		
		return $this;
	}

	/**
	 * Use the P2POwnNodeRelatedByToOwnNodeId relation P2POwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useP2POwnNodeRelatedByToOwnNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2POwnNodeRelatedByToOwnNodeId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2POwnNodeRelatedByToOwnNodeId', 'P2POwnNodeQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustType object
	 *
	 * @param     MeshingTrustType|PropelCollection $meshingTrustType The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustType($meshingTrustType, $comparison = null)
	{
		if ($meshingTrustType instanceof MeshingTrustType) {
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::TYPE, $meshingTrustType->getId(), $comparison);
		} elseif ($meshingTrustType instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MeshingTrustLocalPeer::TYPE, $meshingTrustType->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
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
	 * @param     MeshingTrustLocal $meshingTrustLocal Object to remove from the list of results
	 *
	 * @return    MeshingTrustLocalQuery The current query, for fluid interface
	 */
	public function prune($meshingTrustLocal = null)
	{
		if ($meshingTrustLocal) {
			$this->addCond('pruneCond0', $this->getAliasedColName(MeshingTrustLocalPeer::FROM_OWN_NODE_ID), $meshingTrustLocal->getFromOwnNodeId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(MeshingTrustLocalPeer::TO_OWN_NODE_ID), $meshingTrustLocal->getToOwnNodeId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseMeshingTrustLocalQuery
