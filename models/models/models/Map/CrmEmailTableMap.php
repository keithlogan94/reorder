<?php

namespace models\models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use models\models\CrmEmail;
use models\models\CrmEmailQuery;


/**
 * This class defines the structure of the 'crm_email' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CrmEmailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.CrmEmailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'crm_email';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\CrmEmail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.CrmEmail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the crm_email_id field
     */
    const COL_CRM_EMAIL_ID = 'crm_email.crm_email_id';

    /**
     * the column name for the crm_account_id field
     */
    const COL_CRM_ACCOUNT_ID = 'crm_email.crm_account_id';

    /**
     * the column name for the email_address field
     */
    const COL_EMAIL_ADDRESS = 'crm_email.email_address';

    /**
     * the column name for the verified field
     */
    const COL_VERIFIED = 'crm_email.verified';

    /**
     * the column name for the start_date field
     */
    const COL_START_DATE = 'crm_email.start_date';

    /**
     * the column name for the end_date field
     */
    const COL_END_DATE = 'crm_email.end_date';

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
        self::TYPE_PHPNAME       => array('CrmEmailId', 'CrmAccountId', 'EmailAddress', 'Verified', 'StartDate', 'EndDate', ),
        self::TYPE_CAMELNAME     => array('crmEmailId', 'crmAccountId', 'emailAddress', 'verified', 'startDate', 'endDate', ),
        self::TYPE_COLNAME       => array(CrmEmailTableMap::COL_CRM_EMAIL_ID, CrmEmailTableMap::COL_CRM_ACCOUNT_ID, CrmEmailTableMap::COL_EMAIL_ADDRESS, CrmEmailTableMap::COL_VERIFIED, CrmEmailTableMap::COL_START_DATE, CrmEmailTableMap::COL_END_DATE, ),
        self::TYPE_FIELDNAME     => array('crm_email_id', 'crm_account_id', 'email_address', 'verified', 'start_date', 'end_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CrmEmailId' => 0, 'CrmAccountId' => 1, 'EmailAddress' => 2, 'Verified' => 3, 'StartDate' => 4, 'EndDate' => 5, ),
        self::TYPE_CAMELNAME     => array('crmEmailId' => 0, 'crmAccountId' => 1, 'emailAddress' => 2, 'verified' => 3, 'startDate' => 4, 'endDate' => 5, ),
        self::TYPE_COLNAME       => array(CrmEmailTableMap::COL_CRM_EMAIL_ID => 0, CrmEmailTableMap::COL_CRM_ACCOUNT_ID => 1, CrmEmailTableMap::COL_EMAIL_ADDRESS => 2, CrmEmailTableMap::COL_VERIFIED => 3, CrmEmailTableMap::COL_START_DATE => 4, CrmEmailTableMap::COL_END_DATE => 5, ),
        self::TYPE_FIELDNAME     => array('crm_email_id' => 0, 'crm_account_id' => 1, 'email_address' => 2, 'verified' => 3, 'start_date' => 4, 'end_date' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('crm_email');
        $this->setPhpName('CrmEmail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\CrmEmail');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('crm_email_id', 'CrmEmailId', 'INTEGER', true, null, null);
        $this->addForeignKey('crm_account_id', 'CrmAccountId', 'INTEGER', 'crm_account', 'crm_account_id', true, null, null);
        $this->addColumn('email_address', 'EmailAddress', 'VARCHAR', true, 250, null);
        $this->addColumn('verified', 'Verified', 'BOOLEAN', true, 1, false);
        $this->addColumn('start_date', 'StartDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('end_date', 'EndDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CrmAccount', '\\models\\models\\CrmAccount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, null, false);
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
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CrmEmailId', TableMap::TYPE_PHPNAME, $indexType)
        ];
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
        return $withPrefix ? CrmEmailTableMap::CLASS_DEFAULT : CrmEmailTableMap::OM_CLASS;
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
     * @return array           (CrmEmail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CrmEmailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CrmEmailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CrmEmailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CrmEmailTableMap::OM_CLASS;
            /** @var CrmEmail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CrmEmailTableMap::addInstanceToPool($obj, $key);
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
            $key = CrmEmailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CrmEmailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CrmEmail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CrmEmailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CrmEmailTableMap::COL_CRM_EMAIL_ID);
            $criteria->addSelectColumn(CrmEmailTableMap::COL_CRM_ACCOUNT_ID);
            $criteria->addSelectColumn(CrmEmailTableMap::COL_EMAIL_ADDRESS);
            $criteria->addSelectColumn(CrmEmailTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(CrmEmailTableMap::COL_START_DATE);
            $criteria->addSelectColumn(CrmEmailTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.crm_email_id');
            $criteria->addSelectColumn($alias . '.crm_account_id');
            $criteria->addSelectColumn($alias . '.email_address');
            $criteria->addSelectColumn($alias . '.verified');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(CrmEmailTableMap::DATABASE_NAME)->getTable(CrmEmailTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CrmEmailTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CrmEmailTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CrmEmailTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CrmEmail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CrmEmail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmEmailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\CrmEmail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CrmEmailTableMap::DATABASE_NAME);
            $criteria->add(CrmEmailTableMap::COL_CRM_EMAIL_ID, (array) $values, Criteria::IN);
        }

        $query = CrmEmailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CrmEmailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CrmEmailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the crm_email table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CrmEmailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CrmEmail or Criteria object.
     *
     * @param mixed               $criteria Criteria or CrmEmail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmEmailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CrmEmail object
        }

        if ($criteria->containsKey(CrmEmailTableMap::COL_CRM_EMAIL_ID) && $criteria->keyContainsValue(CrmEmailTableMap::COL_CRM_EMAIL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CrmEmailTableMap::COL_CRM_EMAIL_ID.')');
        }


        // Set the correct dbName
        $query = CrmEmailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CrmEmailTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CrmEmailTableMap::buildTableMap();
