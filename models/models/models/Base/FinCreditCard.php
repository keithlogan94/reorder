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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use models\models\CrmAccount as ChildCrmAccount;
use models\models\CrmAccountQuery as ChildCrmAccountQuery;
use models\models\FinCreditCardQuery as ChildFinCreditCardQuery;
use models\models\Map\FinCreditCardTableMap;

/**
 * Base class that represents a row from the 'fin_credit_card' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class FinCreditCard implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\FinCreditCardTableMap';


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
     * The value for the fin_credit_card_id field.
     *
     * @var        int
     */
    protected $fin_credit_card_id;

    /**
     * The value for the crm_account_id field.
     *
     * @var        int
     */
    protected $crm_account_id;

    /**
     * The value for the name_on_card field.
     *
     * @var        string
     */
    protected $name_on_card;

    /**
     * The value for the number field.
     *
     * @var        string
     */
    protected $number;

    /**
     * The value for the security_code field.
     *
     * @var        string
     */
    protected $security_code;

    /**
     * The value for the expiration_month field.
     *
     * @var        int
     */
    protected $expiration_month;

    /**
     * The value for the expiration_year field.
     *
     * @var        int
     */
    protected $expiration_year;

    /**
     * The value for the add_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $add_date;

    /**
     * The value for the start_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        DateTime
     */
    protected $end_date;

    /**
     * @var        ChildCrmAccount
     */
    protected $aCrmAccount;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of models\models\Base\FinCreditCard object.
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
     * Compares this with another <code>FinCreditCard</code> instance.  If
     * <code>obj</code> is an instance of <code>FinCreditCard</code>, delegates to
     * <code>equals(FinCreditCard)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|FinCreditCard The current object, for fluid interface
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
     * Get the [fin_credit_card_id] column value.
     *
     * @return int
     */
    public function getFinCreditCardId()
    {
        return $this->fin_credit_card_id;
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
     * Get the [name_on_card] column value.
     *
     * @return string
     */
    public function getNameOnCard()
    {
        return $this->name_on_card;
    }

    /**
     * Get the [number] column value.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the [security_code] column value.
     *
     * @return string
     */
    public function getSecurityCode()
    {
        return $this->security_code;
    }

    /**
     * Get the [expiration_month] column value.
     *
     * @return int
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * Get the [expiration_year] column value.
     *
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * Get the [optionally formatted] temporal [add_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getAddDate($format = NULL)
    {
        if ($format === null) {
            return $this->add_date;
        } else {
            return $this->add_date instanceof \DateTimeInterface ? $this->add_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [start_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartDate($format = NULL)
    {
        if ($format === null) {
            return $this->start_date;
        } else {
            return $this->start_date instanceof \DateTimeInterface ? $this->start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEndDate($format = NULL)
    {
        if ($format === null) {
            return $this->end_date;
        } else {
            return $this->end_date instanceof \DateTimeInterface ? $this->end_date->format($format) : null;
        }
    }

    /**
     * Set the value of [fin_credit_card_id] column.
     *
     * @param int $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setFinCreditCardId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fin_credit_card_id !== $v) {
            $this->fin_credit_card_id = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID] = true;
        }

        return $this;
    } // setFinCreditCardId()

    /**
     * Set the value of [crm_account_id] column.
     *
     * @param int $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setCrmAccountId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->crm_account_id !== $v) {
            $this->crm_account_id = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_CRM_ACCOUNT_ID] = true;
        }

        if ($this->aCrmAccount !== null && $this->aCrmAccount->getCrmAccountId() !== $v) {
            $this->aCrmAccount = null;
        }

        return $this;
    } // setCrmAccountId()

    /**
     * Set the value of [name_on_card] column.
     *
     * @param string $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setNameOnCard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name_on_card !== $v) {
            $this->name_on_card = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_NAME_ON_CARD] = true;
        }

        return $this;
    } // setNameOnCard()

    /**
     * Set the value of [number] column.
     *
     * @param string $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->number !== $v) {
            $this->number = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_NUMBER] = true;
        }

        return $this;
    } // setNumber()

    /**
     * Set the value of [security_code] column.
     *
     * @param string $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setSecurityCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->security_code !== $v) {
            $this->security_code = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_SECURITY_CODE] = true;
        }

        return $this;
    } // setSecurityCode()

    /**
     * Set the value of [expiration_month] column.
     *
     * @param int $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setExpirationMonth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expiration_month !== $v) {
            $this->expiration_month = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_EXPIRATION_MONTH] = true;
        }

        return $this;
    } // setExpirationMonth()

    /**
     * Set the value of [expiration_year] column.
     *
     * @param int $v new value
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setExpirationYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expiration_year !== $v) {
            $this->expiration_year = $v;
            $this->modifiedColumns[FinCreditCardTableMap::COL_EXPIRATION_YEAR] = true;
        }

        return $this;
    } // setExpirationYear()

    /**
     * Sets the value of [add_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setAddDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->add_date !== null || $dt !== null) {
            if ($this->add_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->add_date->format("Y-m-d H:i:s.u")) {
                $this->add_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FinCreditCardTableMap::COL_ADD_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setAddDate()

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            if ($this->start_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_date->format("Y-m-d H:i:s.u")) {
                $this->start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FinCreditCardTableMap::COL_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setStartDate()

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($this->end_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->end_date->format("Y-m-d H:i:s.u")) {
                $this->end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FinCreditCardTableMap::COL_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setEndDate()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FinCreditCardTableMap::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fin_credit_card_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FinCreditCardTableMap::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->crm_account_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FinCreditCardTableMap::translateFieldName('NameOnCard', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name_on_card = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FinCreditCardTableMap::translateFieldName('Number', TableMap::TYPE_PHPNAME, $indexType)];
            $this->number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FinCreditCardTableMap::translateFieldName('SecurityCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->security_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FinCreditCardTableMap::translateFieldName('ExpirationMonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expiration_month = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FinCreditCardTableMap::translateFieldName('ExpirationYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expiration_year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FinCreditCardTableMap::translateFieldName('AddDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->add_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FinCreditCardTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : FinCreditCardTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = FinCreditCardTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\FinCreditCard'), 0, $e);
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
        if ($this->aCrmAccount !== null && $this->crm_account_id !== $this->aCrmAccount->getCrmAccountId()) {
            $this->aCrmAccount = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFinCreditCardQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCrmAccount = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see FinCreditCard::setDeleted()
     * @see FinCreditCard::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFinCreditCardQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
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
                FinCreditCardTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCrmAccount !== null) {
                if ($this->aCrmAccount->isModified() || $this->aCrmAccount->isNew()) {
                    $affectedRows += $this->aCrmAccount->save($con);
                }
                $this->setCrmAccount($this->aCrmAccount);
            }

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

        $this->modifiedColumns[FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID] = true;
        if (null !== $this->fin_credit_card_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'fin_credit_card_id';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'crm_account_id';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_NAME_ON_CARD)) {
            $modifiedColumns[':p' . $index++]  = 'name_on_card';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'number';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_SECURITY_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'security_code';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_EXPIRATION_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'expiration_month';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_EXPIRATION_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'expiration_year';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_ADD_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'add_date';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }

        $sql = sprintf(
            'INSERT INTO fin_credit_card (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'fin_credit_card_id':
                        $stmt->bindValue($identifier, $this->fin_credit_card_id, PDO::PARAM_INT);
                        break;
                    case 'crm_account_id':
                        $stmt->bindValue($identifier, $this->crm_account_id, PDO::PARAM_INT);
                        break;
                    case 'name_on_card':
                        $stmt->bindValue($identifier, $this->name_on_card, PDO::PARAM_STR);
                        break;
                    case 'number':
                        $stmt->bindValue($identifier, $this->number, PDO::PARAM_STR);
                        break;
                    case 'security_code':
                        $stmt->bindValue($identifier, $this->security_code, PDO::PARAM_STR);
                        break;
                    case 'expiration_month':
                        $stmt->bindValue($identifier, $this->expiration_month, PDO::PARAM_INT);
                        break;
                    case 'expiration_year':
                        $stmt->bindValue($identifier, $this->expiration_year, PDO::PARAM_INT);
                        break;
                    case 'add_date':
                        $stmt->bindValue($identifier, $this->add_date ? $this->add_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date ? $this->start_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
        $this->setFinCreditCardId($pk);

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
        $pos = FinCreditCardTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFinCreditCardId();
                break;
            case 1:
                return $this->getCrmAccountId();
                break;
            case 2:
                return $this->getNameOnCard();
                break;
            case 3:
                return $this->getNumber();
                break;
            case 4:
                return $this->getSecurityCode();
                break;
            case 5:
                return $this->getExpirationMonth();
                break;
            case 6:
                return $this->getExpirationYear();
                break;
            case 7:
                return $this->getAddDate();
                break;
            case 8:
                return $this->getStartDate();
                break;
            case 9:
                return $this->getEndDate();
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

        if (isset($alreadyDumpedObjects['FinCreditCard'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['FinCreditCard'][$this->hashCode()] = true;
        $keys = FinCreditCardTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFinCreditCardId(),
            $keys[1] => $this->getCrmAccountId(),
            $keys[2] => $this->getNameOnCard(),
            $keys[3] => $this->getNumber(),
            $keys[4] => $this->getSecurityCode(),
            $keys[5] => $this->getExpirationMonth(),
            $keys[6] => $this->getExpirationYear(),
            $keys[7] => $this->getAddDate(),
            $keys[8] => $this->getStartDate(),
            $keys[9] => $this->getEndDate(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCrmAccount) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'crmAccount';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'crm_account';
                        break;
                    default:
                        $key = 'CrmAccount';
                }

                $result[$key] = $this->aCrmAccount->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\models\models\FinCreditCard
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FinCreditCardTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\FinCreditCard
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFinCreditCardId($value);
                break;
            case 1:
                $this->setCrmAccountId($value);
                break;
            case 2:
                $this->setNameOnCard($value);
                break;
            case 3:
                $this->setNumber($value);
                break;
            case 4:
                $this->setSecurityCode($value);
                break;
            case 5:
                $this->setExpirationMonth($value);
                break;
            case 6:
                $this->setExpirationYear($value);
                break;
            case 7:
                $this->setAddDate($value);
                break;
            case 8:
                $this->setStartDate($value);
                break;
            case 9:
                $this->setEndDate($value);
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
        $keys = FinCreditCardTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFinCreditCardId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCrmAccountId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNameOnCard($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNumber($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSecurityCode($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setExpirationMonth($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExpirationYear($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAddDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStartDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEndDate($arr[$keys[9]]);
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
     * @return $this|\models\models\FinCreditCard The current object, for fluid interface
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
        $criteria = new Criteria(FinCreditCardTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID)) {
            $criteria->add(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $this->fin_credit_card_id);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID)) {
            $criteria->add(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $this->crm_account_id);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_NAME_ON_CARD)) {
            $criteria->add(FinCreditCardTableMap::COL_NAME_ON_CARD, $this->name_on_card);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_NUMBER)) {
            $criteria->add(FinCreditCardTableMap::COL_NUMBER, $this->number);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_SECURITY_CODE)) {
            $criteria->add(FinCreditCardTableMap::COL_SECURITY_CODE, $this->security_code);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_EXPIRATION_MONTH)) {
            $criteria->add(FinCreditCardTableMap::COL_EXPIRATION_MONTH, $this->expiration_month);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_EXPIRATION_YEAR)) {
            $criteria->add(FinCreditCardTableMap::COL_EXPIRATION_YEAR, $this->expiration_year);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_ADD_DATE)) {
            $criteria->add(FinCreditCardTableMap::COL_ADD_DATE, $this->add_date);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_START_DATE)) {
            $criteria->add(FinCreditCardTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(FinCreditCardTableMap::COL_END_DATE)) {
            $criteria->add(FinCreditCardTableMap::COL_END_DATE, $this->end_date);
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
        $criteria = ChildFinCreditCardQuery::create();
        $criteria->add(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $this->fin_credit_card_id);

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
        $validPk = null !== $this->getFinCreditCardId();

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
        return $this->getFinCreditCardId();
    }

    /**
     * Generic method to set the primary key (fin_credit_card_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFinCreditCardId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFinCreditCardId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\FinCreditCard (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCrmAccountId($this->getCrmAccountId());
        $copyObj->setNameOnCard($this->getNameOnCard());
        $copyObj->setNumber($this->getNumber());
        $copyObj->setSecurityCode($this->getSecurityCode());
        $copyObj->setExpirationMonth($this->getExpirationMonth());
        $copyObj->setExpirationYear($this->getExpirationYear());
        $copyObj->setAddDate($this->getAddDate());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFinCreditCardId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \models\models\FinCreditCard Clone of current object.
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
     * Declares an association between this object and a ChildCrmAccount object.
     *
     * @param  ChildCrmAccount $v
     * @return $this|\models\models\FinCreditCard The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCrmAccount(ChildCrmAccount $v = null)
    {
        if ($v === null) {
            $this->setCrmAccountId(NULL);
        } else {
            $this->setCrmAccountId($v->getCrmAccountId());
        }

        $this->aCrmAccount = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCrmAccount object, it will not be re-added.
        if ($v !== null) {
            $v->addFinCreditCard($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCrmAccount object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCrmAccount The associated ChildCrmAccount object.
     * @throws PropelException
     */
    public function getCrmAccount(ConnectionInterface $con = null)
    {
        if ($this->aCrmAccount === null && ($this->crm_account_id != 0)) {
            $this->aCrmAccount = ChildCrmAccountQuery::create()->findPk($this->crm_account_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCrmAccount->addFinCreditCards($this);
             */
        }

        return $this->aCrmAccount;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCrmAccount) {
            $this->aCrmAccount->removeFinCreditCard($this);
        }
        $this->fin_credit_card_id = null;
        $this->crm_account_id = null;
        $this->name_on_card = null;
        $this->number = null;
        $this->security_code = null;
        $this->expiration_month = null;
        $this->expiration_year = null;
        $this->add_date = null;
        $this->start_date = null;
        $this->end_date = null;
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
        } // if ($deep)

        $this->aCrmAccount = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FinCreditCardTableMap::DEFAULT_STRING_FORMAT);
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
