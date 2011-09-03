<?php

namespace P2PT/System\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use P2PT/System\OwnNode;
use P2PT/System\SchemaPeer;
use P2PT/System\SchemaQuery;
use P2PT/System\SchemaTable;

/**
 * Base class that represents a query for the 'schema' table.
 *
 * 
 *
 * @method     SchemaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SchemaQuery orderByXml($order = Criteria::ASC) Order by the xml column
 * @method     SchemaQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SchemaQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     SchemaQuery orderByAuthor($order = Criteria::ASC) Order by the author column
 * @method     SchemaQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method     SchemaQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     SchemaQuery orderByDateRelease($order = Criteria::ASC) Order by the date_release column
 * @method     SchemaQuery orderBySchemaVersion($order = Criteria::ASC) Order by the schema_version column
 * @method     SchemaQuery orderBySoftwareVersion($order = Criteria::ASC) Order by the software_version column
 * @method     SchemaQuery orderByHistory($order = Criteria::ASC) Order by the history column
 * @method     SchemaQuery orderByInstalledAt($order = Criteria::ASC) Order by the installed_at column
 *
 * @method     SchemaQuery groupById() Group by the id column
 * @method     SchemaQuery groupByXml() Group by the xml column
 * @method     SchemaQuery groupByName() Group by the name column
 * @method     SchemaQuery groupByDescription() Group by the description column
 * @method     SchemaQuery groupByAuthor() Group by the author column
 * @method     SchemaQuery groupByContact() Group by the contact column
 * @method     SchemaQuery groupByUrl() Group by the url column
 * @method     SchemaQuery groupByDateRelease() Group by the date_release column
 * @method     SchemaQuery groupBySchemaVersion() Group by the schema_version column
 * @method     SchemaQuery groupBySoftwareVersion() Group by the software_version column
 * @method     SchemaQuery groupByHistory() Group by the history column
 * @method     SchemaQuery groupByInstalledAt() Group by the installed_at column
 *
 * @method     SchemaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SchemaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SchemaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SchemaQuery leftJoinOwnNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the OwnNode relation
 * @method     SchemaQuery rightJoinOwnNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OwnNode relation
 * @method     SchemaQuery innerJoinOwnNode($relationAlias = null) Adds a INNER JOIN clause to the query using the OwnNode relation
 *
 * @method     SchemaQuery leftJoinSchemaTable($relationAlias = null) Adds a LEFT JOIN clause to the query using the SchemaTable relation
 * @method     SchemaQuery rightJoinSchemaTable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SchemaTable relation
 * @method     SchemaQuery innerJoinSchemaTable($relationAlias = null) Adds a INNER JOIN clause to the query using the SchemaTable relation
 *
 * @method     Schema findOne(PropelPDO $con = null) Return the first Schema matching the query
 * @method     Schema findOneOrCreate(PropelPDO $con = null) Return the first Schema matching the query, or a new Schema object populated from the query conditions when no match is found
 *
 * @method     Schema findOneById(int $id) Return the first Schema filtered by the id column
 * @method     Schema findOneByXml(string $xml) Return the first Schema filtered by the xml column
 * @method     Schema findOneByName(string $name) Return the first Schema filtered by the name column
 * @method     Schema findOneByDescription(string $description) Return the first Schema filtered by the description column
 * @method     Schema findOneByAuthor(string $author) Return the first Schema filtered by the author column
 * @method     Schema findOneByContact(string $contact) Return the first Schema filtered by the contact column
 * @method     Schema findOneByUrl(string $url) Return the first Schema filtered by the url column
 * @method     Schema findOneByDateRelease(string $date_release) Return the first Schema filtered by the date_release column
 * @method     Schema findOneBySchemaVersion(double $schema_version) Return the first Schema filtered by the schema_version column
 * @method     Schema findOneBySoftwareVersion(double $software_version) Return the first Schema filtered by the software_version column
 * @method     Schema findOneByHistory(string $history) Return the first Schema filtered by the history column
 * @method     Schema findOneByInstalledAt(string $installed_at) Return the first Schema filtered by the installed_at column
 *
 * @method     array findById(int $id) Return Schema objects filtered by the id column
 * @method     array findByXml(string $xml) Return Schema objects filtered by the xml column
 * @method     array findByName(string $name) Return Schema objects filtered by the name column
 * @method     array findByDescription(string $description) Return Schema objects filtered by the description column
 * @method     array findByAuthor(string $author) Return Schema objects filtered by the author column
 * @method     array findByContact(string $contact) Return Schema objects filtered by the contact column
 * @method     array findByUrl(string $url) Return Schema objects filtered by the url column
 * @method     array findByDateRelease(string $date_release) Return Schema objects filtered by the date_release column
 * @method     array findBySchemaVersion(double $schema_version) Return Schema objects filtered by the schema_version column
 * @method     array findBySoftwareVersion(double $software_version) Return Schema objects filtered by the software_version column
 * @method     array findByHistory(string $history) Return Schema objects filtered by the history column
 * @method     array findByInstalledAt(string $installed_at) Return Schema objects filtered by the installed_at column
 *
 * @package    propel.generator.system.om
 */
abstract class BaseSchemaQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSchemaQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'default', $modelName = 'P2PT/System\\Schema', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SchemaQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SchemaQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SchemaQuery) {
			return $criteria;
		}
		$query = new SchemaQuery();
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
	 * @return    Schema|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SchemaPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SchemaPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SchemaPeer::ID, $keys, Criteria::IN);
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SchemaPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the xml column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByXml('fooValue');   // WHERE xml = 'fooValue'
	 * $query->filterByXml('%fooValue%'); // WHERE xml LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $xml The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByXml($xml = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($xml)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $xml)) {
				$xml = str_replace('*', '%', $xml);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchemaPeer::XML, $xml, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::NAME, $name, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::DESCRIPTION, $description, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::AUTHOR, $author, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::CONTACT, $contact, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::URL, $url, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByDateRelease($dateRelease = null, $comparison = null)
	{
		if (is_array($dateRelease)) {
			$useMinMax = false;
			if (isset($dateRelease['min'])) {
				$this->addUsingAlias(SchemaPeer::DATE_RELEASE, $dateRelease['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateRelease['max'])) {
				$this->addUsingAlias(SchemaPeer::DATE_RELEASE, $dateRelease['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaPeer::DATE_RELEASE, $dateRelease, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterBySchemaVersion($schemaVersion = null, $comparison = null)
	{
		if (is_array($schemaVersion)) {
			$useMinMax = false;
			if (isset($schemaVersion['min'])) {
				$this->addUsingAlias(SchemaPeer::SCHEMA_VERSION, $schemaVersion['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schemaVersion['max'])) {
				$this->addUsingAlias(SchemaPeer::SCHEMA_VERSION, $schemaVersion['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaPeer::SCHEMA_VERSION, $schemaVersion, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterBySoftwareVersion($softwareVersion = null, $comparison = null)
	{
		if (is_array($softwareVersion)) {
			$useMinMax = false;
			if (isset($softwareVersion['min'])) {
				$this->addUsingAlias(SchemaPeer::SOFTWARE_VERSION, $softwareVersion['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($softwareVersion['max'])) {
				$this->addUsingAlias(SchemaPeer::SOFTWARE_VERSION, $softwareVersion['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaPeer::SOFTWARE_VERSION, $softwareVersion, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchemaPeer::HISTORY, $history, $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByInstalledAt($installedAt = null, $comparison = null)
	{
		if (is_array($installedAt)) {
			$useMinMax = false;
			if (isset($installedAt['min'])) {
				$this->addUsingAlias(SchemaPeer::INSTALLED_AT, $installedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($installedAt['max'])) {
				$this->addUsingAlias(SchemaPeer::INSTALLED_AT, $installedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchemaPeer::INSTALLED_AT, $installedAt, $comparison);
	}

	/**
	 * Filter the query by a related OwnNode object
	 *
	 * @param     OwnNode $ownNode  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterByOwnNode($ownNode, $comparison = null)
	{
		if ($ownNode instanceof OwnNode) {
			return $this
				->addUsingAlias(SchemaPeer::ID, $ownNode->getSchemaId(), $comparison);
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
	 * @return    SchemaQuery The current query, for fluid interface
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
	 * Filter the query by a related SchemaTable object
	 *
	 * @param     SchemaTable $schemaTable  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function filterBySchemaTable($schemaTable, $comparison = null)
	{
		if ($schemaTable instanceof SchemaTable) {
			return $this
				->addUsingAlias(SchemaPeer::ID, $schemaTable->getSchemaId(), $comparison);
		} elseif ($schemaTable instanceof PropelCollection) {
			return $this
				->useSchemaTableQuery()
					->filterByPrimaryKeys($schemaTable->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBySchemaTable() only accepts arguments of type SchemaTable or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the SchemaTable relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function joinSchemaTable($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SchemaTable');
		
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
			$this->addJoinObject($join, 'SchemaTable');
		}
		
		return $this;
	}

	/**
	 * Use the SchemaTable relation SchemaTable object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \P2PT/System\SchemaTableQuery A secondary query class using the current class as primary query
	 */
	public function useSchemaTableQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSchemaTable($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SchemaTable', '\P2PT/System\SchemaTableQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Schema $schema Object to remove from the list of results
	 *
	 * @return    SchemaQuery The current query, for fluid interface
	 */
	public function prune($schema = null)
	{
		if ($schema) {
			$this->addUsingAlias(SchemaPeer::ID, $schema->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSchemaQuery
