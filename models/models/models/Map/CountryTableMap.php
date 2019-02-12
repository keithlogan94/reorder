<?php

namespace models\models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use models\models\Country;
use models\models\CountryQuery;


/**
 * This class defines the structure of the 'country' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CountryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.CountryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'country';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\Country';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.Country';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the Code field
     */
    const COL_CODE = 'country.Code';

    /**
     * the column name for the Name field
     */
    const COL_NAME = 'country.Name';

    /**
     * the column name for the Continent field
     */
    const COL_CONTINENT = 'country.Continent';

    /**
     * the column name for the Region field
     */
    const COL_REGION = 'country.Region';

    /**
     * the column name for the SurfaceArea field
     */
    const COL_SURFACEAREA = 'country.SurfaceArea';

    /**
     * the column name for the IndepYear field
     */
    const COL_INDEPYEAR = 'country.IndepYear';

    /**
     * the column name for the Population field
     */
    const COL_POPULATION = 'country.Population';

    /**
     * the column name for the LifeExpectancy field
     */
    const COL_LIFEEXPECTANCY = 'country.LifeExpectancy';

    /**
     * the column name for the GNP field
     */
    const COL_GNP = 'country.GNP';

    /**
     * the column name for the GNPOld field
     */
    const COL_GNPOLD = 'country.GNPOld';

    /**
     * the column name for the LocalName field
     */
    const COL_LOCALNAME = 'country.LocalName';

    /**
     * the column name for the GovernmentForm field
     */
    const COL_GOVERNMENTFORM = 'country.GovernmentForm';

    /**
     * the column name for the HeadOfState field
     */
    const COL_HEADOFSTATE = 'country.HeadOfState';

    /**
     * the column name for the Capital field
     */
    const COL_CAPITAL = 'country.Capital';

    /**
     * the column name for the Code2 field
     */
    const COL_CODE2 = 'country.Code2';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Code', 'Name', 'Continent', 'Region', 'Surfacearea', 'Indepyear', 'Population', 'Lifeexpectancy', 'Gnp', 'Gnpold', 'Localname', 'Governmentform', 'Headofstate', 'Capital', 'Code2', ),
        self::TYPE_CAMELNAME     => array('code', 'name', 'continent', 'region', 'surfacearea', 'indepyear', 'population', 'lifeexpectancy', 'gnp', 'gnpold', 'localname', 'governmentform', 'headofstate', 'capital', 'code2', ),
        self::TYPE_COLNAME       => array(CountryTableMap::COL_CODE, CountryTableMap::COL_NAME, CountryTableMap::COL_CONTINENT, CountryTableMap::COL_REGION, CountryTableMap::COL_SURFACEAREA, CountryTableMap::COL_INDEPYEAR, CountryTableMap::COL_POPULATION, CountryTableMap::COL_LIFEEXPECTANCY, CountryTableMap::COL_GNP, CountryTableMap::COL_GNPOLD, CountryTableMap::COL_LOCALNAME, CountryTableMap::COL_GOVERNMENTFORM, CountryTableMap::COL_HEADOFSTATE, CountryTableMap::COL_CAPITAL, CountryTableMap::COL_CODE2, ),
        self::TYPE_FIELDNAME     => array('Code', 'Name', 'Continent', 'Region', 'SurfaceArea', 'IndepYear', 'Population', 'LifeExpectancy', 'GNP', 'GNPOld', 'LocalName', 'GovernmentForm', 'HeadOfState', 'Capital', 'Code2', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Code' => 0, 'Name' => 1, 'Continent' => 2, 'Region' => 3, 'Surfacearea' => 4, 'Indepyear' => 5, 'Population' => 6, 'Lifeexpectancy' => 7, 'Gnp' => 8, 'Gnpold' => 9, 'Localname' => 10, 'Governmentform' => 11, 'Headofstate' => 12, 'Capital' => 13, 'Code2' => 14, ),
        self::TYPE_CAMELNAME     => array('code' => 0, 'name' => 1, 'continent' => 2, 'region' => 3, 'surfacearea' => 4, 'indepyear' => 5, 'population' => 6, 'lifeexpectancy' => 7, 'gnp' => 8, 'gnpold' => 9, 'localname' => 10, 'governmentform' => 11, 'headofstate' => 12, 'capital' => 13, 'code2' => 14, ),
        self::TYPE_COLNAME       => array(CountryTableMap::COL_CODE => 0, CountryTableMap::COL_NAME => 1, CountryTableMap::COL_CONTINENT => 2, CountryTableMap::COL_REGION => 3, CountryTableMap::COL_SURFACEAREA => 4, CountryTableMap::COL_INDEPYEAR => 5, CountryTableMap::COL_POPULATION => 6, CountryTableMap::COL_LIFEEXPECTANCY => 7, CountryTableMap::COL_GNP => 8, CountryTableMap::COL_GNPOLD => 9, CountryTableMap::COL_LOCALNAME => 10, CountryTableMap::COL_GOVERNMENTFORM => 11, CountryTableMap::COL_HEADOFSTATE => 12, CountryTableMap::COL_CAPITAL => 13, CountryTableMap::COL_CODE2 => 14, ),
        self::TYPE_FIELDNAME     => array('Code' => 0, 'Name' => 1, 'Continent' => 2, 'Region' => 3, 'SurfaceArea' => 4, 'IndepYear' => 5, 'Population' => 6, 'LifeExpectancy' => 7, 'GNP' => 8, 'GNPOld' => 9, 'LocalName' => 10, 'GovernmentForm' => 11, 'HeadOfState' => 12, 'Capital' => 13, 'Code2' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('country');
        $this->setPhpName('Country');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\Country');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('Code', 'Code', 'CHAR', true, 3, '');
        $this->addColumn('Name', 'Name', 'CHAR', true, 52, '');
        $this->addColumn('Continent', 'Continent', 'CHAR', true, null, 'Asia');
        $this->addColumn('Region', 'Region', 'CHAR', true, 26, '');
        $this->addColumn('SurfaceArea', 'Surfacearea', 'FLOAT', true, 10, 0);
        $this->addColumn('IndepYear', 'Indepyear', 'SMALLINT', false, null, null);
        $this->addColumn('Population', 'Population', 'INTEGER', true, null, 0);
        $this->addColumn('LifeExpectancy', 'Lifeexpectancy', 'FLOAT', false, 3, null);
        $this->addColumn('GNP', 'Gnp', 'FLOAT', false, 10, null);
        $this->addColumn('GNPOld', 'Gnpold', 'FLOAT', false, 10, null);
        $this->addColumn('LocalName', 'Localname', 'CHAR', true, 45, '');
        $this->addColumn('GovernmentForm', 'Governmentform', 'CHAR', true, 45, '');
        $this->addColumn('HeadOfState', 'Headofstate', 'CHAR', false, 60, null);
        $this->addColumn('Capital', 'Capital', 'INTEGER', false, null, null);
        $this->addColumn('Code2', 'Code2', 'CHAR', true, 2, '');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return null;
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return '';
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CountryTableMap::CLASS_DEFAULT : CountryTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Country object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CountryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CountryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CountryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CountryTableMap::OM_CLASS;
            /** @var Country $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CountryTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CountryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CountryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Country $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CountryTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CountryTableMap::COL_CODE);
            $criteria->addSelectColumn(CountryTableMap::COL_NAME);
            $criteria->addSelectColumn(CountryTableMap::COL_CONTINENT);
            $criteria->addSelectColumn(CountryTableMap::COL_REGION);
            $criteria->addSelectColumn(CountryTableMap::COL_SURFACEAREA);
            $criteria->addSelectColumn(CountryTableMap::COL_INDEPYEAR);
            $criteria->addSelectColumn(CountryTableMap::COL_POPULATION);
            $criteria->addSelectColumn(CountryTableMap::COL_LIFEEXPECTANCY);
            $criteria->addSelectColumn(CountryTableMap::COL_GNP);
            $criteria->addSelectColumn(CountryTableMap::COL_GNPOLD);
            $criteria->addSelectColumn(CountryTableMap::COL_LOCALNAME);
            $criteria->addSelectColumn(CountryTableMap::COL_GOVERNMENTFORM);
            $criteria->addSelectColumn(CountryTableMap::COL_HEADOFSTATE);
            $criteria->addSelectColumn(CountryTableMap::COL_CAPITAL);
            $criteria->addSelectColumn(CountryTableMap::COL_CODE2);
        } else {
            $criteria->addSelectColumn($alias . '.Code');
            $criteria->addSelectColumn($alias . '.Name');
            $criteria->addSelectColumn($alias . '.Continent');
            $criteria->addSelectColumn($alias . '.Region');
            $criteria->addSelectColumn($alias . '.SurfaceArea');
            $criteria->addSelectColumn($alias . '.IndepYear');
            $criteria->addSelectColumn($alias . '.Population');
            $criteria->addSelectColumn($alias . '.LifeExpectancy');
            $criteria->addSelectColumn($alias . '.GNP');
            $criteria->addSelectColumn($alias . '.GNPOld');
            $criteria->addSelectColumn($alias . '.LocalName');
            $criteria->addSelectColumn($alias . '.GovernmentForm');
            $criteria->addSelectColumn($alias . '.HeadOfState');
            $criteria->addSelectColumn($alias . '.Capital');
            $criteria->addSelectColumn($alias . '.Code2');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CountryTableMap::DATABASE_NAME)->getTable(CountryTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CountryTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CountryTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CountryTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Country or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Country object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\Country) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The Country object has no primary key');
        }

        $query = CountryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CountryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CountryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CountryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Country or Criteria object.
     *
     * @param mixed               $criteria Criteria or Country object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Country object
        }


        // Set the correct dbName
        $query = CountryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CountryTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CountryTableMap::buildTableMap();
