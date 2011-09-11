<?php


/**
 * Base class that represents a query for the 'p2p_connection' table.
 *
 * 
 *
 * @method     P2PConnectionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     P2PConnectionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     P2PConnectionQuery orderByAdaptor($order = Criteria::ASC) Order by the adaptor column
 * @method     P2PConnectionQuery orderByHost($order = Criteria::ASC) Order by the host column
 * @method     P2PConnectionQuery orderByDatabase($order = Criteria::ASC) Order by the database column
 * @method     P2PConnectionQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     P2PConnectionQuery orderByPassword($order = Criteria::ASC) Order by the password column
 *
 * @method     P2PConnectionQuery groupById() Group by the id column
 * @method     P2PConnectionQuery groupByName() Group by the name column
 * @method     P2PConnectionQuery groupByAdaptor() Group by the adaptor column
 * @method     P2PConnectionQuery groupByHost() Group by the host column
 * @method     P2PConnectionQuery groupByDatabase() Group by the database column
 * @method     P2PConnectionQuery groupByUsername() Group by the username column
 * @method     P2PConnectionQuery groupByPassword() Group by the password column
 *
 * @method     P2PConnectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     P2PConnectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     P2PConnectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     P2PConnectionQuery leftJoinP2POwnNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2POwnNode relation
 * @method     P2PConnectionQuery rightJoinP2POwnNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2POwnNode relation
 * @method     P2PConnectionQuery innerJoinP2POwnNode($relationAlias = null) Adds a INNER JOIN clause to the query using the P2POwnNode relation
 *
 * @method     P2PConnection findOne(PropelPDO $con = null) Return the first P2PConnection matching the query
 * @method     P2PConnection findOneOrCreate(PropelPDO $con = null) Return the first P2PConnection matching the query, or a new P2PConnection object populated from the query conditions when no match is found
 *
 * @method     P2PConnection findOneById(int $id) Return the first P2PConnection filtered by the id column
 * @method     P2PConnection findOneByName(string $name) Return the first P2PConnection filtered by the name column
 * @method     P2PConnection findOneByAdaptor(string $adaptor) Return the first P2PConnection filtered by the adaptor column
 * @method     P2PConnection findOneByHost(string $host) Return the first P2PConnection filtered by the host column
 * @method     P2PConnection findOneByDatabase(string $database) Return the first P2PConnection filtered by the database column
 * @method     P2PConnection findOneByUsername(string $username) Return the first P2PConnection filtered by the username column
 * @method     P2PConnection findOneByPassword(string $password) Return the first P2PConnection filtered by the password column
 *
 * @method     array findById(int $id) Return P2PConnection objects filtered by the id column
 * @method     array findByName(string $name) Return P2PConnection objects filtered by the name column
 * @method     array findByAdaptor(string $adaptor) Return P2PConnection objects filtered by the adaptor column
 * @method     array findByHost(string $host) Return P2PConnection objects filtered by the host column
 * @method     array findByDatabase(string $database) Return P2PConnection objects filtered by the database column
 * @method     array findByUsername(string $username) Return P2PConnection objects filtered by the username column
 * @method     array findByPassword(string $password) Return P2PConnection objects filtered by the password column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseP2PConnectionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseP2PConnectionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'P2PConnection', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new P2PConnectionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    P2PConnectionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof P2PConnectionQuery) {
			return $criteria;
		}
		$query = new P2PConnectionQuery();
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
	 * @return    P2PConnection|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = P2PConnectionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(P2PConnectionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(P2PConnectionPeer::ID, $keys, Criteria::IN);
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
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(P2PConnectionPeer::ID, $id, $comparison);
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
	 * @return    P2PConnectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(P2PConnectionPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the adaptor column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAdaptor('fooValue');   // WHERE adaptor = 'fooValue'
	 * $query->filterByAdaptor('%fooValue%'); // WHERE adaptor LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $adaptor The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByAdaptor($adaptor = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($adaptor)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $adaptor)) {
				$adaptor = str_replace('*', '%', $adaptor);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(P2PConnectionPeer::ADAPTOR, $adaptor, $comparison);
	}

	/**
	 * Filter the query on the host column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByHost('fooValue');   // WHERE host = 'fooValue'
	 * $query->filterByHost('%fooValue%'); // WHERE host LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $host The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByHost($host = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($host)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $host)) {
				$host = str_replace('*', '%', $host);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(P2PConnectionPeer::HOST, $host, $comparison);
	}

	/**
	 * Filter the query on the database column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDatabase('fooValue');   // WHERE database = 'fooValue'
	 * $query->filterByDatabase('%fooValue%'); // WHERE database LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $database The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByDatabase($database = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($database)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $database)) {
				$database = str_replace('*', '%', $database);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(P2PConnectionPeer::DATABASE, $database, $comparison);
	}

	/**
	 * Filter the query on the username column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
	 * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $username The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByUsername($username = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($username)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $username)) {
				$username = str_replace('*', '%', $username);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(P2PConnectionPeer::USERNAME, $username, $comparison);
	}

	/**
	 * Filter the query on the password column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
	 * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $password The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByPassword($password = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($password)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $password)) {
				$password = str_replace('*', '%', $password);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(P2PConnectionPeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode $p2POwnNode  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function filterByP2POwnNode($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(P2PConnectionPeer::ID, $p2POwnNode->getConnectionId(), $comparison);
		} elseif ($p2POwnNode instanceof PropelCollection) {
			return $this
				->useP2POwnNodeQuery()
					->filterByPrimaryKeys($p2POwnNode->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByP2POwnNode() only accepts arguments of type P2POwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the P2POwnNode relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function joinP2POwnNode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('P2POwnNode');
		
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
			$this->addJoinObject($join, 'P2POwnNode');
		}
		
		return $this;
	}

	/**
	 * Use the P2POwnNode relation P2POwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    P2POwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useP2POwnNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinP2POwnNode($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'P2POwnNode', 'P2POwnNodeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     P2PConnection $p2PConnection Object to remove from the list of results
	 *
	 * @return    P2PConnectionQuery The current query, for fluid interface
	 */
	public function prune($p2PConnection = null)
	{
		if ($p2PConnection) {
			$this->addUsingAlias(P2PConnectionPeer::ID, $p2PConnection->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseP2PConnectionQuery
