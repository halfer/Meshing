<?php


/**
 * Base class that represents a query for the 'meshing_trust_type' table.
 *
 * 
 *
 * @method     MeshingTrustTypeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MeshingTrustTypeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     MeshingTrustTypeQuery orderByPreferredAuth($order = Criteria::ASC) Order by the preferred_auth column
 *
 * @method     MeshingTrustTypeQuery groupById() Group by the id column
 * @method     MeshingTrustTypeQuery groupByName() Group by the name column
 * @method     MeshingTrustTypeQuery groupByPreferredAuth() Group by the preferred_auth column
 *
 * @method     MeshingTrustTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MeshingTrustTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MeshingTrustTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MeshingTrustTypeQuery leftJoinMeshingTrustLocal($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustLocal relation
 * @method     MeshingTrustTypeQuery rightJoinMeshingTrustLocal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustLocal relation
 * @method     MeshingTrustTypeQuery innerJoinMeshingTrustLocal($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustLocal relation
 *
 * @method     MeshingTrustTypeQuery leftJoinMeshingTrustRemote($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingTrustRemote relation
 * @method     MeshingTrustTypeQuery rightJoinMeshingTrustRemote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingTrustRemote relation
 * @method     MeshingTrustTypeQuery innerJoinMeshingTrustRemote($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingTrustRemote relation
 *
 * @method     MeshingTrustType findOne(PropelPDO $con = null) Return the first MeshingTrustType matching the query
 * @method     MeshingTrustType findOneOrCreate(PropelPDO $con = null) Return the first MeshingTrustType matching the query, or a new MeshingTrustType object populated from the query conditions when no match is found
 *
 * @method     MeshingTrustType findOneById(int $id) Return the first MeshingTrustType filtered by the id column
 * @method     MeshingTrustType findOneByName(string $name) Return the first MeshingTrustType filtered by the name column
 * @method     MeshingTrustType findOneByPreferredAuth(string $preferred_auth) Return the first MeshingTrustType filtered by the preferred_auth column
 *
 * @method     array findById(int $id) Return MeshingTrustType objects filtered by the id column
 * @method     array findByName(string $name) Return MeshingTrustType objects filtered by the name column
 * @method     array findByPreferredAuth(string $preferred_auth) Return MeshingTrustType objects filtered by the preferred_auth column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingTrustTypeQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMeshingTrustTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'MeshingTrustType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MeshingTrustTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MeshingTrustTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MeshingTrustTypeQuery) {
			return $criteria;
		}
		$query = new MeshingTrustTypeQuery();
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
	 * @return    MeshingTrustType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MeshingTrustTypePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MeshingTrustTypePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MeshingTrustTypePeer::ID, $keys, Criteria::IN);
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
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingTrustTypePeer::ID, $id, $comparison);
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
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MeshingTrustTypePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the preferred_auth column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPreferredAuth('fooValue');   // WHERE preferred_auth = 'fooValue'
	 * $query->filterByPreferredAuth('%fooValue%'); // WHERE preferred_auth LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $preferredAuth The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterByPreferredAuth($preferredAuth = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($preferredAuth)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $preferredAuth)) {
				$preferredAuth = str_replace('*', '%', $preferredAuth);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingTrustTypePeer::PREFERRED_AUTH, $preferredAuth, $comparison);
	}

	/**
	 * Filter the query by a related MeshingTrustLocal object
	 *
	 * @param     MeshingTrustLocal $meshingTrustLocal  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustLocal($meshingTrustLocal, $comparison = null)
	{
		if ($meshingTrustLocal instanceof MeshingTrustLocal) {
			return $this
				->addUsingAlias(MeshingTrustTypePeer::ID, $meshingTrustLocal->getType(), $comparison);
		} elseif ($meshingTrustLocal instanceof PropelCollection) {
			return $this
				->useMeshingTrustLocalQuery()
					->filterByPrimaryKeys($meshingTrustLocal->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustLocal() only accepts arguments of type MeshingTrustLocal or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustLocal relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustLocal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustLocal');
		
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
			$this->addJoinObject($join, 'MeshingTrustLocal');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustLocal relation MeshingTrustLocal object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustLocalQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustLocalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustLocal($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustLocal', 'MeshingTrustLocalQuery');
	}

	/**
	 * Filter the query by a related MeshingTrustRemote object
	 *
	 * @param     MeshingTrustRemote $meshingTrustRemote  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function filterByMeshingTrustRemote($meshingTrustRemote, $comparison = null)
	{
		if ($meshingTrustRemote instanceof MeshingTrustRemote) {
			return $this
				->addUsingAlias(MeshingTrustTypePeer::ID, $meshingTrustRemote->getType(), $comparison);
		} elseif ($meshingTrustRemote instanceof PropelCollection) {
			return $this
				->useMeshingTrustRemoteQuery()
					->filterByPrimaryKeys($meshingTrustRemote->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingTrustRemote() only accepts arguments of type MeshingTrustRemote or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingTrustRemote relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function joinMeshingTrustRemote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingTrustRemote');
		
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
			$this->addJoinObject($join, 'MeshingTrustRemote');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingTrustRemote relation MeshingTrustRemote object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingTrustRemoteQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingTrustRemoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingTrustRemote($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingTrustRemote', 'MeshingTrustRemoteQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MeshingTrustType $meshingTrustType Object to remove from the list of results
	 *
	 * @return    MeshingTrustTypeQuery The current query, for fluid interface
	 */
	public function prune($meshingTrustType = null)
	{
		if ($meshingTrustType) {
			$this->addUsingAlias(MeshingTrustTypePeer::ID, $meshingTrustType->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseMeshingTrustTypeQuery
