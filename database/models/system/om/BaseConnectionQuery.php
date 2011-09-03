<?php

namespace P2PT/System\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use P2PT/System\ConnectionPeer;
use P2PT/System\ConnectionQuery;
use P2PT/System\OwnNode;

/**
 * Base class that represents a query for the 'connection' table.
 *
 * 
 *
 * @method     ConnectionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ConnectionQuery orderByHost($order = Criteria::ASC) Order by the host column
 * @method     ConnectionQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method     ConnectionQuery orderByPassword($order = Criteria::ASC) Order by the password column
 *
 * @method     ConnectionQuery groupById() Group by the id column
 * @method     ConnectionQuery groupByHost() Group by the host column
 * @method     ConnectionQuery groupByUser() Group by the user column
 * @method     ConnectionQuery groupByPassword() Group by the password column
 *
 * @method     ConnectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ConnectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ConnectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ConnectionQuery leftJoinOwnNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the OwnNode relation
 * @method     ConnectionQuery rightJoinOwnNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OwnNode relation
 * @method     ConnectionQuery innerJoinOwnNode($relationAlias = null) Adds a INNER JOIN clause to the query using the OwnNode relation
 *
 * @method     Connection findOne(PropelPDO $con = null) Return the first Connection matching the query
 * @method     Connection findOneOrCreate(PropelPDO $con = null) Return the first Connection matching the query, or a new Connection object populated from the query conditions when no match is found
 *
 * @method     Connection findOneById(int $id) Return the first Connection filtered by the id column
 * @method     Connection findOneByHost(string $host) Return the first Connection filtered by the host column
 * @method     Connection findOneByUser(string $user) Return the first Connection filtered by the user column
 * @method     Connection findOneByPassword(string $password) Return the first Connection filtered by the password column
 *
 * @method     array findById(int $id) Return Connection objects filtered by the id column
 * @method     array findByHost(string $host) Return Connection objects filtered by the host column
 * @method     array findByUser(string $user) Return Connection objects filtered by the user column
 * @method     array findByPassword(string $password) Return Connection objects filtered by the password column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseConnectionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseConnectionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'default', $modelName = 'P2PT/System\\Connection', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ConnectionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ConnectionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ConnectionQuery) {
			return $criteria;
		}
		$query = new ConnectionQuery();
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
	 * @return    Connection|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ConnectionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ConnectionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ConnectionPeer::ID, $keys, Criteria::IN);
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
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ConnectionPeer::ID, $id, $comparison);
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
	 * @return    ConnectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ConnectionPeer::HOST, $host, $comparison);
	}

	/**
	 * Filter the query on the user column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUser('fooValue');   // WHERE user = 'fooValue'
	 * $query->filterByUser('%fooValue%'); // WHERE user LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $user The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function filterByUser($user = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($user)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $user)) {
				$user = str_replace('*', '%', $user);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ConnectionPeer::USER, $user, $comparison);
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
	 * @return    ConnectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ConnectionPeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query by a related OwnNode object
	 *
	 * @param     OwnNode $ownNode  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function filterByOwnNode($ownNode, $comparison = null)
	{
		if ($ownNode instanceof OwnNode) {
			return $this
				->addUsingAlias(ConnectionPeer::ID, $ownNode->getConnectionId(), $comparison);
		} elseif ($ownNode instanceof PropelCollection) {
			return $this
				->useOwnNodeQuery()
					->filterByPrimaryKeys($ownNode->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByOwnNode() only accepts arguments of type OwnNode or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the OwnNode relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function joinOwnNode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('OwnNode');
		
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
			$this->addJoinObject($join, 'OwnNode');
		}
		
		return $this;
	}

	/**
	 * Use the OwnNode relation OwnNode object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \P2PT/System\OwnNodeQuery A secondary query class using the current class as primary query
	 */
	public function useOwnNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinOwnNode($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'OwnNode', '\P2PT/System\OwnNodeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Connection $connection Object to remove from the list of results
	 *
	 * @return    ConnectionQuery The current query, for fluid interface
	 */
	public function prune($connection = null)
	{
		if ($connection) {
			$this->addUsingAlias(ConnectionPeer::ID, $connection->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseConnectionQuery
