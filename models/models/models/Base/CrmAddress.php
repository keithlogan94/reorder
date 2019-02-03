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
use models\models\CrmAddressQuery as ChildCrmAddressQuery;
use models\models\Map\CrmAddressTableMap;

/**
 * Base class that represents a row from the 'crm_address' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class CrmAddress implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\CrmAddressTableMap';


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
     * The value for the crm_address_id field.
     *
     * @var        int
     */
    protected $crm_address_id;

    /**
     * The value for the crm_account_id field.
     *
     * @var        int
     */
    protected $crm_account_id;

    /**
     * The value for the street1 field.
     *
     * @var        string
     */
    protected $street1;

    /**
     * The value for the street2 field.
     *
     * @var        string
     */
    protected $street2;

    /**
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * The value for the state field.
     *
     * @var        string
     */
    protected $state;

    /**
     * The value for the zip field.
     *
     * @var        string
     */
    protected $zip;

    /**
     * The value for the country field.
     *
     * @var        string
     */
    protected $country;

    /**
     * The value for the is_billing field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_billing;

    /**
     * The value for the billing_first_name field.
     *
     * @var        string
     */
    protected $billing_first_name;

    /**
     * The value for the billing_last_name field.
     *
     * @var        string
     */
    protected $billing_last_name;

    /**
     * The value for the is_shipping field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_shipping;

    /**
     * The value for the shipping_first_name field.
     *
     * @var        string
     */
    protected $shipping_first_name;

    /**
     * The value for the shipping_last_name field.
     *
     * @var        string
     */
    protected $shipping_last_name;

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
    protected $aCrmAccountRelatedByCrmAccountId;

    /**
     * @var        ChildCrmAccount
     */
    protected $aCrmAccountRelatedByCrmAddressId;

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
        $this->is_billing = false;
        $this->is_shipping = false;
    }

    /**
     * Initializes internal state of models\models\Base\CrmAddress object.
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
     * Compares this with another <code>CrmAddress</code> instance.  If
     * <code>obj</code> is an instance of <code>CrmAddress</code>, delegates to
     * <code>equals(CrmAddress)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|CrmAddress The current object, for fluid interface
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
     * Get the [crm_address_id] column value.
     *
     * @return int
     */
    public function getCrmAddressId()
    {
        return $this->crm_address_id;
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
     * Get the [street1] column value.
     *
     * @return string
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * Get the [street2] column value.
     *
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [state] column value.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the [zip] column value.
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [is_billing] column value.
     *
     * @return boolean
     */
    public function getIsBilling()
    {
        return $this->is_billing;
    }

    /**
     * Get the [is_billing] column value.
     *
     * @return boolean
     */
    public function isBilling()
    {
        return $this->getIsBilling();
    }

    /**
     * Get the [billing_first_name] column value.
     *
     * @return string
     */
    public function getBillingFirstName()
    {
        return $this->billing_first_name;
    }

    /**
     * Get the [billing_last_name] column value.
     *
     * @return string
     */
    public function getBillingLastName()
    {
        return $this->billing_last_name;
    }

    /**
     * Get the [is_shipping] column value.
     *
     * @return boolean
     */
    public function getIsShipping()
    {
        return $this->is_shipping;
    }

    /**
     * Get the [is_shipping] column value.
     *
     * @return boolean
     */
    public function isShipping()
    {
        return $this->getIsShipping();
    }

    /**
     * Get the [shipping_first_name] column value.
     *
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->shipping_first_name;
    }

    /**
     * Get the [shipping_last_name] column value.
     *
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->shipping_last_name;
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
     * Set the value of [crm_address_id] column.
     *
     * @param int $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setCrmAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->crm_address_id !== $v) {
            $this->crm_address_id = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_CRM_ADDRESS_ID] = true;
        }

        if ($this->aCrmAccountRelatedByCrmAddressId !== null && $this->aCrmAccountRelatedByCrmAddressId->getCrmAccountId() !== $v) {
            $this->aCrmAccountRelatedByCrmAddressId = null;
        }

        return $this;
    } // setCrmAddressId()

    /**
     * Set the value of [crm_account_id] column.
     *
     * @param int $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setCrmAccountId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->crm_account_id !== $v) {
            $this->crm_account_id = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_CRM_ACCOUNT_ID] = true;
        }

        if ($this->aCrmAccountRelatedByCrmAccountId !== null && $this->aCrmAccountRelatedByCrmAccountId->getCrmAccountId() !== $v) {
            $this->aCrmAccountRelatedByCrmAccountId = null;
        }

        return $this;
    } // setCrmAccountId()

    /**
     * Set the value of [street1] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setStreet1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->street1 !== $v) {
            $this->street1 = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_STREET1] = true;
        }

        return $this;
    } // setStreet1()

    /**
     * Set the value of [street2] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setStreet2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->street2 !== $v) {
            $this->street2 = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_STREET2] = true;
        }

        return $this;
    } // setStreet2()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [state] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Set the value of [zip] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip !== $v) {
            $this->zip = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_ZIP] = true;
        }

        return $this;
    } // setZip()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Sets the value of the [is_billing] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setIsBilling($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_billing !== $v) {
            $this->is_billing = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_IS_BILLING] = true;
        }

        return $this;
    } // setIsBilling()

    /**
     * Set the value of [billing_first_name] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setBillingFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_first_name !== $v) {
            $this->billing_first_name = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_BILLING_FIRST_NAME] = true;
        }

        return $this;
    } // setBillingFirstName()

    /**
     * Set the value of [billing_last_name] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setBillingLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->billing_last_name !== $v) {
            $this->billing_last_name = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_BILLING_LAST_NAME] = true;
        }

        return $this;
    } // setBillingLastName()

    /**
     * Sets the value of the [is_shipping] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setIsShipping($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_shipping !== $v) {
            $this->is_shipping = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_IS_SHIPPING] = true;
        }

        return $this;
    } // setIsShipping()

    /**
     * Set the value of [shipping_first_name] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setShippingFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_first_name !== $v) {
            $this->shipping_first_name = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_SHIPPING_FIRST_NAME] = true;
        }

        return $this;
    } // setShippingFirstName()

    /**
     * Set the value of [shipping_last_name] column.
     *
     * @param string $v new value
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setShippingLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_last_name !== $v) {
            $this->shipping_last_name = $v;
            $this->modifiedColumns[CrmAddressTableMap::COL_SHIPPING_LAST_NAME] = true;
        }

        return $this;
    } // setShippingLastName()

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            if ($this->start_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_date->format("Y-m-d H:i:s.u")) {
                $this->start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CrmAddressTableMap::COL_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setStartDate()

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($this->end_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->end_date->format("Y-m-d H:i:s.u")) {
                $this->end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CrmAddressTableMap::COL_END_DATE] = true;
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
            if ($this->is_billing !== false) {
                return false;
            }

            if ($this->is_shipping !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CrmAddressTableMap::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->crm_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CrmAddressTableMap::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->crm_account_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CrmAddressTableMap::translateFieldName('Street1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->street1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CrmAddressTableMap::translateFieldName('Street2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->street2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CrmAddressTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CrmAddressTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CrmAddressTableMap::translateFieldName('Zip', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CrmAddressTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CrmAddressTableMap::translateFieldName('IsBilling', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_billing = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CrmAddressTableMap::translateFieldName('BillingFirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CrmAddressTableMap::translateFieldName('BillingLastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billing_last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CrmAddressTableMap::translateFieldName('IsShipping', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_shipping = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CrmAddressTableMap::translateFieldName('ShippingFirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CrmAddressTableMap::translateFieldName('ShippingLastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CrmAddressTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CrmAddressTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = CrmAddressTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\CrmAddress'), 0, $e);
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
        if ($this->aCrmAccountRelatedByCrmAddressId !== null && $this->crm_address_id !== $this->aCrmAccountRelatedByCrmAddressId->getCrmAccountId()) {
            $this->aCrmAccountRelatedByCrmAddressId = null;
        }
        if ($this->aCrmAccountRelatedByCrmAccountId !== null && $this->crm_account_id !== $this->aCrmAccountRelatedByCrmAccountId->getCrmAccountId()) {
            $this->aCrmAccountRelatedByCrmAccountId = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCrmAddressQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCrmAccountRelatedByCrmAccountId = null;
            $this->aCrmAccountRelatedByCrmAddressId = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CrmAddress::setDeleted()
     * @see CrmAddress::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCrmAddressQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
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
                CrmAddressTableMap::addInstanceToPool($this);
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

            if ($this->aCrmAccountRelatedByCrmAccountId !== null) {
                if ($this->aCrmAccountRelatedByCrmAccountId->isModified() || $this->aCrmAccountRelatedByCrmAccountId->isNew()) {
                    $affectedRows += $this->aCrmAccountRelatedByCrmAccountId->save($con);
                }
                $this->setCrmAccountRelatedByCrmAccountId($this->aCrmAccountRelatedByCrmAccountId);
            }

            if ($this->aCrmAccountRelatedByCrmAddressId !== null) {
                if ($this->aCrmAccountRelatedByCrmAddressId->isModified() || $this->aCrmAccountRelatedByCrmAddressId->isNew()) {
                    $affectedRows += $this->aCrmAccountRelatedByCrmAddressId->save($con);
                }
                $this->setCrmAccountRelatedByCrmAddressId($this->aCrmAccountRelatedByCrmAddressId);
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

        $this->modifiedColumns[CrmAddressTableMap::COL_CRM_ADDRESS_ID] = true;
        if (null !== $this->crm_address_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CrmAddressTableMap::COL_CRM_ADDRESS_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CrmAddressTableMap::COL_CRM_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'crm_address_id';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_CRM_ACCOUNT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'crm_account_id';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STREET1)) {
            $modifiedColumns[':p' . $index++]  = 'street1';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STREET2)) {
            $modifiedColumns[':p' . $index++]  = 'street2';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_ZIP)) {
            $modifiedColumns[':p' . $index++]  = 'zip';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'country';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_IS_BILLING)) {
            $modifiedColumns[':p' . $index++]  = 'is_billing';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_BILLING_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'billing_first_name';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_BILLING_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'billing_last_name';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_IS_SHIPPING)) {
            $modifiedColumns[':p' . $index++]  = 'is_shipping';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_SHIPPING_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_first_name';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_SHIPPING_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_last_name';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }

        $sql = sprintf(
            'INSERT INTO crm_address (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'crm_address_id':
                        $stmt->bindValue($identifier, $this->crm_address_id, PDO::PARAM_INT);
                        break;
                    case 'crm_account_id':
                        $stmt->bindValue($identifier, $this->crm_account_id, PDO::PARAM_INT);
                        break;
                    case 'street1':
                        $stmt->bindValue($identifier, $this->street1, PDO::PARAM_STR);
                        break;
                    case 'street2':
                        $stmt->bindValue($identifier, $this->street2, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'state':
                        $stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
                        break;
                    case 'zip':
                        $stmt->bindValue($identifier, $this->zip, PDO::PARAM_STR);
                        break;
                    case 'country':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case 'is_billing':
                        $stmt->bindValue($identifier, (int) $this->is_billing, PDO::PARAM_INT);
                        break;
                    case 'billing_first_name':
                        $stmt->bindValue($identifier, $this->billing_first_name, PDO::PARAM_STR);
                        break;
                    case 'billing_last_name':
                        $stmt->bindValue($identifier, $this->billing_last_name, PDO::PARAM_STR);
                        break;
                    case 'is_shipping':
                        $stmt->bindValue($identifier, (int) $this->is_shipping, PDO::PARAM_INT);
                        break;
                    case 'shipping_first_name':
                        $stmt->bindValue($identifier, $this->shipping_first_name, PDO::PARAM_STR);
                        break;
                    case 'shipping_last_name':
                        $stmt->bindValue($identifier, $this->shipping_last_name, PDO::PARAM_STR);
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
        $this->setCrmAddressId($pk);

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
        $pos = CrmAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCrmAddressId();
                break;
            case 1:
                return $this->getCrmAccountId();
                break;
            case 2:
                return $this->getStreet1();
                break;
            case 3:
                return $this->getStreet2();
                break;
            case 4:
                return $this->getCity();
                break;
            case 5:
                return $this->getState();
                break;
            case 6:
                return $this->getZip();
                break;
            case 7:
                return $this->getCountry();
                break;
            case 8:
                return $this->getIsBilling();
                break;
            case 9:
                return $this->getBillingFirstName();
                break;
            case 10:
                return $this->getBillingLastName();
                break;
            case 11:
                return $this->getIsShipping();
                break;
            case 12:
                return $this->getShippingFirstName();
                break;
            case 13:
                return $this->getShippingLastName();
                break;
            case 14:
                return $this->getStartDate();
                break;
            case 15:
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

        if (isset($alreadyDumpedObjects['CrmAddress'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CrmAddress'][$this->hashCode()] = true;
        $keys = CrmAddressTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCrmAddressId(),
            $keys[1] => $this->getCrmAccountId(),
            $keys[2] => $this->getStreet1(),
            $keys[3] => $this->getStreet2(),
            $keys[4] => $this->getCity(),
            $keys[5] => $this->getState(),
            $keys[6] => $this->getZip(),
            $keys[7] => $this->getCountry(),
            $keys[8] => $this->getIsBilling(),
            $keys[9] => $this->getBillingFirstName(),
            $keys[10] => $this->getBillingLastName(),
            $keys[11] => $this->getIsShipping(),
            $keys[12] => $this->getShippingFirstName(),
            $keys[13] => $this->getShippingLastName(),
            $keys[14] => $this->getStartDate(),
            $keys[15] => $this->getEndDate(),
        );
        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCrmAccountRelatedByCrmAccountId) {

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

                $result[$key] = $this->aCrmAccountRelatedByCrmAccountId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCrmAccountRelatedByCrmAddressId) {

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

                $result[$key] = $this->aCrmAccountRelatedByCrmAddressId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\models\models\CrmAddress
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CrmAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\CrmAddress
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCrmAddressId($value);
                break;
            case 1:
                $this->setCrmAccountId($value);
                break;
            case 2:
                $this->setStreet1($value);
                break;
            case 3:
                $this->setStreet2($value);
                break;
            case 4:
                $this->setCity($value);
                break;
            case 5:
                $this->setState($value);
                break;
            case 6:
                $this->setZip($value);
                break;
            case 7:
                $this->setCountry($value);
                break;
            case 8:
                $this->setIsBilling($value);
                break;
            case 9:
                $this->setBillingFirstName($value);
                break;
            case 10:
                $this->setBillingLastName($value);
                break;
            case 11:
                $this->setIsShipping($value);
                break;
            case 12:
                $this->setShippingFirstName($value);
                break;
            case 13:
                $this->setShippingLastName($value);
                break;
            case 14:
                $this->setStartDate($value);
                break;
            case 15:
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
        $keys = CrmAddressTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCrmAddressId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCrmAccountId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStreet1($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStreet2($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCity($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setState($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setZip($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCountry($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsBilling($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setBillingFirstName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBillingLastName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsShipping($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setShippingFirstName($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setShippingLastName($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setStartDate($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setEndDate($arr[$keys[15]]);
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
     * @return $this|\models\models\CrmAddress The current object, for fluid interface
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
        $criteria = new Criteria(CrmAddressTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CrmAddressTableMap::COL_CRM_ADDRESS_ID)) {
            $criteria->add(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $this->crm_address_id);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_CRM_ACCOUNT_ID)) {
            $criteria->add(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $this->crm_account_id);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STREET1)) {
            $criteria->add(CrmAddressTableMap::COL_STREET1, $this->street1);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STREET2)) {
            $criteria->add(CrmAddressTableMap::COL_STREET2, $this->street2);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_CITY)) {
            $criteria->add(CrmAddressTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_STATE)) {
            $criteria->add(CrmAddressTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_ZIP)) {
            $criteria->add(CrmAddressTableMap::COL_ZIP, $this->zip);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_COUNTRY)) {
            $criteria->add(CrmAddressTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_IS_BILLING)) {
            $criteria->add(CrmAddressTableMap::COL_IS_BILLING, $this->is_billing);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_BILLING_FIRST_NAME)) {
            $criteria->add(CrmAddressTableMap::COL_BILLING_FIRST_NAME, $this->billing_first_name);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_BILLING_LAST_NAME)) {
            $criteria->add(CrmAddressTableMap::COL_BILLING_LAST_NAME, $this->billing_last_name);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_IS_SHIPPING)) {
            $criteria->add(CrmAddressTableMap::COL_IS_SHIPPING, $this->is_shipping);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_SHIPPING_FIRST_NAME)) {
            $criteria->add(CrmAddressTableMap::COL_SHIPPING_FIRST_NAME, $this->shipping_first_name);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_SHIPPING_LAST_NAME)) {
            $criteria->add(CrmAddressTableMap::COL_SHIPPING_LAST_NAME, $this->shipping_last_name);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_START_DATE)) {
            $criteria->add(CrmAddressTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(CrmAddressTableMap::COL_END_DATE)) {
            $criteria->add(CrmAddressTableMap::COL_END_DATE, $this->end_date);
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
        $criteria = ChildCrmAddressQuery::create();
        $criteria->add(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $this->crm_address_id);

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
        $validPk = null !== $this->getCrmAddressId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation crm_address_ibfk_2 to table crm_account
        if ($this->aCrmAccountRelatedByCrmAddressId && $hash = spl_object_hash($this->aCrmAccountRelatedByCrmAddressId)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

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
        return $this->getCrmAddressId();
    }

    /**
     * Generic method to set the primary key (crm_address_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCrmAddressId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCrmAddressId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\CrmAddress (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCrmAccountId($this->getCrmAccountId());
        $copyObj->setStreet1($this->getStreet1());
        $copyObj->setStreet2($this->getStreet2());
        $copyObj->setCity($this->getCity());
        $copyObj->setState($this->getState());
        $copyObj->setZip($this->getZip());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setIsBilling($this->getIsBilling());
        $copyObj->setBillingFirstName($this->getBillingFirstName());
        $copyObj->setBillingLastName($this->getBillingLastName());
        $copyObj->setIsShipping($this->getIsShipping());
        $copyObj->setShippingFirstName($this->getShippingFirstName());
        $copyObj->setShippingLastName($this->getShippingLastName());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCrmAddressId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \models\models\CrmAddress Clone of current object.
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
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCrmAccountRelatedByCrmAccountId(ChildCrmAccount $v = null)
    {
        if ($v === null) {
            $this->setCrmAccountId(NULL);
        } else {
            $this->setCrmAccountId($v->getCrmAccountId());
        }

        $this->aCrmAccountRelatedByCrmAccountId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCrmAccount object, it will not be re-added.
        if ($v !== null) {
            $v->addCrmAddressRelatedByCrmAccountId($this);
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
    public function getCrmAccountRelatedByCrmAccountId(ConnectionInterface $con = null)
    {
        if ($this->aCrmAccountRelatedByCrmAccountId === null && ($this->crm_account_id != 0)) {
            $this->aCrmAccountRelatedByCrmAccountId = ChildCrmAccountQuery::create()->findPk($this->crm_account_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCrmAccountRelatedByCrmAccountId->addCrmAddressesRelatedByCrmAccountId($this);
             */
        }

        return $this->aCrmAccountRelatedByCrmAccountId;
    }

    /**
     * Declares an association between this object and a ChildCrmAccount object.
     *
     * @param  ChildCrmAccount $v
     * @return $this|\models\models\CrmAddress The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCrmAccountRelatedByCrmAddressId(ChildCrmAccount $v = null)
    {
        if ($v === null) {
            $this->setCrmAddressId(NULL);
        } else {
            $this->setCrmAddressId($v->getCrmAccountId());
        }

        $this->aCrmAccountRelatedByCrmAddressId = $v;

        // Add binding for other direction of this 1:1 relationship.
        if ($v !== null) {
            $v->setCrmAddressRelatedByCrmAddressId($this);
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
    public function getCrmAccountRelatedByCrmAddressId(ConnectionInterface $con = null)
    {
        if ($this->aCrmAccountRelatedByCrmAddressId === null && ($this->crm_address_id != 0)) {
            $this->aCrmAccountRelatedByCrmAddressId = ChildCrmAccountQuery::create()->findPk($this->crm_address_id, $con);
            // Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
            $this->aCrmAccountRelatedByCrmAddressId->setCrmAddressRelatedByCrmAddressId($this);
        }

        return $this->aCrmAccountRelatedByCrmAddressId;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCrmAccountRelatedByCrmAccountId) {
            $this->aCrmAccountRelatedByCrmAccountId->removeCrmAddressRelatedByCrmAccountId($this);
        }
        if (null !== $this->aCrmAccountRelatedByCrmAddressId) {
            $this->aCrmAccountRelatedByCrmAddressId->removeCrmAddressRelatedByCrmAddressId($this);
        }
        $this->crm_address_id = null;
        $this->crm_account_id = null;
        $this->street1 = null;
        $this->street2 = null;
        $this->city = null;
        $this->state = null;
        $this->zip = null;
        $this->country = null;
        $this->is_billing = null;
        $this->billing_first_name = null;
        $this->billing_last_name = null;
        $this->is_shipping = null;
        $this->shipping_first_name = null;
        $this->shipping_last_name = null;
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

        $this->aCrmAccountRelatedByCrmAccountId = null;
        $this->aCrmAccountRelatedByCrmAddressId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CrmAddressTableMap::DEFAULT_STRING_FORMAT);
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
