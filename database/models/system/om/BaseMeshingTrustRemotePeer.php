<?php


/**
 * Base static class for performing query and update operations on the 'meshing_trust_remote' table.
 *
 * 
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingTrustRemotePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'p2p';

	/** the table name for this class */
	const TABLE_NAME = 'meshing_trust_remote';

	/** the related Propel class for this table */
	const OM_CLASS = 'MeshingTrustRemote';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'system.MeshingTrustRemote';

	/** the related TableMap class for this table */
	const TM_CLASS = 'MeshingTrustRemoteTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 5;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 5;

	/** the column name for the FROM_OWN_NODE_ID field */
	const FROM_OWN_NODE_ID = 'meshing_trust_remote.FROM_OWN_NODE_ID';

	/** the column name for the IN_OWN_NODE_ID field */
	const IN_OWN_NODE_ID = 'meshing_trust_remote.IN_OWN_NODE_ID';

	/** the column name for the KNOWN_NODE_ID field */
	const KNOWN_NODE_ID = 'meshing_trust_remote.KNOWN_NODE_ID';

	/** the column name for the DIRECTION field */
	const DIRECTION = 'meshing_trust_remote.DIRECTION';

	/** the column name for the TYPE field */
	const TYPE = 'meshing_trust_remote.TYPE';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';
	
	/**
	 * An identiy map to hold any loaded instances of MeshingTrustRemote objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array MeshingTrustRemote[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('FromOwnNodeId', 'InOwnNodeId', 'KnownNodeId', 'Direction', 'Type', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('fromOwnNodeId', 'inOwnNodeId', 'knownNodeId', 'direction', 'type', ),
		BasePeer::TYPE_COLNAME => array (self::FROM_OWN_NODE_ID, self::IN_OWN_NODE_ID, self::KNOWN_NODE_ID, self::DIRECTION, self::TYPE, ),
		BasePeer::TYPE_RAW_COLNAME => array ('FROM_OWN_NODE_ID', 'IN_OWN_NODE_ID', 'KNOWN_NODE_ID', 'DIRECTION', 'TYPE', ),
		BasePeer::TYPE_FIELDNAME => array ('from_own_node_id', 'in_own_node_id', 'known_node_id', 'direction', 'type', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('FromOwnNodeId' => 0, 'InOwnNodeId' => 1, 'KnownNodeId' => 2, 'Direction' => 3, 'Type' => 4, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('fromOwnNodeId' => 0, 'inOwnNodeId' => 1, 'knownNodeId' => 2, 'direction' => 3, 'type' => 4, ),
		BasePeer::TYPE_COLNAME => array (self::FROM_OWN_NODE_ID => 0, self::IN_OWN_NODE_ID => 1, self::KNOWN_NODE_ID => 2, self::DIRECTION => 3, self::TYPE => 4, ),
		BasePeer::TYPE_RAW_COLNAME => array ('FROM_OWN_NODE_ID' => 0, 'IN_OWN_NODE_ID' => 1, 'KNOWN_NODE_ID' => 2, 'DIRECTION' => 3, 'TYPE' => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('from_own_node_id' => 0, 'in_own_node_id' => 1, 'known_node_id' => 2, 'direction' => 3, 'type' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. MeshingTrustRemotePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MeshingTrustRemotePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(MeshingTrustRemotePeer::FROM_OWN_NODE_ID);
			$criteria->addSelectColumn(MeshingTrustRemotePeer::IN_OWN_NODE_ID);
			$criteria->addSelectColumn(MeshingTrustRemotePeer::KNOWN_NODE_ID);
			$criteria->addSelectColumn(MeshingTrustRemotePeer::DIRECTION);
			$criteria->addSelectColumn(MeshingTrustRemotePeer::TYPE);
		} else {
			$criteria->addSelectColumn($alias . '.FROM_OWN_NODE_ID');
			$criteria->addSelectColumn($alias . '.IN_OWN_NODE_ID');
			$criteria->addSelectColumn($alias . '.KNOWN_NODE_ID');
			$criteria->addSelectColumn($alias . '.DIRECTION');
			$criteria->addSelectColumn($alias . '.TYPE');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Selects one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     MeshingTrustRemote
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MeshingTrustRemotePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Selects several row from the DB.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return MeshingTrustRemotePeer::populateObjects(MeshingTrustRemotePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      MeshingTrustRemote $value A MeshingTrustRemote object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getFromOwnNodeId(), (string) $obj->getInOwnNodeId(), (string) $obj->getKnownNodeId()));
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A MeshingTrustRemote object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof MeshingTrustRemote) {
				$key = serialize(array((string) $value->getFromOwnNodeId(), (string) $value->getInOwnNodeId(), (string) $value->getKnownNodeId()));
			} elseif (is_array($value) && count($value) === 3) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or MeshingTrustRemote object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     MeshingTrustRemote Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to meshing_trust_remote
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1], (string) $row[$startcol + 2]));
	}

	/**
	 * Retrieves the primary key from the DB resultset row 
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return array((int) $row[$startcol], (int) $row[$startcol + 1], (int) $row[$startcol + 2]);
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = MeshingTrustRemotePeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = MeshingTrustRemotePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				MeshingTrustRemotePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (MeshingTrustRemote object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = MeshingTrustRemotePeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = MeshingTrustRemotePeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			MeshingTrustRemotePeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}


	/**
	 * Returns the number of rows matching criteria, joining the related FromOwnNode table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFromOwnNode(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related P2POwnNodeRelatedByInOwnNodeId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinP2POwnNodeRelatedByInOwnNodeId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related MeshingTrustType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMeshingTrustType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with their P2POwnNode objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFromOwnNode(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;
		P2POwnNodePeer::addSelectColumns($criteria);

		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = P2POwnNodePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = P2POwnNodePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					P2POwnNodePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to $obj2 (P2POwnNode)
				$obj2->addMeshingTrustRemoteRelatedByFromOwnNodeId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with their P2POwnNode objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinP2POwnNodeRelatedByInOwnNodeId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;
		P2POwnNodePeer::addSelectColumns($criteria);

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = P2POwnNodePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = P2POwnNodePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					P2POwnNodePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to $obj2 (P2POwnNode)
				$obj2->addMeshingTrustRemoteRelatedByInOwnNodeId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with their MeshingTrustType objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMeshingTrustType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;
		MeshingTrustTypePeer::addSelectColumns($criteria);

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = MeshingTrustTypePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = MeshingTrustTypePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = MeshingTrustTypePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					MeshingTrustTypePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to $obj2 (MeshingTrustType)
				$obj2->addMeshingTrustRemote($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol2 = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;

		P2POwnNodePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + P2POwnNodePeer::NUM_HYDRATE_COLUMNS;

		P2POwnNodePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + P2POwnNodePeer::NUM_HYDRATE_COLUMNS;

		MeshingTrustTypePeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + MeshingTrustTypePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined P2POwnNode rows

			$key2 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = P2POwnNodePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = P2POwnNodePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					P2POwnNodePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj2 (P2POwnNode)
				$obj2->addMeshingTrustRemoteRelatedByFromOwnNodeId($obj1);
			} // if joined row not null

			// Add objects for joined P2POwnNode rows

			$key3 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = P2POwnNodePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = P2POwnNodePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					P2POwnNodePeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj3 (P2POwnNode)
				$obj3->addMeshingTrustRemoteRelatedByInOwnNodeId($obj1);
			} // if joined row not null

			// Add objects for joined MeshingTrustType rows

			$key4 = MeshingTrustTypePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = MeshingTrustTypePeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = MeshingTrustTypePeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MeshingTrustTypePeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj4 (MeshingTrustType)
				$obj4->addMeshingTrustRemote($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related FromOwnNode table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptFromOwnNode(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related P2POwnNodeRelatedByInOwnNodeId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptP2POwnNodeRelatedByInOwnNodeId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related MeshingTrustType table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMeshingTrustType(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MeshingTrustRemotePeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with all related objects except FromOwnNode.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptFromOwnNode(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol2 = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;

		MeshingTrustTypePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + MeshingTrustTypePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined MeshingTrustType rows

				$key2 = MeshingTrustTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = MeshingTrustTypePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = MeshingTrustTypePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					MeshingTrustTypePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj2 (MeshingTrustType)
				$obj2->addMeshingTrustRemote($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with all related objects except P2POwnNodeRelatedByInOwnNodeId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptP2POwnNodeRelatedByInOwnNodeId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol2 = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;

		MeshingTrustTypePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + MeshingTrustTypePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MeshingTrustRemotePeer::TYPE, MeshingTrustTypePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined MeshingTrustType rows

				$key2 = MeshingTrustTypePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = MeshingTrustTypePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = MeshingTrustTypePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					MeshingTrustTypePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj2 (MeshingTrustType)
				$obj2->addMeshingTrustRemote($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of MeshingTrustRemote objects pre-filled with all related objects except MeshingTrustType.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of MeshingTrustRemote objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMeshingTrustType(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MeshingTrustRemotePeer::addSelectColumns($criteria);
		$startcol2 = MeshingTrustRemotePeer::NUM_HYDRATE_COLUMNS;

		P2POwnNodePeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + P2POwnNodePeer::NUM_HYDRATE_COLUMNS;

		P2POwnNodePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + P2POwnNodePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);

		$criteria->addJoin(MeshingTrustRemotePeer::IN_OWN_NODE_ID, P2POwnNodePeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MeshingTrustRemotePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MeshingTrustRemotePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MeshingTrustRemotePeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MeshingTrustRemotePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined P2POwnNode rows

				$key2 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = P2POwnNodePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = P2POwnNodePeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					P2POwnNodePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj2 (P2POwnNode)
				$obj2->addMeshingTrustRemoteRelatedByFromOwnNodeId($obj1);

			} // if joined row is not null

				// Add objects for joined P2POwnNode rows

				$key3 = P2POwnNodePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = P2POwnNodePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = P2POwnNodePeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					P2POwnNodePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (MeshingTrustRemote) to the collection in $obj3 (P2POwnNode)
				$obj3->addMeshingTrustRemoteRelatedByInOwnNodeId($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseMeshingTrustRemotePeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseMeshingTrustRemotePeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new MeshingTrustRemoteTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean $withPrefix Whether or not to return the path with the class name
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? MeshingTrustRemotePeer::CLASS_DEFAULT : MeshingTrustRemotePeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a MeshingTrustRemote or Criteria object.
	 *
	 * @param      mixed $values Criteria or MeshingTrustRemote object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from MeshingTrustRemote object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Performs an UPDATE on the database, given a MeshingTrustRemote or Criteria object.
	 *
	 * @param      mixed $values Criteria or MeshingTrustRemote object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(MeshingTrustRemotePeer::FROM_OWN_NODE_ID);
			$value = $criteria->remove(MeshingTrustRemotePeer::FROM_OWN_NODE_ID);
			if ($value) {
				$selectCriteria->add(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
			}

			$comparison = $criteria->getComparison(MeshingTrustRemotePeer::IN_OWN_NODE_ID);
			$value = $criteria->remove(MeshingTrustRemotePeer::IN_OWN_NODE_ID);
			if ($value) {
				$selectCriteria->add(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
			}

			$comparison = $criteria->getComparison(MeshingTrustRemotePeer::KNOWN_NODE_ID);
			$value = $criteria->remove(MeshingTrustRemotePeer::KNOWN_NODE_ID);
			if ($value) {
				$selectCriteria->add(MeshingTrustRemotePeer::KNOWN_NODE_ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(MeshingTrustRemotePeer::TABLE_NAME);
			}

		} else { // $values is MeshingTrustRemote object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the meshing_trust_remote table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(MeshingTrustRemotePeer::TABLE_NAME, $con, MeshingTrustRemotePeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			MeshingTrustRemotePeer::clearInstancePool();
			MeshingTrustRemotePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a MeshingTrustRemote or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or MeshingTrustRemote object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			MeshingTrustRemotePeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof MeshingTrustRemote) { // it's a model object
			// invalidate the cache for this single object
			MeshingTrustRemotePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}
			foreach ($values as $value) {
				$criterion = $criteria->getNewCriterion(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(MeshingTrustRemotePeer::KNOWN_NODE_ID, $value[2]));
				$criteria->addOr($criterion);
				// we can invalidate the cache for this single PK
				MeshingTrustRemotePeer::removeInstanceFromPool($value);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			MeshingTrustRemotePeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given MeshingTrustRemote object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      MeshingTrustRemote $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MeshingTrustRemotePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MeshingTrustRemotePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(MeshingTrustRemotePeer::DATABASE_NAME, MeshingTrustRemotePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $from_own_node_id
	 * @param      int $in_own_node_id
	 * @param      int $known_node_id
	 * @param      PropelPDO $con
	 * @return     MeshingTrustRemote
	 */
	public static function retrieveByPK($from_own_node_id, $in_own_node_id, $known_node_id, PropelPDO $con = null) {
		$_instancePoolKey = serialize(array((string) $from_own_node_id, (string) $in_own_node_id, (string) $known_node_id));
 		if (null !== ($obj = MeshingTrustRemotePeer::getInstanceFromPool($_instancePoolKey))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(MeshingTrustRemotePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(MeshingTrustRemotePeer::DATABASE_NAME);
		$criteria->add(MeshingTrustRemotePeer::FROM_OWN_NODE_ID, $from_own_node_id);
		$criteria->add(MeshingTrustRemotePeer::IN_OWN_NODE_ID, $in_own_node_id);
		$criteria->add(MeshingTrustRemotePeer::KNOWN_NODE_ID, $known_node_id);
		$v = MeshingTrustRemotePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseMeshingTrustRemotePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseMeshingTrustRemotePeer::buildTableMap();

