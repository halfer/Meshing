<?php


/**
 * Base class that represents a query for the 'meshing_schema' table.
 *
 * 
 *
 * @method     MeshingSchemaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MeshingSchemaQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     MeshingSchemaQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     MeshingSchemaQuery orderByAuthor($order = Criteria::ASC) Order by the author column
 * @method     MeshingSchemaQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method     MeshingSchemaQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     MeshingSchemaQuery orderByDateRelease($order = Criteria::ASC) Order by the date_release column
 * @method     MeshingSchemaQuery orderBySchemaVersion($order = Criteria::ASC) Order by the schema_version column
 * @method     MeshingSchemaQuery orderBySoftwareVersion($order = Criteria::ASC) Order by the software_version column
 * @method     MeshingSchemaQuery orderByHistory($order = Criteria::ASC) Order by the history column
 * @method     MeshingSchemaQuery orderByInstalledAt($order = Criteria::ASC) Order by the installed_at column
 *
 * @method     MeshingSchemaQuery groupById() Group by the id column
 * @method     MeshingSchemaQuery groupByName() Group by the name column
 * @method     MeshingSchemaQuery groupByDescription() Group by the description column
 * @method     MeshingSchemaQuery groupByAuthor() Group by the author column
 * @method     MeshingSchemaQuery groupByContact() Group by the contact column
 * @method     MeshingSchemaQuery groupByUrl() Group by the url column
 * @method     MeshingSchemaQuery groupByDateRelease() Group by the date_release column
 * @method     MeshingSchemaQuery groupBySchemaVersion() Group by the schema_version column
 * @method     MeshingSchemaQuery groupBySoftwareVersion() Group by the software_version column
 * @method     MeshingSchemaQuery groupByHistory() Group by the history column
 * @method     MeshingSchemaQuery groupByInstalledAt() Group by the installed_at column
 *
 * @method     MeshingSchemaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MeshingSchemaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MeshingSchemaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MeshingSchemaQuery leftJoinP2POwnNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the P2POwnNode relation
 * @method     MeshingSchemaQuery rightJoinP2POwnNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the P2POwnNode relation
 * @method     MeshingSchemaQuery innerJoinP2POwnNode($relationAlias = null) Adds a INNER JOIN clause to the query using the P2POwnNode relation
 *
 * @method     MeshingSchemaQuery leftJoinMeshingSchemaTable($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeshingSchemaTable relation
 * @method     MeshingSchemaQuery rightJoinMeshingSchemaTable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeshingSchemaTable relation
 * @method     MeshingSchemaQuery innerJoinMeshingSchemaTable($relationAlias = null) Adds a INNER JOIN clause to the query using the MeshingSchemaTable relation
 *
 * @method     MeshingSchema findOne(PropelPDO $con = null) Return the first MeshingSchema matching the query
 * @method     MeshingSchema findOneOrCreate(PropelPDO $con = null) Return the first MeshingSchema matching the query, or a new MeshingSchema object populated from the query conditions when no match is found
 *
 * @method     MeshingSchema findOneById(int $id) Return the first MeshingSchema filtered by the id column
 * @method     MeshingSchema findOneByName(string $name) Return the first MeshingSchema filtered by the name column
 * @method     MeshingSchema findOneByDescription(string $description) Return the first MeshingSchema filtered by the description column
 * @method     MeshingSchema findOneByAuthor(string $author) Return the first MeshingSchema filtered by the author column
 * @method     MeshingSchema findOneByContact(string $contact) Return the first MeshingSchema filtered by the contact column
 * @method     MeshingSchema findOneByUrl(string $url) Return the first MeshingSchema filtered by the url column
 * @method     MeshingSchema findOneByDateRelease(string $date_release) Return the first MeshingSchema filtered by the date_release column
 * @method     MeshingSchema findOneBySchemaVersion(double $schema_version) Return the first MeshingSchema filtered by the schema_version column
 * @method     MeshingSchema findOneBySoftwareVersion(double $software_version) Return the first MeshingSchema filtered by the software_version column
 * @method     MeshingSchema findOneByHistory(string $history) Return the first MeshingSchema filtered by the history column
 * @method     MeshingSchema findOneByInstalledAt(string $installed_at) Return the first MeshingSchema filtered by the installed_at column
 *
 * @method     array findById(int $id) Return MeshingSchema objects filtered by the id column
 * @method     array findByName(string $name) Return MeshingSchema objects filtered by the name column
 * @method     array findByDescription(string $description) Return MeshingSchema objects filtered by the description column
 * @method     array findByAuthor(string $author) Return MeshingSchema objects filtered by the author column
 * @method     array findByContact(string $contact) Return MeshingSchema objects filtered by the contact column
 * @method     array findByUrl(string $url) Return MeshingSchema objects filtered by the url column
 * @method     array findByDateRelease(string $date_release) Return MeshingSchema objects filtered by the date_release column
 * @method     array findBySchemaVersion(double $schema_version) Return MeshingSchema objects filtered by the schema_version column
 * @method     array findBySoftwareVersion(double $software_version) Return MeshingSchema objects filtered by the software_version column
 * @method     array findByHistory(string $history) Return MeshingSchema objects filtered by the history column
 * @method     array findByInstalledAt(string $installed_at) Return MeshingSchema objects filtered by the installed_at column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingSchemaQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMeshingSchemaQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'p2p', $modelName = 'MeshingSchema', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MeshingSchemaQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MeshingSchemaQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MeshingSchemaQuery) {
			return $criteria;
		}
		$query = new MeshingSchemaQuery();
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
	 * @return    MeshingSchema|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MeshingSchemaPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MeshingSchemaPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MeshingSchemaPeer::ID, $keys, Criteria::IN);
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
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MeshingSchemaPeer::ID, $id, $comparison);
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
	 * @return    MeshingSchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MeshingSchemaPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the author column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAuthor('fooValue');   // WHERE author = 'fooValue'
	 * $query->filterByAuthor('%fooValue%'); // WHERE author LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $author The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByAuthor($author = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($author)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $author)) {
				$author = str_replace('*', '%', $author);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::AUTHOR, $author, $comparison);
	}

	/**
	 * Filter the query on the contact column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByContact('fooValue');   // WHERE contact = 'fooValue'
	 * $query->filterByContact('%fooValue%'); // WHERE contact LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $contact The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByContact($contact = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($contact)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $contact)) {
				$contact = str_replace('*', '%', $contact);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::CONTACT, $contact, $comparison);
	}

	/**
	 * Filter the query on the url column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
	 * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $url The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByUrl($url = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($url)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $url)) {
				$url = str_replace('*', '%', $url);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::URL, $url, $comparison);
	}

	/**
	 * Filter the query on the date_release column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDateRelease('2011-03-14'); // WHERE date_release = '2011-03-14'
	 * $query->filterByDateRelease('now'); // WHERE date_release = '2011-03-14'
	 * $query->filterByDateRelease(array('max' => 'yesterday')); // WHERE date_release > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dateRelease The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByDateRelease($dateRelease = null, $comparison = null)
	{
		if (is_array($dateRelease)) {
			$useMinMax = false;
			if (isset($dateRelease['min'])) {
				$this->addUsingAlias(MeshingSchemaPeer::DATE_RELEASE, $dateRelease['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateRelease['max'])) {
				$this->addUsingAlias(MeshingSchemaPeer::DATE_RELEASE, $dateRelease['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::DATE_RELEASE, $dateRelease, $comparison);
	}

	/**
	 * Filter the query on the schema_version column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySchemaVersion(1234); // WHERE schema_version = 1234
	 * $query->filterBySchemaVersion(array(12, 34)); // WHERE schema_version IN (12, 34)
	 * $query->filterBySchemaVersion(array('min' => 12)); // WHERE schema_version > 12
	 * </code>
	 *
	 * @param     mixed $schemaVersion The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterBySchemaVersion($schemaVersion = null, $comparison = null)
	{
		if (is_array($schemaVersion)) {
			$useMinMax = false;
			if (isset($schemaVersion['min'])) {
				$this->addUsingAlias(MeshingSchemaPeer::SCHEMA_VERSION, $schemaVersion['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaVersion['max'])) {
				$this->addUsingAlias(MeshingSchemaPeer::SCHEMA_VERSION, $schemaVersion['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::SCHEMA_VERSION, $schemaVersion, $comparison);
	}

	/**
	 * Filter the query on the software_version column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySoftwareVersion(1234); // WHERE software_version = 1234
	 * $query->filterBySoftwareVersion(array(12, 34)); // WHERE software_version IN (12, 34)
	 * $query->filterBySoftwareVersion(array('min' => 12)); // WHERE software_version > 12
	 * </code>
	 *
	 * @param     mixed $softwareVersion The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterBySoftwareVersion($softwareVersion = null, $comparison = null)
	{
		if (is_array($softwareVersion)) {
			$useMinMax = false;
			if (isset($softwareVersion['min'])) {
				$this->addUsingAlias(MeshingSchemaPeer::SOFTWARE_VERSION, $softwareVersion['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($softwareVersion['max'])) {
				$this->addUsingAlias(MeshingSchemaPeer::SOFTWARE_VERSION, $softwareVersion['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::SOFTWARE_VERSION, $softwareVersion, $comparison);
	}

	/**
	 * Filter the query on the history column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByHistory('fooValue');   // WHERE history = 'fooValue'
	 * $query->filterByHistory('%fooValue%'); // WHERE history LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $history The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByHistory($history = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($history)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $history)) {
				$history = str_replace('*', '%', $history);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::HISTORY, $history, $comparison);
	}

	/**
	 * Filter the query on the installed_at column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByInstalledAt('2011-03-14'); // WHERE installed_at = '2011-03-14'
	 * $query->filterByInstalledAt('now'); // WHERE installed_at = '2011-03-14'
	 * $query->filterByInstalledAt(array('max' => 'yesterday')); // WHERE installed_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $installedAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByInstalledAt($installedAt = null, $comparison = null)
	{
		if (is_array($installedAt)) {
			$useMinMax = false;
			if (isset($installedAt['min'])) {
				$this->addUsingAlias(MeshingSchemaPeer::INSTALLED_AT, $installedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($installedAt['max'])) {
				$this->addUsingAlias(MeshingSchemaPeer::INSTALLED_AT, $installedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MeshingSchemaPeer::INSTALLED_AT, $installedAt, $comparison);
	}

	/**
	 * Filter the query by a related P2POwnNode object
	 *
	 * @param     P2POwnNode $p2POwnNode  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByP2POwnNode($p2POwnNode, $comparison = null)
	{
		if ($p2POwnNode instanceof P2POwnNode) {
			return $this
				->addUsingAlias(MeshingSchemaPeer::ID, $p2POwnNode->getSchemaId(), $comparison);
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
	 * @return    MeshingSchemaQuery The current query, for fluid interface
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
	 * Filter the query by a related MeshingSchemaTable object
	 *
	 * @param     MeshingSchemaTable $meshingSchemaTable  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function filterByMeshingSchemaTable($meshingSchemaTable, $comparison = null)
	{
		if ($meshingSchemaTable instanceof MeshingSchemaTable) {
			return $this
				->addUsingAlias(MeshingSchemaPeer::ID, $meshingSchemaTable->getSchemaId(), $comparison);
		} elseif ($meshingSchemaTable instanceof PropelCollection) {
			return $this
				->useMeshingSchemaTableQuery()
					->filterByPrimaryKeys($meshingSchemaTable->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMeshingSchemaTable() only accepts arguments of type MeshingSchemaTable or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MeshingSchemaTable relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function joinMeshingSchemaTable($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MeshingSchemaTable');
		
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
			$this->addJoinObject($join, 'MeshingSchemaTable');
		}
		
		return $this;
	}

	/**
	 * Use the MeshingSchemaTable relation MeshingSchemaTable object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MeshingSchemaTableQuery A secondary query class using the current class as primary query
	 */
	public function useMeshingSchemaTableQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMeshingSchemaTable($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MeshingSchemaTable', 'MeshingSchemaTableQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MeshingSchema $meshingSchema Object to remove from the list of results
	 *
	 * @return    MeshingSchemaQuery The current query, for fluid interface
	 */
	public function prune($meshingSchema = null)
	{
		if ($meshingSchema) {
			$this->addUsingAlias(MeshingSchemaPeer::ID, $meshingSchema->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseMeshingSchemaQuery
