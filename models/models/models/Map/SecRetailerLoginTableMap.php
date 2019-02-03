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
use models\models\SecRetailerLogin;
use models\models\SecRetailerLoginQuery;


/**
 * This class defines the structure of the 'sec_retailer_login' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SecRetailerLoginTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.SecRetailerLoginTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sec_retailer_login';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\SecRetailerLogin';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.SecRetailerLogin';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the sec_retailer_login_id field
     */
    const COL_SEC_RETAILER_LOGIN_ID = 'sec_retailer_login.sec_retailer_login_id';

    /**
     * the column name for the retailer field
     */
    const COL_RETAILER = 'sec_retailer_login.retailer';

    /**
     * the column name for the crm_account_id field
     */
    const COL_CRM_ACCOUNT_ID = 'sec_retailer_login.crm_account_id';

    /**
     * the column name for the login_email field
     */
    const COL_LOGIN_EMAIL = 'sec_retailer_login.login_email';

    /**
     * the column name for the login_password field
     */
    const COL_LOGIN_PASSWORD = 'sec_retailer_login.login_password';

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
        self::TYPE_PHPNAME       => array('SecRetailerLoginId', 'Retailer', 'CrmAccountId', 'LoginEmail', 'LoginPassword', ),
        self::TYPE_CAMELNAME     => array('secRetailerLoginId', 'retailer', 'crmAccountId', 'loginEmail', 'loginPassword', ),
        self::TYPE_COLNAME       => array(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, SecRetailerLoginTableMap::COL_RETAILER, SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, SecRetailerLoginTableMap::COL_LOGIN_EMAIL, SecRetailerLoginTableMap::COL_LOGIN_PASSWORD, ),
        self::TYPE_FIELDNAME     => array('sec_retailer_login_id', 'retailer', 'crm_account_id', 'login_email', 'login_password', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('SecRetailerLoginId' => 0, 'Retailer' => 1, 'CrmAccountId' => 2, 'LoginEmail' => 3, 'LoginPassword' => 4, ),
        self::TYPE_CAMELNAME     => array('secRetailerLoginId' => 0, 'retailer' => 1, 'crmAccountId' => 2, 'loginEmail' => 3, 'loginPassword' => 4, ),
        self::TYPE_COLNAME       => array(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID => 0, SecRetailerLoginTableMap::COL_RETAILER => 1, SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID => 2, SecRetailerLoginTableMap::COL_LOGIN_EMAIL => 3, SecRetailerLoginTableMap::COL_LOGIN_PASSWORD => 4, ),
        self::TYPE_FIELDNAME     => array('sec_retailer_login_id' => 0, 'retailer' => 1, 'crm_account_id' => 2, 'login_email' => 3, 'login_password' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('sec_retailer_login');
        $this->setPhpName('SecRetailerLogin');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\SecRetailerLogin');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('sec_retailer_login_id', 'SecRetailerLoginId', 'INTEGER', true, null, null);
        $this->addColumn('retailer', 'Retailer', 'CHAR', true, null, null);
        $this->addForeignKey('crm_account_id', 'CrmAccountId', 'INTEGER', 'crm_account', 'crm_account_id', true, null, null);
        $this->addColumn('login_email', 'LoginEmail', 'VARCHAR', true, 250, null);
        $this->addColumn('login_password', 'LoginPassword', 'VARCHAR', true, 100, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SecRetailerLoginId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SecRetailerLoginTableMap::CLASS_DEFAULT : SecRetailerLoginTableMap::OM_CLASS;
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
     * @return array           (SecRetailerLogin object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SecRetailerLoginTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SecRetailerLoginTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SecRetailerLoginTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SecRetailerLoginTableMap::OM_CLASS;
            /** @var SecRetailerLogin $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SecRetailerLoginTableMap::addInstanceToPool($obj, $key);
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
            $key = SecRetailerLoginTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SecRetailerLoginTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SecRetailerLogin $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SecRetailerLoginTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID);
            $criteria->addSelectColumn(SecRetailerLoginTableMap::COL_RETAILER);
            $criteria->addSelectColumn(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID);
            $criteria->addSelectColumn(SecRetailerLoginTableMap::COL_LOGIN_EMAIL);
            $criteria->addSelectColumn(SecRetailerLoginTableMap::COL_LOGIN_PASSWORD);
        } else {
            $criteria->addSelectColumn($alias . '.sec_retailer_login_id');
            $criteria->addSelectColumn($alias . '.retailer');
            $criteria->addSelectColumn($alias . '.crm_account_id');
            $criteria->addSelectColumn($alias . '.login_email');
            $criteria->addSelectColumn($alias . '.login_password');
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
        return Propel::getServiceContainer()->getDatabaseMap(SecRetailerLoginTableMap::DATABASE_NAME)->getTable(SecRetailerLoginTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SecRetailerLoginTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SecRetailerLoginTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SecRetailerLoginTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SecRetailerLogin or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SecRetailerLogin object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SecRetailerLoginTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\SecRetailerLogin) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SecRetailerLoginTableMap::DATABASE_NAME);
            $criteria->add(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, (array) $values, Criteria::IN);
        }

        $query = SecRetailerLoginQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SecRetailerLoginTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SecRetailerLoginTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sec_retailer_login table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SecRetailerLoginQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SecRetailerLogin or Criteria object.
     *
     * @param mixed               $criteria Criteria or SecRetailerLogin object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SecRetailerLoginTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SecRetailerLogin object
        }

        if ($criteria->containsKey(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID) && $criteria->keyContainsValue(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID.')');
        }


        // Set the correct dbName
        $query = SecRetailerLoginQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SecRetailerLoginTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SecRetailerLoginTableMap::buildTableMap();
