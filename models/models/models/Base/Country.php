<?php

namespace models\models\Base;

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
use models\models\CountryQuery as ChildCountryQuery;
use models\models\Map\CountryTableMap;

/**
 * Base class that represents a row from the 'country' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class Country implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\CountryTableMap';


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
     * The value for the code field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $code;

    /**
     * The value for the name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $name;

    /**
     * The value for the continent field.
     *
     * Note: this column has a database default value of: 'Asia'
     * @var        string
     */
    protected $continent;

    /**
     * The value for the region field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $region;

    /**
     * The value for the surfacearea field.
     *
     * Note: this column has a database default value of: 0.0
     * @var        double
     */
    protected $surfacearea;

    /**
     * The value for the indepyear field.
     *
     * @var        int
     */
    protected $indepyear;

    /**
     * The value for the population field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $population;

    /**
     * The value for the lifeexpectancy field.
     *
     * @var        double
     */
    protected $lifeexpectancy;

    /**
     * The value for the gnp field.
     *
     * @var        double
     */
    protected $gnp;

    /**
     * The value for the gnpold field.
     *
     * @var        double
     */
    protected $gnpold;

    /**
     * The value for the localname field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $localname;

    /**
     * The value for the governmentform field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $governmentform;

    /**
     * The value for the headofstate field.
     *
     * @var        string
     */
    protected $headofstate;

    /**
     * The value for the capital field.
     *
     * @var        int
     */
    protected $capital;

    /**
     * The value for the code2 field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $code2;

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
        $this->code = '';
        $this->name = '';
        $this->continent = 'Asia';
        $this->region = '';
        $this->surfacearea = 0.0;
        $this->population = 0;
        $this->localname = '';
        $this->governmentform = '';
        $this->code2 = '';
    }

    /**
     * Initializes internal state of models\models\Base\Country object.
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
     * Compares this with another <code>Country</code> instance.  If
     * <code>obj</code> is an instance of <code>Country</code>, delegates to
     * <code>equals(Country)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Country The current object, for fluid interface
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
     * Get the [code] column value.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [continent] column value.
     *
     * @return string
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Get the [region] column value.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Get the [surfacearea] column value.
     *
     * @return double
     */
    public function getSurfacearea()
    {
        return $this->surfacearea;
    }

    /**
     * Get the [indepyear] column value.
     *
     * @return int
     */
    public function getIndepyear()
    {
        return $this->indepyear;
    }

    /**
     * Get the [population] column value.
     *
     * @return int
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Get the [lifeexpectancy] column value.
     *
     * @return double
     */
    public function getLifeexpectancy()
    {
        return $this->lifeexpectancy;
    }

    /**
     * Get the [gnp] column value.
     *
     * @return double
     */
    public function getGnp()
    {
        return $this->gnp;
    }

    /**
     * Get the [gnpold] column value.
     *
     * @return double
     */
    public function getGnpold()
    {
        return $this->gnpold;
    }

    /**
     * Get the [localname] column value.
     *
     * @return string
     */
    public function getLocalname()
    {
        return $this->localname;
    }

    /**
     * Get the [governmentform] column value.
     *
     * @return string
     */
    public function getGovernmentform()
    {
        return $this->governmentform;
    }

    /**
     * Get the [headofstate] column value.
     *
     * @return string
     */
    public function getHeadofstate()
    {
        return $this->headofstate;
    }

    /**
     * Get the [capital] column value.
     *
     * @return int
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Get the [code2] column value.
     *
     * @return string
     */
    public function getCode2()
    {
        return $this->code2;
    }

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[CountryTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CountryTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [continent] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setContinent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->continent !== $v) {
            $this->continent = $v;
            $this->modifiedColumns[CountryTableMap::COL_CONTINENT] = true;
        }

        return $this;
    } // setContinent()

    /**
     * Set the value of [region] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->region !== $v) {
            $this->region = $v;
            $this->modifiedColumns[CountryTableMap::COL_REGION] = true;
        }

        return $this;
    } // setRegion()

    /**
     * Set the value of [surfacearea] column.
     *
     * @param double $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setSurfacearea($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->surfacearea !== $v) {
            $this->surfacearea = $v;
            $this->modifiedColumns[CountryTableMap::COL_SURFACEAREA] = true;
        }

        return $this;
    } // setSurfacearea()

    /**
     * Set the value of [indepyear] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setIndepyear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->indepyear !== $v) {
            $this->indepyear = $v;
            $this->modifiedColumns[CountryTableMap::COL_INDEPYEAR] = true;
        }

        return $this;
    } // setIndepyear()

    /**
     * Set the value of [population] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setPopulation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->population !== $v) {
            $this->population = $v;
            $this->modifiedColumns[CountryTableMap::COL_POPULATION] = true;
        }

        return $this;
    } // setPopulation()

    /**
     * Set the value of [lifeexpectancy] column.
     *
     * @param double $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setLifeexpectancy($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->lifeexpectancy !== $v) {
            $this->lifeexpectancy = $v;
            $this->modifiedColumns[CountryTableMap::COL_LIFEEXPECTANCY] = true;
        }

        return $this;
    } // setLifeexpectancy()

    /**
     * Set the value of [gnp] column.
     *
     * @param double $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setGnp($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->gnp !== $v) {
            $this->gnp = $v;
            $this->modifiedColumns[CountryTableMap::COL_GNP] = true;
        }

        return $this;
    } // setGnp()

    /**
     * Set the value of [gnpold] column.
     *
     * @param double $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setGnpold($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->gnpold !== $v) {
            $this->gnpold = $v;
            $this->modifiedColumns[CountryTableMap::COL_GNPOLD] = true;
        }

        return $this;
    } // setGnpold()

    /**
     * Set the value of [localname] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setLocalname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->localname !== $v) {
            $this->localname = $v;
            $this->modifiedColumns[CountryTableMap::COL_LOCALNAME] = true;
        }

        return $this;
    } // setLocalname()

    /**
     * Set the value of [governmentform] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setGovernmentform($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->governmentform !== $v) {
            $this->governmentform = $v;
            $this->modifiedColumns[CountryTableMap::COL_GOVERNMENTFORM] = true;
        }

        return $this;
    } // setGovernmentform()

    /**
     * Set the value of [headofstate] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setHeadofstate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->headofstate !== $v) {
            $this->headofstate = $v;
            $this->modifiedColumns[CountryTableMap::COL_HEADOFSTATE] = true;
        }

        return $this;
    } // setHeadofstate()

    /**
     * Set the value of [capital] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setCapital($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->capital !== $v) {
            $this->capital = $v;
            $this->modifiedColumns[CountryTableMap::COL_CAPITAL] = true;
        }

        return $this;
    } // setCapital()

    /**
     * Set the value of [code2] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Country The current object (for fluent API support)
     */
    public function setCode2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code2 !== $v) {
            $this->code2 = $v;
            $this->modifiedColumns[CountryTableMap::COL_CODE2] = true;
        }

        return $this;
    } // setCode2()

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
            if ($this->code !== '') {
                return false;
            }

            if ($this->name !== '') {
                return false;
            }

            if ($this->continent !== 'Asia') {
                return false;
            }

            if ($this->region !== '') {
                return false;
            }

            if ($this->surfacearea !== 0.0) {
                return false;
            }

            if ($this->population !== 0) {
                return false;
            }

            if ($this->localname !== '') {
                return false;
            }

            if ($this->governmentform !== '') {
                return false;
            }

            if ($this->code2 !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CountryTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CountryTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CountryTableMap::translateFieldName('Continent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->continent = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CountryTableMap::translateFieldName('Region', TableMap::TYPE_PHPNAME, $indexType)];
            $this->region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CountryTableMap::translateFieldName('Surfacearea', TableMap::TYPE_PHPNAME, $indexType)];
            $this->surfacearea = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CountryTableMap::translateFieldName('Indepyear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->indepyear = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CountryTableMap::translateFieldName('Population', TableMap::TYPE_PHPNAME, $indexType)];
            $this->population = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CountryTableMap::translateFieldName('Lifeexpectancy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lifeexpectancy = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CountryTableMap::translateFieldName('Gnp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gnp = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CountryTableMap::translateFieldName('Gnpold', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gnpold = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CountryTableMap::translateFieldName('Localname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->localname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CountryTableMap::translateFieldName('Governmentform', TableMap::TYPE_PHPNAME, $indexType)];
            $this->governmentform = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CountryTableMap::translateFieldName('Headofstate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->headofstate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CountryTableMap::translateFieldName('Capital', TableMap::TYPE_PHPNAME, $indexType)];
            $this->capital = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CountryTableMap::translateFieldName('Code2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code2 = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = CountryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\Country'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CountryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCountryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Country::setDeleted()
     * @see Country::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCountryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
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
                CountryTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CountryTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'Code';
        }
        if ($this->isColumnModified(CountryTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'Name';
        }
        if ($this->isColumnModified(CountryTableMap::COL_CONTINENT)) {
            $modifiedColumns[':p' . $index++]  = 'Continent';
        }
        if ($this->isColumnModified(CountryTableMap::COL_REGION)) {
            $modifiedColumns[':p' . $index++]  = 'Region';
        }
        if ($this->isColumnModified(CountryTableMap::COL_SURFACEAREA)) {
            $modifiedColumns[':p' . $index++]  = 'SurfaceArea';
        }
        if ($this->isColumnModified(CountryTableMap::COL_INDEPYEAR)) {
            $modifiedColumns[':p' . $index++]  = 'IndepYear';
        }
        if ($this->isColumnModified(CountryTableMap::COL_POPULATION)) {
            $modifiedColumns[':p' . $index++]  = 'Population';
        }
        if ($this->isColumnModified(CountryTableMap::COL_LIFEEXPECTANCY)) {
            $modifiedColumns[':p' . $index++]  = 'LifeExpectancy';
        }
        if ($this->isColumnModified(CountryTableMap::COL_GNP)) {
            $modifiedColumns[':p' . $index++]  = 'GNP';
        }
        if ($this->isColumnModified(CountryTableMap::COL_GNPOLD)) {
            $modifiedColumns[':p' . $index++]  = 'GNPOld';
        }
        if ($this->isColumnModified(CountryTableMap::COL_LOCALNAME)) {
            $modifiedColumns[':p' . $index++]  = 'LocalName';
        }
        if ($this->isColumnModified(CountryTableMap::COL_GOVERNMENTFORM)) {
            $modifiedColumns[':p' . $index++]  = 'GovernmentForm';
        }
        if ($this->isColumnModified(CountryTableMap::COL_HEADOFSTATE)) {
            $modifiedColumns[':p' . $index++]  = 'HeadOfState';
        }
        if ($this->isColumnModified(CountryTableMap::COL_CAPITAL)) {
            $modifiedColumns[':p' . $index++]  = 'Capital';
        }
        if ($this->isColumnModified(CountryTableMap::COL_CODE2)) {
            $modifiedColumns[':p' . $index++]  = 'Code2';
        }

        $sql = sprintf(
            'INSERT INTO country (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'Code':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
                        break;
                    case 'Name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'Continent':
                        $stmt->bindValue($identifier, $this->continent, PDO::PARAM_STR);
                        break;
                    case 'Region':
                        $stmt->bindValue($identifier, $this->region, PDO::PARAM_STR);
                        break;
                    case 'SurfaceArea':
                        $stmt->bindValue($identifier, $this->surfacearea, PDO::PARAM_STR);
                        break;
                    case 'IndepYear':
                        $stmt->bindValue($identifier, $this->indepyear, PDO::PARAM_INT);
                        break;
                    case 'Population':
                        $stmt->bindValue($identifier, $this->population, PDO::PARAM_INT);
                        break;
                    case 'LifeExpectancy':
                        $stmt->bindValue($identifier, $this->lifeexpectancy, PDO::PARAM_STR);
                        break;
                    case 'GNP':
                        $stmt->bindValue($identifier, $this->gnp, PDO::PARAM_STR);
                        break;
                    case 'GNPOld':
                        $stmt->bindValue($identifier, $this->gnpold, PDO::PARAM_STR);
                        break;
                    case 'LocalName':
                        $stmt->bindValue($identifier, $this->localname, PDO::PARAM_STR);
                        break;
                    case 'GovernmentForm':
                        $stmt->bindValue($identifier, $this->governmentform, PDO::PARAM_STR);
                        break;
                    case 'HeadOfState':
                        $stmt->bindValue($identifier, $this->headofstate, PDO::PARAM_STR);
                        break;
                    case 'Capital':
                        $stmt->bindValue($identifier, $this->capital, PDO::PARAM_INT);
                        break;
                    case 'Code2':
                        $stmt->bindValue($identifier, $this->code2, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = CountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCode();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getContinent();
                break;
            case 3:
                return $this->getRegion();
                break;
            case 4:
                return $this->getSurfacearea();
                break;
            case 5:
                return $this->getIndepyear();
                break;
            case 6:
                return $this->getPopulation();
                break;
            case 7:
                return $this->getLifeexpectancy();
                break;
            case 8:
                return $this->getGnp();
                break;
            case 9:
                return $this->getGnpold();
                break;
            case 10:
                return $this->getLocalname();
                break;
            case 11:
                return $this->getGovernmentform();
                break;
            case 12:
                return $this->getHeadofstate();
                break;
            case 13:
                return $this->getCapital();
                break;
            case 14:
                return $this->getCode2();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Country'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Country'][$this->hashCode()] = true;
        $keys = CountryTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCode(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getContinent(),
            $keys[3] => $this->getRegion(),
            $keys[4] => $this->getSurfacearea(),
            $keys[5] => $this->getIndepyear(),
            $keys[6] => $this->getPopulation(),
            $keys[7] => $this->getLifeexpectancy(),
            $keys[8] => $this->getGnp(),
            $keys[9] => $this->getGnpold(),
            $keys[10] => $this->getLocalname(),
            $keys[11] => $this->getGovernmentform(),
            $keys[12] => $this->getHeadofstate(),
            $keys[13] => $this->getCapital(),
            $keys[14] => $this->getCode2(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\models\models\Country
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\Country
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCode($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setContinent($value);
                break;
            case 3:
                $this->setRegion($value);
                break;
            case 4:
                $this->setSurfacearea($value);
                break;
            case 5:
                $this->setIndepyear($value);
                break;
            case 6:
                $this->setPopulation($value);
                break;
            case 7:
                $this->setLifeexpectancy($value);
                break;
            case 8:
                $this->setGnp($value);
                break;
            case 9:
                $this->setGnpold($value);
                break;
            case 10:
                $this->setLocalname($value);
                break;
            case 11:
                $this->setGovernmentform($value);
                break;
            case 12:
                $this->setHeadofstate($value);
                break;
            case 13:
                $this->setCapital($value);
                break;
            case 14:
                $this->setCode2($value);
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
        $keys = CountryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCode($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setContinent($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRegion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSurfacearea($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIndepyear($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPopulation($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLifeexpectancy($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setGnp($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setGnpold($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLocalname($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setGovernmentform($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHeadofstate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCapital($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCode2($arr[$keys[14]]);
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
     * @return $this|\models\models\Country The current object, for fluid interface
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
        $criteria = new Criteria(CountryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CountryTableMap::COL_CODE)) {
            $criteria->add(CountryTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(CountryTableMap::COL_NAME)) {
            $criteria->add(CountryTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CountryTableMap::COL_CONTINENT)) {
            $criteria->add(CountryTableMap::COL_CONTINENT, $this->continent);
        }
        if ($this->isColumnModified(CountryTableMap::COL_REGION)) {
            $criteria->add(CountryTableMap::COL_REGION, $this->region);
        }
        if ($this->isColumnModified(CountryTableMap::COL_SURFACEAREA)) {
            $criteria->add(CountryTableMap::COL_SURFACEAREA, $this->surfacearea);
        }
        if ($this->isColumnModified(CountryTableMap::COL_INDEPYEAR)) {
            $criteria->add(CountryTableMap::COL_INDEPYEAR, $this->indepyear);
        }
        if ($this->isColumnModified(CountryTableMap::COL_POPULATION)) {
            $criteria->add(CountryTableMap::COL_POPULATION, $this->population);
        }
        if ($this->isColumnModified(CountryTableMap::COL_LIFEEXPECTANCY)) {
            $criteria->add(CountryTableMap::COL_LIFEEXPECTANCY, $this->lifeexpectancy);
        }
        if ($this->isColumnModified(CountryTableMap::COL_GNP)) {
            $criteria->add(CountryTableMap::COL_GNP, $this->gnp);
        }
        if ($this->isColumnModified(CountryTableMap::COL_GNPOLD)) {
            $criteria->add(CountryTableMap::COL_GNPOLD, $this->gnpold);
        }
        if ($this->isColumnModified(CountryTableMap::COL_LOCALNAME)) {
            $criteria->add(CountryTableMap::COL_LOCALNAME, $this->localname);
        }
        if ($this->isColumnModified(CountryTableMap::COL_GOVERNMENTFORM)) {
            $criteria->add(CountryTableMap::COL_GOVERNMENTFORM, $this->governmentform);
        }
        if ($this->isColumnModified(CountryTableMap::COL_HEADOFSTATE)) {
            $criteria->add(CountryTableMap::COL_HEADOFSTATE, $this->headofstate);
        }
        if ($this->isColumnModified(CountryTableMap::COL_CAPITAL)) {
            $criteria->add(CountryTableMap::COL_CAPITAL, $this->capital);
        }
        if ($this->isColumnModified(CountryTableMap::COL_CODE2)) {
            $criteria->add(CountryTableMap::COL_CODE2, $this->code2);
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
        throw new LogicException('The Country object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Dummy primary key setter.
     *
     * This function only exists to preserve backwards compatibility.  It is no longer
     * needed or required by the Persistent interface.  It will be removed in next BC-breaking
     * release of Propel.
     *
     * @deprecated
     */
    public function setPrimaryKey($pk)
    {
        // do nothing, because this object doesn't have any primary keys
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return ;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\Country (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());
        $copyObj->setName($this->getName());
        $copyObj->setContinent($this->getContinent());
        $copyObj->setRegion($this->getRegion());
        $copyObj->setSurfacearea($this->getSurfacearea());
        $copyObj->setIndepyear($this->getIndepyear());
        $copyObj->setPopulation($this->getPopulation());
        $copyObj->setLifeexpectancy($this->getLifeexpectancy());
        $copyObj->setGnp($this->getGnp());
        $copyObj->setGnpold($this->getGnpold());
        $copyObj->setLocalname($this->getLocalname());
        $copyObj->setGovernmentform($this->getGovernmentform());
        $copyObj->setHeadofstate($this->getHeadofstate());
        $copyObj->setCapital($this->getCapital());
        $copyObj->setCode2($this->getCode2());
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
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \models\models\Country Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->code = null;
        $this->name = null;
        $this->continent = null;
        $this->region = null;
        $this->surfacearea = null;
        $this->indepyear = null;
        $this->population = null;
        $this->lifeexpectancy = null;
        $this->gnp = null;
        $this->gnpold = null;
        $this->localname = null;
        $this->governmentform = null;
        $this->headofstate = null;
        $this->capital = null;
        $this->code2 = null;
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

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CountryTableMap::DEFAULT_STRING_FORMAT);
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