<?php


/**
 * Base class that represents a row from the 'p2p_own_node' table.
 *
 * 
 *
 * @package    propel.generator.system.om
 */
abstract class BaseP2POwnNode extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'P2POwnNodePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        P2POwnNodePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the schema_id field.
	 * @var        int
	 */
	protected $schema_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the connection_id field.
	 * @var        int
	 */
	protected $connection_id;

	/**
	 * The value for the is_enabled field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_enabled;

	/**
	 * @var        MeshingSchema
	 */
	protected $aMeshingSchema;

	/**
	 * @var        P2PConnection
	 */
	protected $aP2PConnection;

	/**
	 * @var        array MeshingTrustLocal[] Collection to store aggregation of MeshingTrustLocal objects.
	 */
	protected $collMeshingTrustLocalsRelatedByFromOwnNodeId;

	/**
	 * @var        array MeshingTrustLocal[] Collection to store aggregation of MeshingTrustLocal objects.
	 */
	protected $collMeshingTrustLocalsRelatedByToOwnNodeId;

	/**
	 * @var        array MeshingTrustRemote[] Collection to store aggregation of MeshingTrustRemote objects.
	 */
	protected $collMeshingTrustRemotesRelatedByFromOwnNodeId;

	/**
	 * @var        array MeshingTrustRemote[] Collection to store aggregation of MeshingTrustRemote objects.
	 */
	protected $collMeshingTrustRemotesRelatedByInOwnNodeId;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_enabled = false;
	}

	/**
	 * Initializes internal state of BaseP2POwnNode object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [schema_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaId()
	{
		return $this->schema_id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [connection_id] column value.
	 * 
	 * @return     int
	 */
	public function getConnectionId()
	{
		return $this->connection_id;
	}

	/**
	 * Get the [is_enabled] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsEnabled()
	{
		return $this->is_enabled;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     P2POwnNode The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = P2POwnNodePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [schema_id] column.
	 * 
	 * @param      int $v new value
	 * @return     P2POwnNode The current object (for fluent API support)
	 */
	public function setSchemaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->schema_id !== $v) {
			$this->schema_id = $v;
			$this->modifiedColumns[] = P2POwnNodePeer::SCHEMA_ID;
		}

		if ($this->aMeshingSchema !== null && $this->aMeshingSchema->getId() !== $v) {
			$this->aMeshingSchema = null;
		}

		return $this;
	} // setSchemaId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     P2POwnNode The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = P2POwnNodePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [connection_id] column.
	 * 
	 * @param      int $v new value
	 * @return     P2POwnNode The current object (for fluent API support)
	 */
	public function setConnectionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->connection_id !== $v) {
			$this->connection_id = $v;
			$this->modifiedColumns[] = P2POwnNodePeer::CONNECTION_ID;
		}

		if ($this->aP2PConnection !== null && $this->aP2PConnection->getId() !== $v) {
			$this->aP2PConnection = null;
		}

		return $this;
	} // setConnectionId()

	/**
	 * Sets the value of the [is_enabled] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     P2POwnNode The current object (for fluent API support)
	 */
	public function setIsEnabled($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_enabled !== $v || $this->isNew()) {
			$this->is_enabled = $v;
			$this->modifiedColumns[] = P2POwnNodePeer::IS_ENABLED;
		}

		return $this;
	} // setIsEnabled()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_enabled !== false) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->schema_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->connection_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->is_enabled = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = P2POwnNodePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating P2POwnNode object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aMeshingSchema !== null && $this->schema_id !== $this->aMeshingSchema->getId()) {
			$this->aMeshingSchema = null;
		}
		if ($this->aP2PConnection !== null && $this->connection_id !== $this->aP2PConnection->getId()) {
			$this->aP2PConnection = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(P2POwnNodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = P2POwnNodePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aMeshingSchema = null;
			$this->aP2PConnection = null;
			$this->collMeshingTrustLocalsRelatedByFromOwnNodeId = null;

			$this->collMeshingTrustLocalsRelatedByToOwnNodeId = null;

			$this->collMeshingTrustRemotesRelatedByFromOwnNodeId = null;

			$this->collMeshingTrustRemotesRelatedByInOwnNodeId = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(P2POwnNodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				P2POwnNodeQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(P2POwnNodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				P2POwnNodePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aMeshingSchema !== null) {
				if ($this->aMeshingSchema->isModified() || $this->aMeshingSchema->isNew()) {
					$affectedRows += $this->aMeshingSchema->save($con);
				}
				$this->setMeshingSchema($this->aMeshingSchema);
			}

			if ($this->aP2PConnection !== null) {
				if ($this->aP2PConnection->isModified() || $this->aP2PConnection->isNew()) {
					$affectedRows += $this->aP2PConnection->save($con);
				}
				$this->setP2PConnection($this->aP2PConnection);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = P2POwnNodePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(P2POwnNodePeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.P2POwnNodePeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += P2POwnNodePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId !== null) {
				foreach ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMeshingTrustLocalsRelatedByToOwnNodeId !== null) {
				foreach ($this->collMeshingTrustLocalsRelatedByToOwnNodeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId !== null) {
				foreach ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMeshingTrustRemotesRelatedByInOwnNodeId !== null) {
				foreach ($this->collMeshingTrustRemotesRelatedByInOwnNodeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aMeshingSchema !== null) {
				if (!$this->aMeshingSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMeshingSchema->getValidationFailures());
				}
			}

			if ($this->aP2PConnection !== null) {
				if (!$this->aP2PConnection->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aP2PConnection->getValidationFailures());
				}
			}


			if (($retval = P2POwnNodePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId !== null) {
					foreach ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMeshingTrustLocalsRelatedByToOwnNodeId !== null) {
					foreach ($this->collMeshingTrustLocalsRelatedByToOwnNodeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId !== null) {
					foreach ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMeshingTrustRemotesRelatedByInOwnNodeId !== null) {
					foreach ($this->collMeshingTrustRemotesRelatedByInOwnNodeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = P2POwnNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSchemaId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getConnectionId();
				break;
			case 4:
				return $this->getIsEnabled();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['P2POwnNode'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['P2POwnNode'][$this->getPrimaryKey()] = true;
		$keys = P2POwnNodePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSchemaId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getConnectionId(),
			$keys[4] => $this->getIsEnabled(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aMeshingSchema) {
				$result['MeshingSchema'] = $this->aMeshingSchema->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aP2PConnection) {
				$result['P2PConnection'] = $this->aP2PConnection->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collMeshingTrustLocalsRelatedByFromOwnNodeId) {
				$result['MeshingTrustLocalsRelatedByFromOwnNodeId'] = $this->collMeshingTrustLocalsRelatedByFromOwnNodeId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collMeshingTrustLocalsRelatedByToOwnNodeId) {
				$result['MeshingTrustLocalsRelatedByToOwnNodeId'] = $this->collMeshingTrustLocalsRelatedByToOwnNodeId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collMeshingTrustRemotesRelatedByFromOwnNodeId) {
				$result['MeshingTrustRemotesRelatedByFromOwnNodeId'] = $this->collMeshingTrustRemotesRelatedByFromOwnNodeId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collMeshingTrustRemotesRelatedByInOwnNodeId) {
				$result['MeshingTrustRemotesRelatedByInOwnNodeId'] = $this->collMeshingTrustRemotesRelatedByInOwnNodeId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = P2POwnNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSchemaId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setConnectionId($value);
				break;
			case 4:
				$this->setIsEnabled($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = P2POwnNodePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSchemaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConnectionId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsEnabled($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(P2POwnNodePeer::DATABASE_NAME);

		if ($this->isColumnModified(P2POwnNodePeer::ID)) $criteria->add(P2POwnNodePeer::ID, $this->id);
		if ($this->isColumnModified(P2POwnNodePeer::SCHEMA_ID)) $criteria->add(P2POwnNodePeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(P2POwnNodePeer::NAME)) $criteria->add(P2POwnNodePeer::NAME, $this->name);
		if ($this->isColumnModified(P2POwnNodePeer::CONNECTION_ID)) $criteria->add(P2POwnNodePeer::CONNECTION_ID, $this->connection_id);
		if ($this->isColumnModified(P2POwnNodePeer::IS_ENABLED)) $criteria->add(P2POwnNodePeer::IS_ENABLED, $this->is_enabled);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(P2POwnNodePeer::DATABASE_NAME);
		$criteria->add(P2POwnNodePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of P2POwnNode (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setSchemaId($this->getSchemaId());
		$copyObj->setName($this->getName());
		$copyObj->setConnectionId($this->getConnectionId());
		$copyObj->setIsEnabled($this->getIsEnabled());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getMeshingTrustLocalsRelatedByFromOwnNodeId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMeshingTrustLocalRelatedByFromOwnNodeId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMeshingTrustLocalsRelatedByToOwnNodeId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMeshingTrustLocalRelatedByToOwnNodeId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMeshingTrustRemotesRelatedByFromOwnNodeId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMeshingTrustRemoteRelatedByFromOwnNodeId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMeshingTrustRemotesRelatedByInOwnNodeId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMeshingTrustRemoteRelatedByInOwnNodeId($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     P2POwnNode Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     P2POwnNodePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new P2POwnNodePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a MeshingSchema object.
	 *
	 * @param      MeshingSchema $v
	 * @return     P2POwnNode The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMeshingSchema(MeshingSchema $v = null)
	{
		if ($v === null) {
			$this->setSchemaId(NULL);
		} else {
			$this->setSchemaId($v->getId());
		}

		$this->aMeshingSchema = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the MeshingSchema object, it will not be re-added.
		if ($v !== null) {
			$v->addP2POwnNode($this);
		}

		return $this;
	}


	/**
	 * Get the associated MeshingSchema object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     MeshingSchema The associated MeshingSchema object.
	 * @throws     PropelException
	 */
	public function getMeshingSchema(PropelPDO $con = null)
	{
		if ($this->aMeshingSchema === null && ($this->schema_id !== null)) {
			$this->aMeshingSchema = MeshingSchemaQuery::create()->findPk($this->schema_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMeshingSchema->addP2POwnNodes($this);
			 */
		}
		return $this->aMeshingSchema;
	}

	/**
	 * Declares an association between this object and a P2PConnection object.
	 *
	 * @param      P2PConnection $v
	 * @return     P2POwnNode The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setP2PConnection(P2PConnection $v = null)
	{
		if ($v === null) {
			$this->setConnectionId(NULL);
		} else {
			$this->setConnectionId($v->getId());
		}

		$this->aP2PConnection = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the P2PConnection object, it will not be re-added.
		if ($v !== null) {
			$v->addP2POwnNode($this);
		}

		return $this;
	}


	/**
	 * Get the associated P2PConnection object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     P2PConnection The associated P2PConnection object.
	 * @throws     PropelException
	 */
	public function getP2PConnection(PropelPDO $con = null)
	{
		if ($this->aP2PConnection === null && ($this->connection_id !== null)) {
			$this->aP2PConnection = P2PConnectionQuery::create()->findPk($this->connection_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aP2PConnection->addP2POwnNodes($this);
			 */
		}
		return $this->aP2PConnection;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name 
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('MeshingTrustLocalRelatedByFromOwnNodeId' == $relationName) {
			return $this->initMeshingTrustLocalsRelatedByFromOwnNodeId();
		}
		if ('MeshingTrustLocalRelatedByToOwnNodeId' == $relationName) {
			return $this->initMeshingTrustLocalsRelatedByToOwnNodeId();
		}
		if ('MeshingTrustRemoteRelatedByFromOwnNodeId' == $relationName) {
			return $this->initMeshingTrustRemotesRelatedByFromOwnNodeId();
		}
		if ('MeshingTrustRemoteRelatedByInOwnNodeId' == $relationName) {
			return $this->initMeshingTrustRemotesRelatedByInOwnNodeId();
		}
	}

	/**
	 * Clears out the collMeshingTrustLocalsRelatedByFromOwnNodeId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMeshingTrustLocalsRelatedByFromOwnNodeId()
	 */
	public function clearMeshingTrustLocalsRelatedByFromOwnNodeId()
	{
		$this->collMeshingTrustLocalsRelatedByFromOwnNodeId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMeshingTrustLocalsRelatedByFromOwnNodeId collection.
	 *
	 * By default this just sets the collMeshingTrustLocalsRelatedByFromOwnNodeId collection to an empty array (like clearcollMeshingTrustLocalsRelatedByFromOwnNodeId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMeshingTrustLocalsRelatedByFromOwnNodeId($overrideExisting = true)
	{
		if (null !== $this->collMeshingTrustLocalsRelatedByFromOwnNodeId && !$overrideExisting) {
			return;
		}
		$this->collMeshingTrustLocalsRelatedByFromOwnNodeId = new PropelObjectCollection();
		$this->collMeshingTrustLocalsRelatedByFromOwnNodeId->setModel('MeshingTrustLocal');
	}

	/**
	 * Gets an array of MeshingTrustLocal objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2POwnNode is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MeshingTrustLocal[] List of MeshingTrustLocal objects
	 * @throws     PropelException
	 */
	public function getMeshingTrustLocalsRelatedByFromOwnNodeId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustLocalsRelatedByFromOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustLocalsRelatedByFromOwnNodeId) {
				// return empty collection
				$this->initMeshingTrustLocalsRelatedByFromOwnNodeId();
			} else {
				$collMeshingTrustLocalsRelatedByFromOwnNodeId = MeshingTrustLocalQuery::create(null, $criteria)
					->filterByFromOwnNode($this)
					->find($con);
				if (null !== $criteria) {
					return $collMeshingTrustLocalsRelatedByFromOwnNodeId;
				}
				$this->collMeshingTrustLocalsRelatedByFromOwnNodeId = $collMeshingTrustLocalsRelatedByFromOwnNodeId;
			}
		}
		return $this->collMeshingTrustLocalsRelatedByFromOwnNodeId;
	}

	/**
	 * Returns the number of related MeshingTrustLocal objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MeshingTrustLocal objects.
	 * @throws     PropelException
	 */
	public function countMeshingTrustLocalsRelatedByFromOwnNodeId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustLocalsRelatedByFromOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustLocalsRelatedByFromOwnNodeId) {
				return 0;
			} else {
				$query = MeshingTrustLocalQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFromOwnNode($this)
					->count($con);
			}
		} else {
			return count($this->collMeshingTrustLocalsRelatedByFromOwnNodeId);
		}
	}

	/**
	 * Method called to associate a MeshingTrustLocal object to this object
	 * through the MeshingTrustLocal foreign key attribute.
	 *
	 * @param      MeshingTrustLocal $l MeshingTrustLocal
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMeshingTrustLocalRelatedByFromOwnNodeId(MeshingTrustLocal $l)
	{
		if ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId === null) {
			$this->initMeshingTrustLocalsRelatedByFromOwnNodeId();
		}
		if (!$this->collMeshingTrustLocalsRelatedByFromOwnNodeId->contains($l)) { // only add it if the **same** object is not already associated
			$this->collMeshingTrustLocalsRelatedByFromOwnNodeId[]= $l;
			$l->setFromOwnNode($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this P2POwnNode is new, it will return
	 * an empty collection; or if this P2POwnNode has previously
	 * been saved, it will retrieve related MeshingTrustLocalsRelatedByFromOwnNodeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in P2POwnNode.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array MeshingTrustLocal[] List of MeshingTrustLocal objects
	 */
	public function getMeshingTrustLocalsRelatedByFromOwnNodeIdJoinMeshingTrustType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MeshingTrustLocalQuery::create(null, $criteria);
		$query->joinWith('MeshingTrustType', $join_behavior);

		return $this->getMeshingTrustLocalsRelatedByFromOwnNodeId($query, $con);
	}

	/**
	 * Clears out the collMeshingTrustLocalsRelatedByToOwnNodeId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMeshingTrustLocalsRelatedByToOwnNodeId()
	 */
	public function clearMeshingTrustLocalsRelatedByToOwnNodeId()
	{
		$this->collMeshingTrustLocalsRelatedByToOwnNodeId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMeshingTrustLocalsRelatedByToOwnNodeId collection.
	 *
	 * By default this just sets the collMeshingTrustLocalsRelatedByToOwnNodeId collection to an empty array (like clearcollMeshingTrustLocalsRelatedByToOwnNodeId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMeshingTrustLocalsRelatedByToOwnNodeId($overrideExisting = true)
	{
		if (null !== $this->collMeshingTrustLocalsRelatedByToOwnNodeId && !$overrideExisting) {
			return;
		}
		$this->collMeshingTrustLocalsRelatedByToOwnNodeId = new PropelObjectCollection();
		$this->collMeshingTrustLocalsRelatedByToOwnNodeId->setModel('MeshingTrustLocal');
	}

	/**
	 * Gets an array of MeshingTrustLocal objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2POwnNode is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MeshingTrustLocal[] List of MeshingTrustLocal objects
	 * @throws     PropelException
	 */
	public function getMeshingTrustLocalsRelatedByToOwnNodeId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustLocalsRelatedByToOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustLocalsRelatedByToOwnNodeId) {
				// return empty collection
				$this->initMeshingTrustLocalsRelatedByToOwnNodeId();
			} else {
				$collMeshingTrustLocalsRelatedByToOwnNodeId = MeshingTrustLocalQuery::create(null, $criteria)
					->filterByToOwnNode($this)
					->find($con);
				if (null !== $criteria) {
					return $collMeshingTrustLocalsRelatedByToOwnNodeId;
				}
				$this->collMeshingTrustLocalsRelatedByToOwnNodeId = $collMeshingTrustLocalsRelatedByToOwnNodeId;
			}
		}
		return $this->collMeshingTrustLocalsRelatedByToOwnNodeId;
	}

	/**
	 * Returns the number of related MeshingTrustLocal objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MeshingTrustLocal objects.
	 * @throws     PropelException
	 */
	public function countMeshingTrustLocalsRelatedByToOwnNodeId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustLocalsRelatedByToOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustLocalsRelatedByToOwnNodeId) {
				return 0;
			} else {
				$query = MeshingTrustLocalQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByToOwnNode($this)
					->count($con);
			}
		} else {
			return count($this->collMeshingTrustLocalsRelatedByToOwnNodeId);
		}
	}

	/**
	 * Method called to associate a MeshingTrustLocal object to this object
	 * through the MeshingTrustLocal foreign key attribute.
	 *
	 * @param      MeshingTrustLocal $l MeshingTrustLocal
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMeshingTrustLocalRelatedByToOwnNodeId(MeshingTrustLocal $l)
	{
		if ($this->collMeshingTrustLocalsRelatedByToOwnNodeId === null) {
			$this->initMeshingTrustLocalsRelatedByToOwnNodeId();
		}
		if (!$this->collMeshingTrustLocalsRelatedByToOwnNodeId->contains($l)) { // only add it if the **same** object is not already associated
			$this->collMeshingTrustLocalsRelatedByToOwnNodeId[]= $l;
			$l->setToOwnNode($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this P2POwnNode is new, it will return
	 * an empty collection; or if this P2POwnNode has previously
	 * been saved, it will retrieve related MeshingTrustLocalsRelatedByToOwnNodeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in P2POwnNode.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array MeshingTrustLocal[] List of MeshingTrustLocal objects
	 */
	public function getMeshingTrustLocalsRelatedByToOwnNodeIdJoinMeshingTrustType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MeshingTrustLocalQuery::create(null, $criteria);
		$query->joinWith('MeshingTrustType', $join_behavior);

		return $this->getMeshingTrustLocalsRelatedByToOwnNodeId($query, $con);
	}

	/**
	 * Clears out the collMeshingTrustRemotesRelatedByFromOwnNodeId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMeshingTrustRemotesRelatedByFromOwnNodeId()
	 */
	public function clearMeshingTrustRemotesRelatedByFromOwnNodeId()
	{
		$this->collMeshingTrustRemotesRelatedByFromOwnNodeId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMeshingTrustRemotesRelatedByFromOwnNodeId collection.
	 *
	 * By default this just sets the collMeshingTrustRemotesRelatedByFromOwnNodeId collection to an empty array (like clearcollMeshingTrustRemotesRelatedByFromOwnNodeId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMeshingTrustRemotesRelatedByFromOwnNodeId($overrideExisting = true)
	{
		if (null !== $this->collMeshingTrustRemotesRelatedByFromOwnNodeId && !$overrideExisting) {
			return;
		}
		$this->collMeshingTrustRemotesRelatedByFromOwnNodeId = new PropelObjectCollection();
		$this->collMeshingTrustRemotesRelatedByFromOwnNodeId->setModel('MeshingTrustRemote');
	}

	/**
	 * Gets an array of MeshingTrustRemote objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2POwnNode is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MeshingTrustRemote[] List of MeshingTrustRemote objects
	 * @throws     PropelException
	 */
	public function getMeshingTrustRemotesRelatedByFromOwnNodeId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustRemotesRelatedByFromOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustRemotesRelatedByFromOwnNodeId) {
				// return empty collection
				$this->initMeshingTrustRemotesRelatedByFromOwnNodeId();
			} else {
				$collMeshingTrustRemotesRelatedByFromOwnNodeId = MeshingTrustRemoteQuery::create(null, $criteria)
					->filterByFromOwnNode($this)
					->find($con);
				if (null !== $criteria) {
					return $collMeshingTrustRemotesRelatedByFromOwnNodeId;
				}
				$this->collMeshingTrustRemotesRelatedByFromOwnNodeId = $collMeshingTrustRemotesRelatedByFromOwnNodeId;
			}
		}
		return $this->collMeshingTrustRemotesRelatedByFromOwnNodeId;
	}

	/**
	 * Returns the number of related MeshingTrustRemote objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MeshingTrustRemote objects.
	 * @throws     PropelException
	 */
	public function countMeshingTrustRemotesRelatedByFromOwnNodeId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustRemotesRelatedByFromOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustRemotesRelatedByFromOwnNodeId) {
				return 0;
			} else {
				$query = MeshingTrustRemoteQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFromOwnNode($this)
					->count($con);
			}
		} else {
			return count($this->collMeshingTrustRemotesRelatedByFromOwnNodeId);
		}
	}

	/**
	 * Method called to associate a MeshingTrustRemote object to this object
	 * through the MeshingTrustRemote foreign key attribute.
	 *
	 * @param      MeshingTrustRemote $l MeshingTrustRemote
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMeshingTrustRemoteRelatedByFromOwnNodeId(MeshingTrustRemote $l)
	{
		if ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId === null) {
			$this->initMeshingTrustRemotesRelatedByFromOwnNodeId();
		}
		if (!$this->collMeshingTrustRemotesRelatedByFromOwnNodeId->contains($l)) { // only add it if the **same** object is not already associated
			$this->collMeshingTrustRemotesRelatedByFromOwnNodeId[]= $l;
			$l->setFromOwnNode($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this P2POwnNode is new, it will return
	 * an empty collection; or if this P2POwnNode has previously
	 * been saved, it will retrieve related MeshingTrustRemotesRelatedByFromOwnNodeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in P2POwnNode.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array MeshingTrustRemote[] List of MeshingTrustRemote objects
	 */
	public function getMeshingTrustRemotesRelatedByFromOwnNodeIdJoinMeshingTrustType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MeshingTrustRemoteQuery::create(null, $criteria);
		$query->joinWith('MeshingTrustType', $join_behavior);

		return $this->getMeshingTrustRemotesRelatedByFromOwnNodeId($query, $con);
	}

	/**
	 * Clears out the collMeshingTrustRemotesRelatedByInOwnNodeId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMeshingTrustRemotesRelatedByInOwnNodeId()
	 */
	public function clearMeshingTrustRemotesRelatedByInOwnNodeId()
	{
		$this->collMeshingTrustRemotesRelatedByInOwnNodeId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMeshingTrustRemotesRelatedByInOwnNodeId collection.
	 *
	 * By default this just sets the collMeshingTrustRemotesRelatedByInOwnNodeId collection to an empty array (like clearcollMeshingTrustRemotesRelatedByInOwnNodeId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMeshingTrustRemotesRelatedByInOwnNodeId($overrideExisting = true)
	{
		if (null !== $this->collMeshingTrustRemotesRelatedByInOwnNodeId && !$overrideExisting) {
			return;
		}
		$this->collMeshingTrustRemotesRelatedByInOwnNodeId = new PropelObjectCollection();
		$this->collMeshingTrustRemotesRelatedByInOwnNodeId->setModel('MeshingTrustRemote');
	}

	/**
	 * Gets an array of MeshingTrustRemote objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2POwnNode is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MeshingTrustRemote[] List of MeshingTrustRemote objects
	 * @throws     PropelException
	 */
	public function getMeshingTrustRemotesRelatedByInOwnNodeId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustRemotesRelatedByInOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustRemotesRelatedByInOwnNodeId) {
				// return empty collection
				$this->initMeshingTrustRemotesRelatedByInOwnNodeId();
			} else {
				$collMeshingTrustRemotesRelatedByInOwnNodeId = MeshingTrustRemoteQuery::create(null, $criteria)
					->filterByP2POwnNodeRelatedByInOwnNodeId($this)
					->find($con);
				if (null !== $criteria) {
					return $collMeshingTrustRemotesRelatedByInOwnNodeId;
				}
				$this->collMeshingTrustRemotesRelatedByInOwnNodeId = $collMeshingTrustRemotesRelatedByInOwnNodeId;
			}
		}
		return $this->collMeshingTrustRemotesRelatedByInOwnNodeId;
	}

	/**
	 * Returns the number of related MeshingTrustRemote objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MeshingTrustRemote objects.
	 * @throws     PropelException
	 */
	public function countMeshingTrustRemotesRelatedByInOwnNodeId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMeshingTrustRemotesRelatedByInOwnNodeId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMeshingTrustRemotesRelatedByInOwnNodeId) {
				return 0;
			} else {
				$query = MeshingTrustRemoteQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByP2POwnNodeRelatedByInOwnNodeId($this)
					->count($con);
			}
		} else {
			return count($this->collMeshingTrustRemotesRelatedByInOwnNodeId);
		}
	}

	/**
	 * Method called to associate a MeshingTrustRemote object to this object
	 * through the MeshingTrustRemote foreign key attribute.
	 *
	 * @param      MeshingTrustRemote $l MeshingTrustRemote
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMeshingTrustRemoteRelatedByInOwnNodeId(MeshingTrustRemote $l)
	{
		if ($this->collMeshingTrustRemotesRelatedByInOwnNodeId === null) {
			$this->initMeshingTrustRemotesRelatedByInOwnNodeId();
		}
		if (!$this->collMeshingTrustRemotesRelatedByInOwnNodeId->contains($l)) { // only add it if the **same** object is not already associated
			$this->collMeshingTrustRemotesRelatedByInOwnNodeId[]= $l;
			$l->setP2POwnNodeRelatedByInOwnNodeId($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this P2POwnNode is new, it will return
	 * an empty collection; or if this P2POwnNode has previously
	 * been saved, it will retrieve related MeshingTrustRemotesRelatedByInOwnNodeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in P2POwnNode.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array MeshingTrustRemote[] List of MeshingTrustRemote objects
	 */
	public function getMeshingTrustRemotesRelatedByInOwnNodeIdJoinMeshingTrustType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MeshingTrustRemoteQuery::create(null, $criteria);
		$query->joinWith('MeshingTrustType', $join_behavior);

		return $this->getMeshingTrustRemotesRelatedByInOwnNodeId($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->schema_id = null;
		$this->name = null;
		$this->connection_id = null;
		$this->is_enabled = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId) {
				foreach ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMeshingTrustLocalsRelatedByToOwnNodeId) {
				foreach ($this->collMeshingTrustLocalsRelatedByToOwnNodeId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId) {
				foreach ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMeshingTrustRemotesRelatedByInOwnNodeId) {
				foreach ($this->collMeshingTrustRemotesRelatedByInOwnNodeId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collMeshingTrustLocalsRelatedByFromOwnNodeId instanceof PropelCollection) {
			$this->collMeshingTrustLocalsRelatedByFromOwnNodeId->clearIterator();
		}
		$this->collMeshingTrustLocalsRelatedByFromOwnNodeId = null;
		if ($this->collMeshingTrustLocalsRelatedByToOwnNodeId instanceof PropelCollection) {
			$this->collMeshingTrustLocalsRelatedByToOwnNodeId->clearIterator();
		}
		$this->collMeshingTrustLocalsRelatedByToOwnNodeId = null;
		if ($this->collMeshingTrustRemotesRelatedByFromOwnNodeId instanceof PropelCollection) {
			$this->collMeshingTrustRemotesRelatedByFromOwnNodeId->clearIterator();
		}
		$this->collMeshingTrustRemotesRelatedByFromOwnNodeId = null;
		if ($this->collMeshingTrustRemotesRelatedByInOwnNodeId instanceof PropelCollection) {
			$this->collMeshingTrustRemotesRelatedByInOwnNodeId->clearIterator();
		}
		$this->collMeshingTrustRemotesRelatedByInOwnNodeId = null;
		$this->aMeshingSchema = null;
		$this->aP2PConnection = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(P2POwnNodePeer::DEFAULT_STRING_FORMAT);
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseP2POwnNode
