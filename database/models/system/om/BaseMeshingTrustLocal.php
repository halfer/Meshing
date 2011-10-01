<?php


/**
 * Base class that represents a row from the 'meshing_trust_local' table.
 *
 * 
 *
 * @package    propel.generator.system.om
 */
abstract class BaseMeshingTrustLocal extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'MeshingTrustLocalPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MeshingTrustLocalPeer
	 */
	protected static $peer;

	/**
	 * The value for the from_own_node_id field.
	 * @var        int
	 */
	protected $from_own_node_id;

	/**
	 * The value for the to_own_node_id field.
	 * @var        int
	 */
	protected $to_own_node_id;

	/**
	 * The value for the direction field.
	 * @var        string
	 */
	protected $direction;

	/**
	 * The value for the type field.
	 * @var        int
	 */
	protected $type;

	/**
	 * @var        P2POwnNode
	 */
	protected $aFromOwnNode;

	/**
	 * @var        P2POwnNode
	 */
	protected $aToOwnNode;

	/**
	 * @var        MeshingTrustType
	 */
	protected $aMeshingTrustType;

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
	 * Get the [from_own_node_id] column value.
	 * 
	 * @return     int
	 */
	public function getFromOwnNodeId()
	{
		return $this->from_own_node_id;
	}

	/**
	 * Get the [to_own_node_id] column value.
	 * 
	 * @return     int
	 */
	public function getToOwnNodeId()
	{
		return $this->to_own_node_id;
	}

	/**
	 * Get the [direction] column value.
	 * 
	 * @return     string
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set the value of [from_own_node_id] column.
	 * 
	 * @param      int $v new value
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 */
	public function setFromOwnNodeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->from_own_node_id !== $v) {
			$this->from_own_node_id = $v;
			$this->modifiedColumns[] = MeshingTrustLocalPeer::FROM_OWN_NODE_ID;
		}

		if ($this->aFromOwnNode !== null && $this->aFromOwnNode->getId() !== $v) {
			$this->aFromOwnNode = null;
		}

		return $this;
	} // setFromOwnNodeId()

	/**
	 * Set the value of [to_own_node_id] column.
	 * 
	 * @param      int $v new value
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 */
	public function setToOwnNodeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->to_own_node_id !== $v) {
			$this->to_own_node_id = $v;
			$this->modifiedColumns[] = MeshingTrustLocalPeer::TO_OWN_NODE_ID;
		}

		if ($this->aToOwnNode !== null && $this->aToOwnNode->getId() !== $v) {
			$this->aToOwnNode = null;
		}

		return $this;
	} // setToOwnNodeId()

	/**
	 * Set the value of [direction] column.
	 * 
	 * @param      string $v new value
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 */
	public function setDirection($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->direction !== $v) {
			$this->direction = $v;
			$this->modifiedColumns[] = MeshingTrustLocalPeer::DIRECTION;
		}

		return $this;
	} // setDirection()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      int $v new value
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = MeshingTrustLocalPeer::TYPE;
		}

		if ($this->aMeshingTrustType !== null && $this->aMeshingTrustType->getId() !== $v) {
			$this->aMeshingTrustType = null;
		}

		return $this;
	} // setType()

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

			$this->from_own_node_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->to_own_node_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->direction = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->type = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = MeshingTrustLocalPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating MeshingTrustLocal object", $e);
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

		if ($this->aFromOwnNode !== null && $this->from_own_node_id !== $this->aFromOwnNode->getId()) {
			$this->aFromOwnNode = null;
		}
		if ($this->aToOwnNode !== null && $this->to_own_node_id !== $this->aToOwnNode->getId()) {
			$this->aToOwnNode = null;
		}
		if ($this->aMeshingTrustType !== null && $this->type !== $this->aMeshingTrustType->getId()) {
			$this->aMeshingTrustType = null;
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
			$con = Propel::getConnection(MeshingTrustLocalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MeshingTrustLocalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aFromOwnNode = null;
			$this->aToOwnNode = null;
			$this->aMeshingTrustType = null;
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
			$con = Propel::getConnection(MeshingTrustLocalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				MeshingTrustLocalQuery::create()
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
			$con = Propel::getConnection(MeshingTrustLocalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				MeshingTrustLocalPeer::addInstanceToPool($this);
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

			if ($this->aFromOwnNode !== null) {
				if ($this->aFromOwnNode->isModified() || $this->aFromOwnNode->isNew()) {
					$affectedRows += $this->aFromOwnNode->save($con);
				}
				$this->setFromOwnNode($this->aFromOwnNode);
			}

			if ($this->aToOwnNode !== null) {
				if ($this->aToOwnNode->isModified() || $this->aToOwnNode->isNew()) {
					$affectedRows += $this->aToOwnNode->save($con);
				}
				$this->setToOwnNode($this->aToOwnNode);
			}

			if ($this->aMeshingTrustType !== null) {
				if ($this->aMeshingTrustType->isModified() || $this->aMeshingTrustType->isNew()) {
					$affectedRows += $this->aMeshingTrustType->save($con);
				}
				$this->setMeshingTrustType($this->aMeshingTrustType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += MeshingTrustLocalPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aFromOwnNode !== null) {
				if (!$this->aFromOwnNode->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFromOwnNode->getValidationFailures());
				}
			}

			if ($this->aToOwnNode !== null) {
				if (!$this->aToOwnNode->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aToOwnNode->getValidationFailures());
				}
			}

			if ($this->aMeshingTrustType !== null) {
				if (!$this->aMeshingTrustType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMeshingTrustType->getValidationFailures());
				}
			}


			if (($retval = MeshingTrustLocalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = MeshingTrustLocalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFromOwnNodeId();
				break;
			case 1:
				return $this->getToOwnNodeId();
				break;
			case 2:
				return $this->getDirection();
				break;
			case 3:
				return $this->getType();
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
		if (isset($alreadyDumpedObjects['MeshingTrustLocal'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['MeshingTrustLocal'][serialize($this->getPrimaryKey())] = true;
		$keys = MeshingTrustLocalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFromOwnNodeId(),
			$keys[1] => $this->getToOwnNodeId(),
			$keys[2] => $this->getDirection(),
			$keys[3] => $this->getType(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aFromOwnNode) {
				$result['FromOwnNode'] = $this->aFromOwnNode->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aToOwnNode) {
				$result['ToOwnNode'] = $this->aToOwnNode->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aMeshingTrustType) {
				$result['MeshingTrustType'] = $this->aMeshingTrustType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = MeshingTrustLocalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFromOwnNodeId($value);
				break;
			case 1:
				$this->setToOwnNodeId($value);
				break;
			case 2:
				$this->setDirection($value);
				break;
			case 3:
				$this->setType($value);
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
		$keys = MeshingTrustLocalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFromOwnNodeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setToOwnNodeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDirection($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setType($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MeshingTrustLocalPeer::DATABASE_NAME);

		if ($this->isColumnModified(MeshingTrustLocalPeer::FROM_OWN_NODE_ID)) $criteria->add(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $this->from_own_node_id);
		if ($this->isColumnModified(MeshingTrustLocalPeer::TO_OWN_NODE_ID)) $criteria->add(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $this->to_own_node_id);
		if ($this->isColumnModified(MeshingTrustLocalPeer::DIRECTION)) $criteria->add(MeshingTrustLocalPeer::DIRECTION, $this->direction);
		if ($this->isColumnModified(MeshingTrustLocalPeer::TYPE)) $criteria->add(MeshingTrustLocalPeer::TYPE, $this->type);

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
		$criteria = new Criteria(MeshingTrustLocalPeer::DATABASE_NAME);
		$criteria->add(MeshingTrustLocalPeer::FROM_OWN_NODE_ID, $this->from_own_node_id);
		$criteria->add(MeshingTrustLocalPeer::TO_OWN_NODE_ID, $this->to_own_node_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();
		$pks[0] = $this->getFromOwnNodeId();
		$pks[1] = $this->getToOwnNodeId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{
		$this->setFromOwnNodeId($keys[0]);
		$this->setToOwnNodeId($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getFromOwnNodeId()) && (null === $this->getToOwnNodeId());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of MeshingTrustLocal (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setFromOwnNodeId($this->getFromOwnNodeId());
		$copyObj->setToOwnNodeId($this->getToOwnNodeId());
		$copyObj->setDirection($this->getDirection());
		$copyObj->setType($this->getType());
		if ($makeNew) {
			$copyObj->setNew(true);
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
	 * @return     MeshingTrustLocal Clone of current object.
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
	 * @return     MeshingTrustLocalPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MeshingTrustLocalPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a P2POwnNode object.
	 *
	 * @param      P2POwnNode $v
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFromOwnNode(P2POwnNode $v = null)
	{
		if ($v === null) {
			$this->setFromOwnNodeId(NULL);
		} else {
			$this->setFromOwnNodeId($v->getId());
		}

		$this->aFromOwnNode = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the P2POwnNode object, it will not be re-added.
		if ($v !== null) {
			$v->addMeshingTrustLocalRelatedByFromOwnNodeId($this);
		}

		return $this;
	}


	/**
	 * Get the associated P2POwnNode object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     P2POwnNode The associated P2POwnNode object.
	 * @throws     PropelException
	 */
	public function getFromOwnNode(PropelPDO $con = null)
	{
		if ($this->aFromOwnNode === null && ($this->from_own_node_id !== null)) {
			$this->aFromOwnNode = P2POwnNodeQuery::create()->findPk($this->from_own_node_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aFromOwnNode->addMeshingTrustLocalsRelatedByFromOwnNodeId($this);
			 */
		}
		return $this->aFromOwnNode;
	}

	/**
	 * Declares an association between this object and a P2POwnNode object.
	 *
	 * @param      P2POwnNode $v
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setToOwnNode(P2POwnNode $v = null)
	{
		if ($v === null) {
			$this->setToOwnNodeId(NULL);
		} else {
			$this->setToOwnNodeId($v->getId());
		}

		$this->aToOwnNode = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the P2POwnNode object, it will not be re-added.
		if ($v !== null) {
			$v->addMeshingTrustLocalRelatedByToOwnNodeId($this);
		}

		return $this;
	}


	/**
	 * Get the associated P2POwnNode object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     P2POwnNode The associated P2POwnNode object.
	 * @throws     PropelException
	 */
	public function getToOwnNode(PropelPDO $con = null)
	{
		if ($this->aToOwnNode === null && ($this->to_own_node_id !== null)) {
			$this->aToOwnNode = P2POwnNodeQuery::create()->findPk($this->to_own_node_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aToOwnNode->addMeshingTrustLocalsRelatedByToOwnNodeId($this);
			 */
		}
		return $this->aToOwnNode;
	}

	/**
	 * Declares an association between this object and a MeshingTrustType object.
	 *
	 * @param      MeshingTrustType $v
	 * @return     MeshingTrustLocal The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMeshingTrustType(MeshingTrustType $v = null)
	{
		if ($v === null) {
			$this->setType(NULL);
		} else {
			$this->setType($v->getId());
		}

		$this->aMeshingTrustType = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the MeshingTrustType object, it will not be re-added.
		if ($v !== null) {
			$v->addMeshingTrustLocal($this);
		}

		return $this;
	}


	/**
	 * Get the associated MeshingTrustType object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     MeshingTrustType The associated MeshingTrustType object.
	 * @throws     PropelException
	 */
	public function getMeshingTrustType(PropelPDO $con = null)
	{
		if ($this->aMeshingTrustType === null && ($this->type !== null)) {
			$this->aMeshingTrustType = MeshingTrustTypeQuery::create()->findPk($this->type, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMeshingTrustType->addMeshingTrustLocals($this);
			 */
		}
		return $this->aMeshingTrustType;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->from_own_node_id = null;
		$this->to_own_node_id = null;
		$this->direction = null;
		$this->type = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
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
		} // if ($deep)

		$this->aFromOwnNode = null;
		$this->aToOwnNode = null;
		$this->aMeshingTrustType = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(MeshingTrustLocalPeer::DEFAULT_STRING_FORMAT);
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

} // BaseMeshingTrustLocal
