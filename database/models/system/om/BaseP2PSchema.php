<?php


/**
 * Base class that represents a row from the 'p2p_schema' table.
 *
 * 
 *
 * @package    propel.generator.system.om
 */
abstract class BaseP2PSchema extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'P2PSchemaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        P2PSchemaPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the author field.
	 * @var        string
	 */
	protected $author;

	/**
	 * The value for the contact field.
	 * @var        string
	 */
	protected $contact;

	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;

	/**
	 * The value for the date_release field.
	 * @var        string
	 */
	protected $date_release;

	/**
	 * The value for the schema_version field.
	 * @var        double
	 */
	protected $schema_version;

	/**
	 * The value for the software_version field.
	 * @var        double
	 */
	protected $software_version;

	/**
	 * The value for the history field.
	 * @var        string
	 */
	protected $history;

	/**
	 * The value for the installed_at field.
	 * @var        string
	 */
	protected $installed_at;

	/**
	 * @var        array P2POwnNode[] Collection to store aggregation of P2POwnNode objects.
	 */
	protected $collP2POwnNodes;

	/**
	 * @var        array P2PSchemaTable[] Collection to store aggregation of P2PSchemaTable objects.
	 */
	protected $collP2PSchemaTables;

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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
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
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [author] column value.
	 * 
	 * @return     string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Get the [contact] column value.
	 * 
	 * @return     string
	 */
	public function getContact()
	{
		return $this->contact;
	}

	/**
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Get the [optionally formatted] temporal [date_release] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDateRelease($format = '%x')
	{
		if ($this->date_release === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->date_release);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_release, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [schema_version] column value.
	 * 
	 * @return     double
	 */
	public function getSchemaVersion()
	{
		return $this->schema_version;
	}

	/**
	 * Get the [software_version] column value.
	 * 
	 * @return     double
	 */
	public function getSoftwareVersion()
	{
		return $this->software_version;
	}

	/**
	 * Get the [history] column value.
	 * 
	 * @return     string
	 */
	public function getHistory()
	{
		return $this->history;
	}

	/**
	 * Get the [optionally formatted] temporal [installed_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getInstalledAt($format = 'Y-m-d H:i:s')
	{
		if ($this->installed_at === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->installed_at);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->installed_at, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [author] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setAuthor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author !== $v) {
			$this->author = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::AUTHOR;
		}

		return $this;
	} // setAuthor()

	/**
	 * Set the value of [contact] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setContact($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->contact !== $v) {
			$this->contact = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::CONTACT;
		}

		return $this;
	} // setContact()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::URL;
		}

		return $this;
	} // setUrl()

	/**
	 * Sets the value of [date_release] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setDateRelease($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->date_release !== null || $dt !== null) {
			$currentDateAsString = ($this->date_release !== null && $tmpDt = new DateTime($this->date_release)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->date_release = $newDateAsString;
				$this->modifiedColumns[] = P2PSchemaPeer::DATE_RELEASE;
			}
		} // if either are not null

		return $this;
	} // setDateRelease()

	/**
	 * Set the value of [schema_version] column.
	 * 
	 * @param      double $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setSchemaVersion($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->schema_version !== $v) {
			$this->schema_version = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::SCHEMA_VERSION;
		}

		return $this;
	} // setSchemaVersion()

	/**
	 * Set the value of [software_version] column.
	 * 
	 * @param      double $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setSoftwareVersion($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->software_version !== $v) {
			$this->software_version = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::SOFTWARE_VERSION;
		}

		return $this;
	} // setSoftwareVersion()

	/**
	 * Set the value of [history] column.
	 * 
	 * @param      string $v new value
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setHistory($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->history !== $v) {
			$this->history = $v;
			$this->modifiedColumns[] = P2PSchemaPeer::HISTORY;
		}

		return $this;
	} // setHistory()

	/**
	 * Sets the value of [installed_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     P2PSchema The current object (for fluent API support)
	 */
	public function setInstalledAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->installed_at !== null || $dt !== null) {
			$currentDateAsString = ($this->installed_at !== null && $tmpDt = new DateTime($this->installed_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->installed_at = $newDateAsString;
				$this->modifiedColumns[] = P2PSchemaPeer::INSTALLED_AT;
			}
		} // if either are not null

		return $this;
	} // setInstalledAt()

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->author = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->contact = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->url = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->date_release = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->schema_version = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
			$this->software_version = ($row[$startcol + 8] !== null) ? (double) $row[$startcol + 8] : null;
			$this->history = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->installed_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = P2PSchemaPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating P2PSchema object", $e);
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
			$con = Propel::getConnection(P2PSchemaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = P2PSchemaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collP2POwnNodes = null;

			$this->collP2PSchemaTables = null;

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
			$con = Propel::getConnection(P2PSchemaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				P2PSchemaQuery::create()
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
			$con = Propel::getConnection(P2PSchemaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				P2PSchemaPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = P2PSchemaPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(P2PSchemaPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.P2PSchemaPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = P2PSchemaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collP2POwnNodes !== null) {
				foreach ($this->collP2POwnNodes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collP2PSchemaTables !== null) {
				foreach ($this->collP2PSchemaTables as $referrerFK) {
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


			if (($retval = P2PSchemaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collP2POwnNodes !== null) {
					foreach ($this->collP2POwnNodes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collP2PSchemaTables !== null) {
					foreach ($this->collP2PSchemaTables as $referrerFK) {
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
		$pos = P2PSchemaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getAuthor();
				break;
			case 4:
				return $this->getContact();
				break;
			case 5:
				return $this->getUrl();
				break;
			case 6:
				return $this->getDateRelease();
				break;
			case 7:
				return $this->getSchemaVersion();
				break;
			case 8:
				return $this->getSoftwareVersion();
				break;
			case 9:
				return $this->getHistory();
				break;
			case 10:
				return $this->getInstalledAt();
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
		if (isset($alreadyDumpedObjects['P2PSchema'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['P2PSchema'][$this->getPrimaryKey()] = true;
		$keys = P2PSchemaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getAuthor(),
			$keys[4] => $this->getContact(),
			$keys[5] => $this->getUrl(),
			$keys[6] => $this->getDateRelease(),
			$keys[7] => $this->getSchemaVersion(),
			$keys[8] => $this->getSoftwareVersion(),
			$keys[9] => $this->getHistory(),
			$keys[10] => $this->getInstalledAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collP2POwnNodes) {
				$result['P2POwnNodes'] = $this->collP2POwnNodes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collP2PSchemaTables) {
				$result['P2PSchemaTables'] = $this->collP2PSchemaTables->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = P2PSchemaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setAuthor($value);
				break;
			case 4:
				$this->setContact($value);
				break;
			case 5:
				$this->setUrl($value);
				break;
			case 6:
				$this->setDateRelease($value);
				break;
			case 7:
				$this->setSchemaVersion($value);
				break;
			case 8:
				$this->setSoftwareVersion($value);
				break;
			case 9:
				$this->setHistory($value);
				break;
			case 10:
				$this->setInstalledAt($value);
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
		$keys = P2PSchemaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAuthor($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setContact($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUrl($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDateRelease($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSchemaVersion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSoftwareVersion($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setHistory($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInstalledAt($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(P2PSchemaPeer::DATABASE_NAME);

		if ($this->isColumnModified(P2PSchemaPeer::ID)) $criteria->add(P2PSchemaPeer::ID, $this->id);
		if ($this->isColumnModified(P2PSchemaPeer::NAME)) $criteria->add(P2PSchemaPeer::NAME, $this->name);
		if ($this->isColumnModified(P2PSchemaPeer::DESCRIPTION)) $criteria->add(P2PSchemaPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(P2PSchemaPeer::AUTHOR)) $criteria->add(P2PSchemaPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(P2PSchemaPeer::CONTACT)) $criteria->add(P2PSchemaPeer::CONTACT, $this->contact);
		if ($this->isColumnModified(P2PSchemaPeer::URL)) $criteria->add(P2PSchemaPeer::URL, $this->url);
		if ($this->isColumnModified(P2PSchemaPeer::DATE_RELEASE)) $criteria->add(P2PSchemaPeer::DATE_RELEASE, $this->date_release);
		if ($this->isColumnModified(P2PSchemaPeer::SCHEMA_VERSION)) $criteria->add(P2PSchemaPeer::SCHEMA_VERSION, $this->schema_version);
		if ($this->isColumnModified(P2PSchemaPeer::SOFTWARE_VERSION)) $criteria->add(P2PSchemaPeer::SOFTWARE_VERSION, $this->software_version);
		if ($this->isColumnModified(P2PSchemaPeer::HISTORY)) $criteria->add(P2PSchemaPeer::HISTORY, $this->history);
		if ($this->isColumnModified(P2PSchemaPeer::INSTALLED_AT)) $criteria->add(P2PSchemaPeer::INSTALLED_AT, $this->installed_at);

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
		$criteria = new Criteria(P2PSchemaPeer::DATABASE_NAME);
		$criteria->add(P2PSchemaPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of P2PSchema (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setName($this->getName());
		$copyObj->setDescription($this->getDescription());
		$copyObj->setAuthor($this->getAuthor());
		$copyObj->setContact($this->getContact());
		$copyObj->setUrl($this->getUrl());
		$copyObj->setDateRelease($this->getDateRelease());
		$copyObj->setSchemaVersion($this->getSchemaVersion());
		$copyObj->setSoftwareVersion($this->getSoftwareVersion());
		$copyObj->setHistory($this->getHistory());
		$copyObj->setInstalledAt($this->getInstalledAt());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getP2POwnNodes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addP2POwnNode($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getP2PSchemaTables() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addP2PSchemaTable($relObj->copy($deepCopy));
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
	 * @return     P2PSchema Clone of current object.
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
	 * @return     P2PSchemaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new P2PSchemaPeer();
		}
		return self::$peer;
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
		if ('P2POwnNode' == $relationName) {
			return $this->initP2POwnNodes();
		}
		if ('P2PSchemaTable' == $relationName) {
			return $this->initP2PSchemaTables();
		}
	}

	/**
	 * Clears out the collP2POwnNodes collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addP2POwnNodes()
	 */
	public function clearP2POwnNodes()
	{
		$this->collP2POwnNodes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collP2POwnNodes collection.
	 *
	 * By default this just sets the collP2POwnNodes collection to an empty array (like clearcollP2POwnNodes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initP2POwnNodes($overrideExisting = true)
	{
		if (null !== $this->collP2POwnNodes && !$overrideExisting) {
			return;
		}
		$this->collP2POwnNodes = new PropelObjectCollection();
		$this->collP2POwnNodes->setModel('P2POwnNode');
	}

	/**
	 * Gets an array of P2POwnNode objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2PSchema is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array P2POwnNode[] List of P2POwnNode objects
	 * @throws     PropelException
	 */
	public function getP2POwnNodes($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collP2POwnNodes || null !== $criteria) {
			if ($this->isNew() && null === $this->collP2POwnNodes) {
				// return empty collection
				$this->initP2POwnNodes();
			} else {
				$collP2POwnNodes = P2POwnNodeQuery::create(null, $criteria)
					->filterByP2PSchema($this)
					->find($con);
				if (null !== $criteria) {
					return $collP2POwnNodes;
				}
				$this->collP2POwnNodes = $collP2POwnNodes;
			}
		}
		return $this->collP2POwnNodes;
	}

	/**
	 * Returns the number of related P2POwnNode objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related P2POwnNode objects.
	 * @throws     PropelException
	 */
	public function countP2POwnNodes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collP2POwnNodes || null !== $criteria) {
			if ($this->isNew() && null === $this->collP2POwnNodes) {
				return 0;
			} else {
				$query = P2POwnNodeQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByP2PSchema($this)
					->count($con);
			}
		} else {
			return count($this->collP2POwnNodes);
		}
	}

	/**
	 * Method called to associate a P2POwnNode object to this object
	 * through the P2POwnNode foreign key attribute.
	 *
	 * @param      P2POwnNode $l P2POwnNode
	 * @return     void
	 * @throws     PropelException
	 */
	public function addP2POwnNode(P2POwnNode $l)
	{
		if ($this->collP2POwnNodes === null) {
			$this->initP2POwnNodes();
		}
		if (!$this->collP2POwnNodes->contains($l)) { // only add it if the **same** object is not already associated
			$this->collP2POwnNodes[]= $l;
			$l->setP2PSchema($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this P2PSchema is new, it will return
	 * an empty collection; or if this P2PSchema has previously
	 * been saved, it will retrieve related P2POwnNodes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in P2PSchema.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array P2POwnNode[] List of P2POwnNode objects
	 */
	public function getP2POwnNodesJoinP2PConnection($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = P2POwnNodeQuery::create(null, $criteria);
		$query->joinWith('P2PConnection', $join_behavior);

		return $this->getP2POwnNodes($query, $con);
	}

	/**
	 * Clears out the collP2PSchemaTables collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addP2PSchemaTables()
	 */
	public function clearP2PSchemaTables()
	{
		$this->collP2PSchemaTables = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collP2PSchemaTables collection.
	 *
	 * By default this just sets the collP2PSchemaTables collection to an empty array (like clearcollP2PSchemaTables());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initP2PSchemaTables($overrideExisting = true)
	{
		if (null !== $this->collP2PSchemaTables && !$overrideExisting) {
			return;
		}
		$this->collP2PSchemaTables = new PropelObjectCollection();
		$this->collP2PSchemaTables->setModel('P2PSchemaTable');
	}

	/**
	 * Gets an array of P2PSchemaTable objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this P2PSchema is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array P2PSchemaTable[] List of P2PSchemaTable objects
	 * @throws     PropelException
	 */
	public function getP2PSchemaTables($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collP2PSchemaTables || null !== $criteria) {
			if ($this->isNew() && null === $this->collP2PSchemaTables) {
				// return empty collection
				$this->initP2PSchemaTables();
			} else {
				$collP2PSchemaTables = P2PSchemaTableQuery::create(null, $criteria)
					->filterByP2PSchema($this)
					->find($con);
				if (null !== $criteria) {
					return $collP2PSchemaTables;
				}
				$this->collP2PSchemaTables = $collP2PSchemaTables;
			}
		}
		return $this->collP2PSchemaTables;
	}

	/**
	 * Returns the number of related P2PSchemaTable objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related P2PSchemaTable objects.
	 * @throws     PropelException
	 */
	public function countP2PSchemaTables(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collP2PSchemaTables || null !== $criteria) {
			if ($this->isNew() && null === $this->collP2PSchemaTables) {
				return 0;
			} else {
				$query = P2PSchemaTableQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByP2PSchema($this)
					->count($con);
			}
		} else {
			return count($this->collP2PSchemaTables);
		}
	}

	/**
	 * Method called to associate a P2PSchemaTable object to this object
	 * through the P2PSchemaTable foreign key attribute.
	 *
	 * @param      P2PSchemaTable $l P2PSchemaTable
	 * @return     void
	 * @throws     PropelException
	 */
	public function addP2PSchemaTable(P2PSchemaTable $l)
	{
		if ($this->collP2PSchemaTables === null) {
			$this->initP2PSchemaTables();
		}
		if (!$this->collP2PSchemaTables->contains($l)) { // only add it if the **same** object is not already associated
			$this->collP2PSchemaTables[]= $l;
			$l->setP2PSchema($this);
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->description = null;
		$this->author = null;
		$this->contact = null;
		$this->url = null;
		$this->date_release = null;
		$this->schema_version = null;
		$this->software_version = null;
		$this->history = null;
		$this->installed_at = null;
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
			if ($this->collP2POwnNodes) {
				foreach ($this->collP2POwnNodes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collP2PSchemaTables) {
				foreach ($this->collP2PSchemaTables as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collP2POwnNodes instanceof PropelCollection) {
			$this->collP2POwnNodes->clearIterator();
		}
		$this->collP2POwnNodes = null;
		if ($this->collP2PSchemaTables instanceof PropelCollection) {
			$this->collP2PSchemaTables->clearIterator();
		}
		$this->collP2PSchemaTables = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(P2PSchemaPeer::DEFAULT_STRING_FORMAT);
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

} // BaseP2PSchema
