<?php

namespace models\models\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use models\models\CrmAccount as ChildCrmAccount;
use models\models\CrmAccountQuery as ChildCrmAccountQuery;
use models\models\CrmAddress as ChildCrmAddress;
use models\models\CrmAddressQuery as ChildCrmAddressQuery;
use models\models\CrmEmail as ChildCrmEmail;
use models\models\CrmEmailQuery as ChildCrmEmailQuery;
use models\models\CrmPerson as ChildCrmPerson;
use models\models\CrmPersonQuery as ChildCrmPersonQuery;
use models\models\FinCreditCard as ChildFinCreditCard;
use models\models\FinCreditCardQuery as ChildFinCreditCardQuery;
use models\models\SecRetailerLogin as ChildSecRetailerLogin;
use models\models\SecRetailerLoginQuery as ChildSecRetailerLoginQuery;
use models\models\Map\CrmAccountTableMap;
use models\models\Map\CrmAddressTableMap;
use models\models\Map\CrmEmailTableMap;
use models\models\Map\CrmPersonTableMap;
use models\models\Map\FinCreditCardTableMap;
use models\models\Map\SecRetailerLoginTableMap;

/**
 * Base class that represents a row from the 'crm_account' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class CrmAccount implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\CrmAccountTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the crm_account_id field.
     *
     * @var        int
     */
    protected $crm_account_id;

    /**
     * The value for the add_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $add_time;

    /**
     * @var        ObjectCollection|ChildCrmAddress[] Collection to store aggregation of ChildCrmAddress objects.
     */
    protected $collCrmAddressesRelatedByCrmAccountId;
    protected $collCrmAddressesRelatedByCrmAccountIdPartial;

    /**
     * @var        ChildCrmAddress one-to-one related ChildCrmAddress object
     */
    protected $singleCrmAddressRelatedByCrmAddressId;

    /**
     * @var        ObjectCollection|ChildCrmEmail[] Collection to store aggregation of ChildCrmEmail objects.
     */
    protected $collCrmEmails;
    protected $collCrmEmailsPartial;

    /**
     * @var        ObjectCollection|ChildCrmPerson[] Collection to store aggregation of ChildCrmPerson objects.
     */
    protected $collCrmpeople;
    protected $collCrmpeoplePartial;

    /**
     * @var        ObjectCollection|ChildFinCreditCard[] Collection to store aggregation of ChildFinCreditCard objects.
     */
    protected $collFinCreditCards;
    protected $collFinCreditCardsPartial;

    /**
     * @var        ObjectCollection|ChildSecRetailerLogin[] Collection to store aggregation of ChildSecRetailerLogin objects.
     */
    protected $collSecRetailerLogins;
    protected $collSecRetailerLoginsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCrmAddress[]
     */
    protected $crmAddressesRelatedByCrmAccountIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCrmEmail[]
     */
    protected $crmEmailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCrmPerson[]
     */
    protected $crmpeopleScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFinCreditCard[]
     */
    protected $finCreditCardsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSecRetailerLogin[]
     */
    protected $secRetailerLoginsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of models\models\Base\CrmAccount object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>CrmAccount</code> instance.  If
     * <code>obj</code> is an instance of <code>CrmAccount</code>, delegates to
     * <code>equals(CrmAccount)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|CrmAccount The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [crm_account_id] column value.
     *
     * @return int
     */
    public function getCrmAccountId()
    {
        return $this->crm_account_id;
    }

    /**
     * Get the [optionally formatted] temporal [add_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getAddTime($format = NULL)
    {
        if ($format === null) {
            return $this->add_time;
        } else {
            return $this->add_time instanceof \DateTimeInterface ? $this->add_time->format($format) : null;
        }
    }

    /**
     * Set the value of [crm_account_id] column.
     *
     * @param int $v new value
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function setCrmAccountId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->crm_account_id !== $v) {
            $this->crm_account_id = $v;
            $this->modifiedColumns[CrmAccountTableMap::COL_CRM_ACCOUNT_ID] = true;
        }

        return $this;
    } // setCrmAccountId()

    /**
     * Sets the value of [add_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function setAddTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->add_time !== null || $dt !== null) {
            if ($this->add_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->add_time->format("Y-m-d H:i:s.u")) {
                $this->add_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CrmAccountTableMap::COL_ADD_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setAddTime()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CrmAccountTableMap::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->crm_account_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CrmAccountTableMap::translateFieldName('AddTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->add_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = CrmAccountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\CrmAccount'), 0, $e);
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
     * @throws PropelException
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
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCrmAccountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCrmAddressesRelatedByCrmAccountId = null;

            $this->singleCrmAddressRelatedByCrmAddressId = null;

            $this->collCrmEmails = null;

            $this->collCrmpeople = null;

            $this->collFinCreditCards = null;

            $this->collSecRetailerLogins = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CrmAccount::setDeleted()
     * @see CrmAccount::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCrmAccountQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                CrmAccountTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion !== null) {
                if (!$this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->isEmpty()) {
                    \models\models\CrmAddressQuery::create()
                        ->filterByPrimaryKeys($this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion = null;
                }
            }

            if ($this->collCrmAddressesRelatedByCrmAccountId !== null) {
                foreach ($this->collCrmAddressesRelatedByCrmAccountId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleCrmAddressRelatedByCrmAddressId !== null) {
                if (!$this->singleCrmAddressRelatedByCrmAddressId->isDeleted() && ($this->singleCrmAddressRelatedByCrmAddressId->isNew() || $this->singleCrmAddressRelatedByCrmAddressId->isModified())) {
                    $affectedRows += $this->singleCrmAddressRelatedByCrmAddressId->save($con);
                }
            }

            if ($this->crmEmailsScheduledForDeletion !== null) {
                if (!$this->crmEmailsScheduledForDeletion->isEmpty()) {
                    \models\models\CrmEmailQuery::create()
                        ->filterByPrimaryKeys($this->crmEmailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->crmEmailsScheduledForDeletion = null;
                }
            }

            if ($this->collCrmEmails !== null) {
                foreach ($this->collCrmEmails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->crmpeopleScheduledForDeletion !== null) {
                if (!$this->crmpeopleScheduledForDeletion->isEmpty()) {
                    \models\models\CrmPersonQuery::create()
                        ->filterByPrimaryKeys($this->crmpeopleScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->crmpeopleScheduledForDeletion = null;
                }
            }

            if ($this->collCrmpeople !== null) {
                foreach ($this->collCrmpeople as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->finCreditCardsScheduledForDeletion !== null) {
                if (!$this->finCreditCardsScheduledForDeletion->isEmpty()) {
                    \models\models\FinCreditCardQuery::create()
                        ->filterByPrimaryKeys($this->finCreditCardsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->finCreditCardsScheduledForDeletion = null;
                }
            }

            if ($this->collFinCreditCards !== null) {
                foreach ($this->collFinCreditCards as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->secRetailerLoginsScheduledForDeletion !== null) {
                if (!$this->secRetailerLoginsScheduledForDeletion->isEmpty()) {
                    \models\models\SecRetailerLoginQuery::create()
                        ->filterByPrimaryKeys($this->secRetailerLoginsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->secRetailerLoginsScheduledForDeletion = null;
                }
            }

            if ($this->collSecRetailerLogins !== null) {
                foreach ($this->collSecRetailerLogins as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CrmAccountTableMap::COL_CRM_ACCOUNT_ID] = true;
        if (null !== $this->crm_account_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CrmAccountTableMap::COL_CRM_ACCOUNT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CrmAccountTableMap::COL_CRM_ACCOUNT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'crm_account_id';
        }
        if ($this->isColumnModified(CrmAccountTableMap::COL_ADD_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'add_time';
        }

        $sql = sprintf(
            'INSERT INTO crm_account (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'crm_account_id':
                        $stmt->bindValue($identifier, $this->crm_account_id, PDO::PARAM_INT);
                        break;
                    case 'add_time':
                        $stmt->bindValue($identifier, $this->add_time ? $this->add_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setCrmAccountId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CrmAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getCrmAccountId();
                break;
            case 1:
                return $this->getAddTime();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['CrmAccount'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CrmAccount'][$this->hashCode()] = true;
        $keys = CrmAccountTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCrmAccountId(),
            $keys[1] => $this->getAddTime(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCrmAddressesRelatedByCrmAccountId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'crmAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'crm_addresses';
                        break;
                    default:
                        $key = 'CrmAddresses';
                }

                $result[$key] = $this->collCrmAddressesRelatedByCrmAccountId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleCrmAddressRelatedByCrmAddressId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'crmAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'crm_address';
                        break;
                    default:
                        $key = 'CrmAddress';
                }

                $result[$key] = $this->singleCrmAddressRelatedByCrmAddressId->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCrmEmails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'crmEmails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'crm_emails';
                        break;
                    default:
                        $key = 'CrmEmails';
                }

                $result[$key] = $this->collCrmEmails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCrmpeople) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'crmpeople';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'crm_people';
                        break;
                    default:
                        $key = 'Crmpeople';
                }

                $result[$key] = $this->collCrmpeople->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFinCreditCards) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'finCreditCards';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'fin_credit_cards';
                        break;
                    default:
                        $key = 'FinCreditCards';
                }

                $result[$key] = $this->collFinCreditCards->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSecRetailerLogins) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'secRetailerLogins';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sec_retailer_logins';
                        break;
                    default:
                        $key = 'SecRetailerLogins';
                }

                $result[$key] = $this->collSecRetailerLogins->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\models\models\CrmAccount
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CrmAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\CrmAccount
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCrmAccountId($value);
                break;
            case 1:
                $this->setAddTime($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CrmAccountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCrmAccountId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAddTime($arr[$keys[1]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\models\models\CrmAccount The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CrmAccountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CrmAccountTableMap::COL_CRM_ACCOUNT_ID)) {
            $criteria->add(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $this->crm_account_id);
        }
        if ($this->isColumnModified(CrmAccountTableMap::COL_ADD_TIME)) {
            $criteria->add(CrmAccountTableMap::COL_ADD_TIME, $this->add_time);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCrmAccountQuery::create();
        $criteria->add(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $this->crm_account_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getCrmAccountId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getCrmAccountId();
    }

    /**
     * Generic method to set the primary key (crm_account_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCrmAccountId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCrmAccountId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\CrmAccount (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAddTime($this->getAddTime());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCrmAddressesRelatedByCrmAccountId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCrmAddressRelatedByCrmAccountId($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getCrmAddressRelatedByCrmAddressId();
            if ($relObj) {
                $copyObj->setCrmAddressRelatedByCrmAddressId($relObj->copy($deepCopy));
            }

            foreach ($this->getCrmEmails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCrmEmail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCrmpeople() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCrmPerson($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFinCreditCards() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFinCreditCard($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSecRetailerLogins() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSecRetailerLogin($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCrmAccountId(NULL); // this is a auto-increment column, so set to default value
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
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \models\models\CrmAccount Clone of current object.
     * @throws PropelException
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('CrmAddressRelatedByCrmAccountId' == $relationName) {
            $this->initCrmAddressesRelatedByCrmAccountId();
            return;
        }
        if ('CrmEmail' == $relationName) {
            $this->initCrmEmails();
            return;
        }
        if ('CrmPerson' == $relationName) {
            $this->initCrmpeople();
            return;
        }
        if ('FinCreditCard' == $relationName) {
            $this->initFinCreditCards();
            return;
        }
        if ('SecRetailerLogin' == $relationName) {
            $this->initSecRetailerLogins();
            return;
        }
    }

    /**
     * Clears out the collCrmAddressesRelatedByCrmAccountId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCrmAddressesRelatedByCrmAccountId()
     */
    public function clearCrmAddressesRelatedByCrmAccountId()
    {
        $this->collCrmAddressesRelatedByCrmAccountId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCrmAddressesRelatedByCrmAccountId collection loaded partially.
     */
    public function resetPartialCrmAddressesRelatedByCrmAccountId($v = true)
    {
        $this->collCrmAddressesRelatedByCrmAccountIdPartial = $v;
    }

    /**
     * Initializes the collCrmAddressesRelatedByCrmAccountId collection.
     *
     * By default this just sets the collCrmAddressesRelatedByCrmAccountId collection to an empty array (like clearcollCrmAddressesRelatedByCrmAccountId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCrmAddressesRelatedByCrmAccountId($overrideExisting = true)
    {
        if (null !== $this->collCrmAddressesRelatedByCrmAccountId && !$overrideExisting) {
            return;
        }

        $collectionClassName = CrmAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collCrmAddressesRelatedByCrmAccountId = new $collectionClassName;
        $this->collCrmAddressesRelatedByCrmAccountId->setModel('\models\models\CrmAddress');
    }

    /**
     * Gets an array of ChildCrmAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCrmAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCrmAddress[] List of ChildCrmAddress objects
     * @throws PropelException
     */
    public function getCrmAddressesRelatedByCrmAccountId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmAddressesRelatedByCrmAccountIdPartial && !$this->isNew();
        if (null === $this->collCrmAddressesRelatedByCrmAccountId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCrmAddressesRelatedByCrmAccountId) {
                // return empty collection
                $this->initCrmAddressesRelatedByCrmAccountId();
            } else {
                $collCrmAddressesRelatedByCrmAccountId = ChildCrmAddressQuery::create(null, $criteria)
                    ->filterByCrmAccountRelatedByCrmAccountId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCrmAddressesRelatedByCrmAccountIdPartial && count($collCrmAddressesRelatedByCrmAccountId)) {
                        $this->initCrmAddressesRelatedByCrmAccountId(false);

                        foreach ($collCrmAddressesRelatedByCrmAccountId as $obj) {
                            if (false == $this->collCrmAddressesRelatedByCrmAccountId->contains($obj)) {
                                $this->collCrmAddressesRelatedByCrmAccountId->append($obj);
                            }
                        }

                        $this->collCrmAddressesRelatedByCrmAccountIdPartial = true;
                    }

                    return $collCrmAddressesRelatedByCrmAccountId;
                }

                if ($partial && $this->collCrmAddressesRelatedByCrmAccountId) {
                    foreach ($this->collCrmAddressesRelatedByCrmAccountId as $obj) {
                        if ($obj->isNew()) {
                            $collCrmAddressesRelatedByCrmAccountId[] = $obj;
                        }
                    }
                }

                $this->collCrmAddressesRelatedByCrmAccountId = $collCrmAddressesRelatedByCrmAccountId;
                $this->collCrmAddressesRelatedByCrmAccountIdPartial = false;
            }
        }

        return $this->collCrmAddressesRelatedByCrmAccountId;
    }

    /**
     * Sets a collection of ChildCrmAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $crmAddressesRelatedByCrmAccountId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function setCrmAddressesRelatedByCrmAccountId(Collection $crmAddressesRelatedByCrmAccountId, ConnectionInterface $con = null)
    {
        /** @var ChildCrmAddress[] $crmAddressesRelatedByCrmAccountIdToDelete */
        $crmAddressesRelatedByCrmAccountIdToDelete = $this->getCrmAddressesRelatedByCrmAccountId(new Criteria(), $con)->diff($crmAddressesRelatedByCrmAccountId);


        $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion = $crmAddressesRelatedByCrmAccountIdToDelete;

        foreach ($crmAddressesRelatedByCrmAccountIdToDelete as $crmAddressRelatedByCrmAccountIdRemoved) {
            $crmAddressRelatedByCrmAccountIdRemoved->setCrmAccountRelatedByCrmAccountId(null);
        }

        $this->collCrmAddressesRelatedByCrmAccountId = null;
        foreach ($crmAddressesRelatedByCrmAccountId as $crmAddressRelatedByCrmAccountId) {
            $this->addCrmAddressRelatedByCrmAccountId($crmAddressRelatedByCrmAccountId);
        }

        $this->collCrmAddressesRelatedByCrmAccountId = $crmAddressesRelatedByCrmAccountId;
        $this->collCrmAddressesRelatedByCrmAccountIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CrmAddress objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CrmAddress objects.
     * @throws PropelException
     */
    public function countCrmAddressesRelatedByCrmAccountId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmAddressesRelatedByCrmAccountIdPartial && !$this->isNew();
        if (null === $this->collCrmAddressesRelatedByCrmAccountId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCrmAddressesRelatedByCrmAccountId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCrmAddressesRelatedByCrmAccountId());
            }

            $query = ChildCrmAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCrmAccountRelatedByCrmAccountId($this)
                ->count($con);
        }

        return count($this->collCrmAddressesRelatedByCrmAccountId);
    }

    /**
     * Method called to associate a ChildCrmAddress object to this object
     * through the ChildCrmAddress foreign key attribute.
     *
     * @param  ChildCrmAddress $l ChildCrmAddress
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function addCrmAddressRelatedByCrmAccountId(ChildCrmAddress $l)
    {
        if ($this->collCrmAddressesRelatedByCrmAccountId === null) {
            $this->initCrmAddressesRelatedByCrmAccountId();
            $this->collCrmAddressesRelatedByCrmAccountIdPartial = true;
        }

        if (!$this->collCrmAddressesRelatedByCrmAccountId->contains($l)) {
            $this->doAddCrmAddressRelatedByCrmAccountId($l);

            if ($this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion and $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->contains($l)) {
                $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->remove($this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCrmAddress $crmAddressRelatedByCrmAccountId The ChildCrmAddress object to add.
     */
    protected function doAddCrmAddressRelatedByCrmAccountId(ChildCrmAddress $crmAddressRelatedByCrmAccountId)
    {
        $this->collCrmAddressesRelatedByCrmAccountId[]= $crmAddressRelatedByCrmAccountId;
        $crmAddressRelatedByCrmAccountId->setCrmAccountRelatedByCrmAccountId($this);
    }

    /**
     * @param  ChildCrmAddress $crmAddressRelatedByCrmAccountId The ChildCrmAddress object to remove.
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function removeCrmAddressRelatedByCrmAccountId(ChildCrmAddress $crmAddressRelatedByCrmAccountId)
    {
        if ($this->getCrmAddressesRelatedByCrmAccountId()->contains($crmAddressRelatedByCrmAccountId)) {
            $pos = $this->collCrmAddressesRelatedByCrmAccountId->search($crmAddressRelatedByCrmAccountId);
            $this->collCrmAddressesRelatedByCrmAccountId->remove($pos);
            if (null === $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion) {
                $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion = clone $this->collCrmAddressesRelatedByCrmAccountId;
                $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion->clear();
            }
            $this->crmAddressesRelatedByCrmAccountIdScheduledForDeletion[]= clone $crmAddressRelatedByCrmAccountId;
            $crmAddressRelatedByCrmAccountId->setCrmAccountRelatedByCrmAccountId(null);
        }

        return $this;
    }

    /**
     * Gets a single ChildCrmAddress object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildCrmAddress
     * @throws PropelException
     */
    public function getCrmAddressRelatedByCrmAddressId(ConnectionInterface $con = null)
    {

        if ($this->singleCrmAddressRelatedByCrmAddressId === null && !$this->isNew()) {
            $this->singleCrmAddressRelatedByCrmAddressId = ChildCrmAddressQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleCrmAddressRelatedByCrmAddressId;
    }

    /**
     * Sets a single ChildCrmAddress object as related to this object by a one-to-one relationship.
     *
     * @param  ChildCrmAddress $v ChildCrmAddress
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCrmAddressRelatedByCrmAddressId(ChildCrmAddress $v = null)
    {
        $this->singleCrmAddressRelatedByCrmAddressId = $v;

        // Make sure that that the passed-in ChildCrmAddress isn't already associated with this object
        if ($v !== null && $v->getCrmAccountRelatedByCrmAddressId(null, false) === null) {
            $v->setCrmAccountRelatedByCrmAddressId($this);
        }

        return $this;
    }

    /**
     * Clears out the collCrmEmails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCrmEmails()
     */
    public function clearCrmEmails()
    {
        $this->collCrmEmails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCrmEmails collection loaded partially.
     */
    public function resetPartialCrmEmails($v = true)
    {
        $this->collCrmEmailsPartial = $v;
    }

    /**
     * Initializes the collCrmEmails collection.
     *
     * By default this just sets the collCrmEmails collection to an empty array (like clearcollCrmEmails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCrmEmails($overrideExisting = true)
    {
        if (null !== $this->collCrmEmails && !$overrideExisting) {
            return;
        }

        $collectionClassName = CrmEmailTableMap::getTableMap()->getCollectionClassName();

        $this->collCrmEmails = new $collectionClassName;
        $this->collCrmEmails->setModel('\models\models\CrmEmail');
    }

    /**
     * Gets an array of ChildCrmEmail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCrmAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCrmEmail[] List of ChildCrmEmail objects
     * @throws PropelException
     */
    public function getCrmEmails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmEmailsPartial && !$this->isNew();
        if (null === $this->collCrmEmails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCrmEmails) {
                // return empty collection
                $this->initCrmEmails();
            } else {
                $collCrmEmails = ChildCrmEmailQuery::create(null, $criteria)
                    ->filterByCrmAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCrmEmailsPartial && count($collCrmEmails)) {
                        $this->initCrmEmails(false);

                        foreach ($collCrmEmails as $obj) {
                            if (false == $this->collCrmEmails->contains($obj)) {
                                $this->collCrmEmails->append($obj);
                            }
                        }

                        $this->collCrmEmailsPartial = true;
                    }

                    return $collCrmEmails;
                }

                if ($partial && $this->collCrmEmails) {
                    foreach ($this->collCrmEmails as $obj) {
                        if ($obj->isNew()) {
                            $collCrmEmails[] = $obj;
                        }
                    }
                }

                $this->collCrmEmails = $collCrmEmails;
                $this->collCrmEmailsPartial = false;
            }
        }

        return $this->collCrmEmails;
    }

    /**
     * Sets a collection of ChildCrmEmail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $crmEmails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function setCrmEmails(Collection $crmEmails, ConnectionInterface $con = null)
    {
        /** @var ChildCrmEmail[] $crmEmailsToDelete */
        $crmEmailsToDelete = $this->getCrmEmails(new Criteria(), $con)->diff($crmEmails);


        $this->crmEmailsScheduledForDeletion = $crmEmailsToDelete;

        foreach ($crmEmailsToDelete as $crmEmailRemoved) {
            $crmEmailRemoved->setCrmAccount(null);
        }

        $this->collCrmEmails = null;
        foreach ($crmEmails as $crmEmail) {
            $this->addCrmEmail($crmEmail);
        }

        $this->collCrmEmails = $crmEmails;
        $this->collCrmEmailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CrmEmail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CrmEmail objects.
     * @throws PropelException
     */
    public function countCrmEmails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmEmailsPartial && !$this->isNew();
        if (null === $this->collCrmEmails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCrmEmails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCrmEmails());
            }

            $query = ChildCrmEmailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCrmAccount($this)
                ->count($con);
        }

        return count($this->collCrmEmails);
    }

    /**
     * Method called to associate a ChildCrmEmail object to this object
     * through the ChildCrmEmail foreign key attribute.
     *
     * @param  ChildCrmEmail $l ChildCrmEmail
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function addCrmEmail(ChildCrmEmail $l)
    {
        if ($this->collCrmEmails === null) {
            $this->initCrmEmails();
            $this->collCrmEmailsPartial = true;
        }

        if (!$this->collCrmEmails->contains($l)) {
            $this->doAddCrmEmail($l);

            if ($this->crmEmailsScheduledForDeletion and $this->crmEmailsScheduledForDeletion->contains($l)) {
                $this->crmEmailsScheduledForDeletion->remove($this->crmEmailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCrmEmail $crmEmail The ChildCrmEmail object to add.
     */
    protected function doAddCrmEmail(ChildCrmEmail $crmEmail)
    {
        $this->collCrmEmails[]= $crmEmail;
        $crmEmail->setCrmAccount($this);
    }

    /**
     * @param  ChildCrmEmail $crmEmail The ChildCrmEmail object to remove.
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function removeCrmEmail(ChildCrmEmail $crmEmail)
    {
        if ($this->getCrmEmails()->contains($crmEmail)) {
            $pos = $this->collCrmEmails->search($crmEmail);
            $this->collCrmEmails->remove($pos);
            if (null === $this->crmEmailsScheduledForDeletion) {
                $this->crmEmailsScheduledForDeletion = clone $this->collCrmEmails;
                $this->crmEmailsScheduledForDeletion->clear();
            }
            $this->crmEmailsScheduledForDeletion[]= clone $crmEmail;
            $crmEmail->setCrmAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collCrmpeople collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCrmpeople()
     */
    public function clearCrmpeople()
    {
        $this->collCrmpeople = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCrmpeople collection loaded partially.
     */
    public function resetPartialCrmpeople($v = true)
    {
        $this->collCrmpeoplePartial = $v;
    }

    /**
     * Initializes the collCrmpeople collection.
     *
     * By default this just sets the collCrmpeople collection to an empty array (like clearcollCrmpeople());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCrmpeople($overrideExisting = true)
    {
        if (null !== $this->collCrmpeople && !$overrideExisting) {
            return;
        }

        $collectionClassName = CrmPersonTableMap::getTableMap()->getCollectionClassName();

        $this->collCrmpeople = new $collectionClassName;
        $this->collCrmpeople->setModel('\models\models\CrmPerson');
    }

    /**
     * Gets an array of ChildCrmPerson objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCrmAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCrmPerson[] List of ChildCrmPerson objects
     * @throws PropelException
     */
    public function getCrmpeople(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmpeoplePartial && !$this->isNew();
        if (null === $this->collCrmpeople || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCrmpeople) {
                // return empty collection
                $this->initCrmpeople();
            } else {
                $collCrmpeople = ChildCrmPersonQuery::create(null, $criteria)
                    ->filterByCrmAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCrmpeoplePartial && count($collCrmpeople)) {
                        $this->initCrmpeople(false);

                        foreach ($collCrmpeople as $obj) {
                            if (false == $this->collCrmpeople->contains($obj)) {
                                $this->collCrmpeople->append($obj);
                            }
                        }

                        $this->collCrmpeoplePartial = true;
                    }

                    return $collCrmpeople;
                }

                if ($partial && $this->collCrmpeople) {
                    foreach ($this->collCrmpeople as $obj) {
                        if ($obj->isNew()) {
                            $collCrmpeople[] = $obj;
                        }
                    }
                }

                $this->collCrmpeople = $collCrmpeople;
                $this->collCrmpeoplePartial = false;
            }
        }

        return $this->collCrmpeople;
    }

    /**
     * Sets a collection of ChildCrmPerson objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $crmpeople A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function setCrmpeople(Collection $crmpeople, ConnectionInterface $con = null)
    {
        /** @var ChildCrmPerson[] $crmpeopleToDelete */
        $crmpeopleToDelete = $this->getCrmpeople(new Criteria(), $con)->diff($crmpeople);


        $this->crmpeopleScheduledForDeletion = $crmpeopleToDelete;

        foreach ($crmpeopleToDelete as $crmPersonRemoved) {
            $crmPersonRemoved->setCrmAccount(null);
        }

        $this->collCrmpeople = null;
        foreach ($crmpeople as $crmPerson) {
            $this->addCrmPerson($crmPerson);
        }

        $this->collCrmpeople = $crmpeople;
        $this->collCrmpeoplePartial = false;

        return $this;
    }

    /**
     * Returns the number of related CrmPerson objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CrmPerson objects.
     * @throws PropelException
     */
    public function countCrmpeople(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCrmpeoplePartial && !$this->isNew();
        if (null === $this->collCrmpeople || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCrmpeople) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCrmpeople());
            }

            $query = ChildCrmPersonQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCrmAccount($this)
                ->count($con);
        }

        return count($this->collCrmpeople);
    }

    /**
     * Method called to associate a ChildCrmPerson object to this object
     * through the ChildCrmPerson foreign key attribute.
     *
     * @param  ChildCrmPerson $l ChildCrmPerson
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function addCrmPerson(ChildCrmPerson $l)
    {
        if ($this->collCrmpeople === null) {
            $this->initCrmpeople();
            $this->collCrmpeoplePartial = true;
        }

        if (!$this->collCrmpeople->contains($l)) {
            $this->doAddCrmPerson($l);

            if ($this->crmpeopleScheduledForDeletion and $this->crmpeopleScheduledForDeletion->contains($l)) {
                $this->crmpeopleScheduledForDeletion->remove($this->crmpeopleScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCrmPerson $crmPerson The ChildCrmPerson object to add.
     */
    protected function doAddCrmPerson(ChildCrmPerson $crmPerson)
    {
        $this->collCrmpeople[]= $crmPerson;
        $crmPerson->setCrmAccount($this);
    }

    /**
     * @param  ChildCrmPerson $crmPerson The ChildCrmPerson object to remove.
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function removeCrmPerson(ChildCrmPerson $crmPerson)
    {
        if ($this->getCrmpeople()->contains($crmPerson)) {
            $pos = $this->collCrmpeople->search($crmPerson);
            $this->collCrmpeople->remove($pos);
            if (null === $this->crmpeopleScheduledForDeletion) {
                $this->crmpeopleScheduledForDeletion = clone $this->collCrmpeople;
                $this->crmpeopleScheduledForDeletion->clear();
            }
            $this->crmpeopleScheduledForDeletion[]= clone $crmPerson;
            $crmPerson->setCrmAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collFinCreditCards collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFinCreditCards()
     */
    public function clearFinCreditCards()
    {
        $this->collFinCreditCards = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFinCreditCards collection loaded partially.
     */
    public function resetPartialFinCreditCards($v = true)
    {
        $this->collFinCreditCardsPartial = $v;
    }

    /**
     * Initializes the collFinCreditCards collection.
     *
     * By default this just sets the collFinCreditCards collection to an empty array (like clearcollFinCreditCards());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFinCreditCards($overrideExisting = true)
    {
        if (null !== $this->collFinCreditCards && !$overrideExisting) {
            return;
        }

        $collectionClassName = FinCreditCardTableMap::getTableMap()->getCollectionClassName();

        $this->collFinCreditCards = new $collectionClassName;
        $this->collFinCreditCards->setModel('\models\models\FinCreditCard');
    }

    /**
     * Gets an array of ChildFinCreditCard objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCrmAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFinCreditCard[] List of ChildFinCreditCard objects
     * @throws PropelException
     */
    public function getFinCreditCards(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFinCreditCardsPartial && !$this->isNew();
        if (null === $this->collFinCreditCards || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFinCreditCards) {
                // return empty collection
                $this->initFinCreditCards();
            } else {
                $collFinCreditCards = ChildFinCreditCardQuery::create(null, $criteria)
                    ->filterByCrmAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFinCreditCardsPartial && count($collFinCreditCards)) {
                        $this->initFinCreditCards(false);

                        foreach ($collFinCreditCards as $obj) {
                            if (false == $this->collFinCreditCards->contains($obj)) {
                                $this->collFinCreditCards->append($obj);
                            }
                        }

                        $this->collFinCreditCardsPartial = true;
                    }

                    return $collFinCreditCards;
                }

                if ($partial && $this->collFinCreditCards) {
                    foreach ($this->collFinCreditCards as $obj) {
                        if ($obj->isNew()) {
                            $collFinCreditCards[] = $obj;
                        }
                    }
                }

                $this->collFinCreditCards = $collFinCreditCards;
                $this->collFinCreditCardsPartial = false;
            }
        }

        return $this->collFinCreditCards;
    }

    /**
     * Sets a collection of ChildFinCreditCard objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $finCreditCards A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function setFinCreditCards(Collection $finCreditCards, ConnectionInterface $con = null)
    {
        /** @var ChildFinCreditCard[] $finCreditCardsToDelete */
        $finCreditCardsToDelete = $this->getFinCreditCards(new Criteria(), $con)->diff($finCreditCards);


        $this->finCreditCardsScheduledForDeletion = $finCreditCardsToDelete;

        foreach ($finCreditCardsToDelete as $finCreditCardRemoved) {
            $finCreditCardRemoved->setCrmAccount(null);
        }

        $this->collFinCreditCards = null;
        foreach ($finCreditCards as $finCreditCard) {
            $this->addFinCreditCard($finCreditCard);
        }

        $this->collFinCreditCards = $finCreditCards;
        $this->collFinCreditCardsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FinCreditCard objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FinCreditCard objects.
     * @throws PropelException
     */
    public function countFinCreditCards(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFinCreditCardsPartial && !$this->isNew();
        if (null === $this->collFinCreditCards || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFinCreditCards) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFinCreditCards());
            }

            $query = ChildFinCreditCardQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCrmAccount($this)
                ->count($con);
        }

        return count($this->collFinCreditCards);
    }

    /**
     * Method called to associate a ChildFinCreditCard object to this object
     * through the ChildFinCreditCard foreign key attribute.
     *
     * @param  ChildFinCreditCard $l ChildFinCreditCard
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function addFinCreditCard(ChildFinCreditCard $l)
    {
        if ($this->collFinCreditCards === null) {
            $this->initFinCreditCards();
            $this->collFinCreditCardsPartial = true;
        }

        if (!$this->collFinCreditCards->contains($l)) {
            $this->doAddFinCreditCard($l);

            if ($this->finCreditCardsScheduledForDeletion and $this->finCreditCardsScheduledForDeletion->contains($l)) {
                $this->finCreditCardsScheduledForDeletion->remove($this->finCreditCardsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFinCreditCard $finCreditCard The ChildFinCreditCard object to add.
     */
    protected function doAddFinCreditCard(ChildFinCreditCard $finCreditCard)
    {
        $this->collFinCreditCards[]= $finCreditCard;
        $finCreditCard->setCrmAccount($this);
    }

    /**
     * @param  ChildFinCreditCard $finCreditCard The ChildFinCreditCard object to remove.
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function removeFinCreditCard(ChildFinCreditCard $finCreditCard)
    {
        if ($this->getFinCreditCards()->contains($finCreditCard)) {
            $pos = $this->collFinCreditCards->search($finCreditCard);
            $this->collFinCreditCards->remove($pos);
            if (null === $this->finCreditCardsScheduledForDeletion) {
                $this->finCreditCardsScheduledForDeletion = clone $this->collFinCreditCards;
                $this->finCreditCardsScheduledForDeletion->clear();
            }
            $this->finCreditCardsScheduledForDeletion[]= clone $finCreditCard;
            $finCreditCard->setCrmAccount(null);
        }

        return $this;
    }

    /**
     * Clears out the collSecRetailerLogins collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSecRetailerLogins()
     */
    public function clearSecRetailerLogins()
    {
        $this->collSecRetailerLogins = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSecRetailerLogins collection loaded partially.
     */
    public function resetPartialSecRetailerLogins($v = true)
    {
        $this->collSecRetailerLoginsPartial = $v;
    }

    /**
     * Initializes the collSecRetailerLogins collection.
     *
     * By default this just sets the collSecRetailerLogins collection to an empty array (like clearcollSecRetailerLogins());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSecRetailerLogins($overrideExisting = true)
    {
        if (null !== $this->collSecRetailerLogins && !$overrideExisting) {
            return;
        }

        $collectionClassName = SecRetailerLoginTableMap::getTableMap()->getCollectionClassName();

        $this->collSecRetailerLogins = new $collectionClassName;
        $this->collSecRetailerLogins->setModel('\models\models\SecRetailerLogin');
    }

    /**
     * Gets an array of ChildSecRetailerLogin objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCrmAccount is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSecRetailerLogin[] List of ChildSecRetailerLogin objects
     * @throws PropelException
     */
    public function getSecRetailerLogins(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSecRetailerLoginsPartial && !$this->isNew();
        if (null === $this->collSecRetailerLogins || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSecRetailerLogins) {
                // return empty collection
                $this->initSecRetailerLogins();
            } else {
                $collSecRetailerLogins = ChildSecRetailerLoginQuery::create(null, $criteria)
                    ->filterByCrmAccount($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSecRetailerLoginsPartial && count($collSecRetailerLogins)) {
                        $this->initSecRetailerLogins(false);

                        foreach ($collSecRetailerLogins as $obj) {
                            if (false == $this->collSecRetailerLogins->contains($obj)) {
                                $this->collSecRetailerLogins->append($obj);
                            }
                        }

                        $this->collSecRetailerLoginsPartial = true;
                    }

                    return $collSecRetailerLogins;
                }

                if ($partial && $this->collSecRetailerLogins) {
                    foreach ($this->collSecRetailerLogins as $obj) {
                        if ($obj->isNew()) {
                            $collSecRetailerLogins[] = $obj;
                        }
                    }
                }

                $this->collSecRetailerLogins = $collSecRetailerLogins;
                $this->collSecRetailerLoginsPartial = false;
            }
        }

        return $this->collSecRetailerLogins;
    }

    /**
     * Sets a collection of ChildSecRetailerLogin objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $secRetailerLogins A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function setSecRetailerLogins(Collection $secRetailerLogins, ConnectionInterface $con = null)
    {
        /** @var ChildSecRetailerLogin[] $secRetailerLoginsToDelete */
        $secRetailerLoginsToDelete = $this->getSecRetailerLogins(new Criteria(), $con)->diff($secRetailerLogins);


        $this->secRetailerLoginsScheduledForDeletion = $secRetailerLoginsToDelete;

        foreach ($secRetailerLoginsToDelete as $secRetailerLoginRemoved) {
            $secRetailerLoginRemoved->setCrmAccount(null);
        }

        $this->collSecRetailerLogins = null;
        foreach ($secRetailerLogins as $secRetailerLogin) {
            $this->addSecRetailerLogin($secRetailerLogin);
        }

        $this->collSecRetailerLogins = $secRetailerLogins;
        $this->collSecRetailerLoginsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SecRetailerLogin objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SecRetailerLogin objects.
     * @throws PropelException
     */
    public function countSecRetailerLogins(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSecRetailerLoginsPartial && !$this->isNew();
        if (null === $this->collSecRetailerLogins || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSecRetailerLogins) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSecRetailerLogins());
            }

            $query = ChildSecRetailerLoginQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCrmAccount($this)
                ->count($con);
        }

        return count($this->collSecRetailerLogins);
    }

    /**
     * Method called to associate a ChildSecRetailerLogin object to this object
     * through the ChildSecRetailerLogin foreign key attribute.
     *
     * @param  ChildSecRetailerLogin $l ChildSecRetailerLogin
     * @return $this|\models\models\CrmAccount The current object (for fluent API support)
     */
    public function addSecRetailerLogin(ChildSecRetailerLogin $l)
    {
        if ($this->collSecRetailerLogins === null) {
            $this->initSecRetailerLogins();
            $this->collSecRetailerLoginsPartial = true;
        }

        if (!$this->collSecRetailerLogins->contains($l)) {
            $this->doAddSecRetailerLogin($l);

            if ($this->secRetailerLoginsScheduledForDeletion and $this->secRetailerLoginsScheduledForDeletion->contains($l)) {
                $this->secRetailerLoginsScheduledForDeletion->remove($this->secRetailerLoginsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSecRetailerLogin $secRetailerLogin The ChildSecRetailerLogin object to add.
     */
    protected function doAddSecRetailerLogin(ChildSecRetailerLogin $secRetailerLogin)
    {
        $this->collSecRetailerLogins[]= $secRetailerLogin;
        $secRetailerLogin->setCrmAccount($this);
    }

    /**
     * @param  ChildSecRetailerLogin $secRetailerLogin The ChildSecRetailerLogin object to remove.
     * @return $this|ChildCrmAccount The current object (for fluent API support)
     */
    public function removeSecRetailerLogin(ChildSecRetailerLogin $secRetailerLogin)
    {
        if ($this->getSecRetailerLogins()->contains($secRetailerLogin)) {
            $pos = $this->collSecRetailerLogins->search($secRetailerLogin);
            $this->collSecRetailerLogins->remove($pos);
            if (null === $this->secRetailerLoginsScheduledForDeletion) {
                $this->secRetailerLoginsScheduledForDeletion = clone $this->collSecRetailerLogins;
                $this->secRetailerLoginsScheduledForDeletion->clear();
            }
            $this->secRetailerLoginsScheduledForDeletion[]= clone $secRetailerLogin;
            $secRetailerLogin->setCrmAccount(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->crm_account_id = null;
        $this->add_time = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCrmAddressesRelatedByCrmAccountId) {
                foreach ($this->collCrmAddressesRelatedByCrmAccountId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleCrmAddressRelatedByCrmAddressId) {
                $this->singleCrmAddressRelatedByCrmAddressId->clearAllReferences($deep);
            }
            if ($this->collCrmEmails) {
                foreach ($this->collCrmEmails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCrmpeople) {
                foreach ($this->collCrmpeople as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFinCreditCards) {
                foreach ($this->collFinCreditCards as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSecRetailerLogins) {
                foreach ($this->collSecRetailerLogins as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCrmAddressesRelatedByCrmAccountId = null;
        $this->singleCrmAddressRelatedByCrmAddressId = null;
        $this->collCrmEmails = null;
        $this->collCrmpeople = null;
        $this->collFinCreditCards = null;
        $this->collSecRetailerLogins = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CrmAccountTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
