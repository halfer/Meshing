<?php

namespace P2PT/System\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use P2PT/System\Connection;
use P2PT/System\ConnectionQuery;
use P2PT/System\OwnNodePeer;
use P2PT/System\OwnNodeQuery;
use P2PT/System\Schema;
use P2PT/System\SchemaQuery;

/**
 * Base class that represents a row from the 'own_node' table.
 *
 * 
 *
 * @package    propel.generator.system.om
 */
abstract class BaseOwnNode extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'P2PT/System\\OwnNodePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        OwnNodePeer
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
	 * The value for the short_name field.
	 * @var        string
	 */
	protected $short_name;

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
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        Connection
	 */
	protected $aConnection;

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
	 * Initializes internal state of BaseOwnNode object.
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
	 * Get the [short_name] column value.
	 * 
	 * @return     string
	 */
	public function getShortName()
	{
		return $this->short_name;
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
	 * @return     OwnNode The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OwnNodePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [schema_id] column.
	 * 
	 * @param      int $v new value
	 * @return     OwnNode The current object (for fluent API support)
	 */
	public function setSchemaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->schema_id !== $v) {
			$this->schema_id = $v;
			$this->modifiedColumns[] = OwnNodePeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

		return $this;
	} // setSchemaId()

	/**
	 * Set the value of [short_name] column.
	 * 
	 * @param      string $v new value
	 * @return     OwnNode The current object (for fluent API support)
	 */
	public function setShortName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->short_name !== $v) {
			$this->short_name = $v;
			$this->modifiedColumns[] = OwnNodePeer::SHORT_NAME;
		}

		return $this;
	} // setShortName()

	/**
	 * Set the value of [connection_id] column.
	 * 
	 * @param      int $v new value
	 * @return     OwnNode The current object (for fluent API support)
	 */
	public function setConnectionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->connection_id !== $v) {
			$this->connection_id = $v;
			$this->modifiedColumns[] = OwnNodePeer::CONNECTION_ID;
		}

		if ($this->aConnection !== null && $this->aConnection->getId() !== $v) {
			$this->aConnection = null;
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
	 * @return     OwnNode The current object (for fluent API support)
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
			$this->modifiedColumns[] = OwnNodePeer::IS_ENABLED;
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
			$this->short_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->connection_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->is_enabled = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = OwnNodePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating OwnNode object", $e);
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

		if ($this->aSchema !== null && $this->schema_id !== $this->aSchema->getId()) {
			$this->aSchema = null;
		}
		if ($this->aConnection !== null && $this->connection_id !== $this->aConnection->getId()) {
			$this->aConnection = null;
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
			$con = Propel::getConnection(OwnNodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = OwnNodePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSchema = null;
			$this->aConnection = null;
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
			$con = Propel::getConnection(OwnNodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				OwnNodeQuery::create()
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
			$con = Propel::getConnection(OwnNodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				OwnNodePeer::addInstanceToPool($this);
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

			if ($this->aSchema !== null) {
				if ($this->aSchema->isModified() || $this->aSchema->isNew()) {
					$affectedRows += $this->aSchema->save($con);
				}
				$this->setSchema($this->aSchema);
			}

			if ($this->aConnection !== null) {
				if ($this->aConnection->isModified() || $this->aConnection->isNew()) {
					$affectedRows += $this->aConnection->save($con);
				}
				$this->setConnection($this->aConnection);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = OwnNodePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(OwnNodePeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.OwnNodePeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += OwnNodePeer::doUpdate($this, $con);
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

			if ($this->aSchema !== null) {
				if (!$this->aSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchema->getValidationFailures());
				}
			}

			if ($this->aConnection !== null) {
				if (!$this->aConnection->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConnection->getValidationFailures());
				}
			}


			if (($retval = OwnNodePeer::doValidate($this, $columns)) !== true) {
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
		$pos = OwnNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getShortName();
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
		if (isset($alreadyDumpedObjects['OwnNode'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['OwnNode'][$this->getPrimaryKey()] = true;
		$keys = OwnNodePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSchemaId(),
			$keys[2] => $this->getShortName(),
			$keys[3] => $this->getConnectionId(),
			$keys[4] => $this->getIsEnabled(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aSchema) {
				$result['Schema'] = $this->aSchema->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aConnection) {
				$result['Connection'] = $this->aConnection->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = OwnNodePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setShortName($value);
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
		$keys = OwnNodePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSchemaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortName($arr[$keys[2]]);
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
		$criteria = new Criteria(OwnNodePeer::DATABASE_NAME);

		if ($this->isColumnModified(OwnNodePeer::ID)) $criteria->add(OwnNodePeer::ID, $this->id);
		if ($this->isColumnModified(OwnNodePeer::SCHEMA_ID)) $criteria->add(OwnNodePeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(OwnNodePeer::SHORT_NAME)) $criteria->add(OwnNodePeer::SHORT_NAME, $this->short_name);
		if ($this->isColumnModified(OwnNodePeer::CONNECTION_ID)) $criteria->add(OwnNodePeer::CONNECTION_ID, $this->connection_id);
		if ($this->isColumnModified(OwnNodePeer::IS_ENABLED)) $criteria->add(OwnNodePeer::IS_ENABLED, $this->is_enabled);

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
		$criteria = new Criteria(OwnNodePeer::DATABASE_NAME);
		$criteria->add(OwnNodePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of OwnNode (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setSchemaId($this->getSchemaId());
		$copyObj->setShortName($this->getShortName());
		$copyObj->setConnectionId($this->getConnectionId());
		$copyObj->setIsEnabled($this->getIsEnabled());
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
	 * @return     OwnNode Clone of current object.
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
	 * @return     OwnNodePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OwnNodePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Schema object.
	 *
	 * @param      Schema $v
	 * @return     OwnNode The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSchema(Schema $v = null)
	{
		if ($v === null) {
			$this->setSchemaId(NULL);
		} else {
			$this->setSchemaId($v->getId());
		}

		$this->aSchema = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Schema object, it will not be re-added.
		if ($v !== null) {
			$v->addOwnNode($this);
		}

		return $this;
	}


	/**
	 * Get the associated Schema object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Schema The associated Schema object.
	 * @throws     PropelException
	 */
	public function getSchema(PropelPDO $con = null)
	{
		if ($this->aSchema === null && ($this->schema_id !== null)) {
			$this->aSchema = SchemaQuery::create()->findPk($this->schema_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aSchema->addOwnNodes($this);
			 */
		}
		return $this->aSchema;
	}

	/**
	 * Declares an association between this object and a Connection object.
	 *
	 * @param      Connection $v
	 * @return     OwnNode The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setConnection(Connection $v = null)
	{
		if ($v === null) {
			$this->setConnectionId(NULL);
		} else {
			$this->setConnectionId($v->getId());
		}

		$this->aConnection = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Connection object, it will not be re-added.
		if ($v !== null) {
			$v->addOwnNode($this);
		}

		return $this;
	}


	/**
	 * Get the associated Connection object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Connection The associated Connection object.
	 * @throws     PropelException
	 */
	public function getConnection(PropelPDO $con = null)
	{
		if ($this->aConnection === null && ($this->connection_id !== null)) {
			$this->aConnection = ConnectionQuery::create()->findPk($this->connection_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aConnection->addOwnNodes($this);
			 */
		}
		return $this->aConnection;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->schema_id = null;
		$this->short_name = null;
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
		} // if ($deep)

		$this->aSchema = null;
		$this->aConnection = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(OwnNodePeer::DEFAULT_STRING_FORMAT);
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

} // BaseOwnNode
