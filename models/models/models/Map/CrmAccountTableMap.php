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
use models\models\CrmAccount;
use models\models\CrmAccountQuery;


/**
 * This class defines the structure of the 'crm_account' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CrmAccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.CrmAccountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'crm_account';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\CrmAccount';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.CrmAccount';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the crm_account_id field
     */
    const COL_CRM_ACCOUNT_ID = 'crm_account.crm_account_id';

    /**
     * the column name for the add_time field
     */
    const COL_ADD_TIME = 'crm_account.add_time';

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
        self::TYPE_PHPNAME       => array('CrmAccountId', 'AddTime', ),
        self::TYPE_CAMELNAME     => array('crmAccountId', 'addTime', ),
        self::TYPE_COLNAME       => array(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, CrmAccountTableMap::COL_ADD_TIME, ),
        self::TYPE_FIELDNAME     => array('crm_account_id', 'add_time', ),
        self::TYPE_NUM           => array(0, 1, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CrmAccountId' => 0, 'AddTime' => 1, ),
        self::TYPE_CAMELNAME     => array('crmAccountId' => 0, 'addTime' => 1, ),
        self::TYPE_COLNAME       => array(CrmAccountTableMap::COL_CRM_ACCOUNT_ID => 0, CrmAccountTableMap::COL_ADD_TIME => 1, ),
        self::TYPE_FIELDNAME     => array('crm_account_id' => 0, 'add_time' => 1, ),
        self::TYPE_NUM           => array(0, 1, )
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
        $this->setName('crm_account');
        $this->setPhpName('CrmAccount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\CrmAccount');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('crm_account_id', 'CrmAccountId', 'INTEGER', true, null, null);
        $this->addColumn('add_time', 'AddTime', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CrmAddressRelatedByCrmAccountId', '\\models\\models\\CrmAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, 'CrmAddressesRelatedByCrmAccountId', false);
        $this->addRelation('CrmAddressRelatedByCrmAddressId', '\\models\\models\\CrmAddress', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':crm_address_id',
    1 => ':crm_account_id',
  ),
), null, null, null, false);
        $this->addRelation('CrmEmail', '\\models\\models\\CrmEmail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, 'CrmEmails', false);
        $this->addRelation('CrmPerson', '\\models\\models\\CrmPerson', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, 'Crmpeople', false);
        $this->addRelation('FinCreditCard', '\\models\\models\\FinCreditCard', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, 'FinCreditCards', false);
        $this->addRelation('SecRetailerLogin', '\\models\\models\\SecRetailerLogin', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, 'SecRetailerLogins', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CrmAccountId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CrmAccountTableMap::CLASS_DEFAULT : CrmAccountTableMap::OM_CLASS;
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
     * @return array           (CrmAccount object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CrmAccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CrmAccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CrmAccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CrmAccountTableMap::OM_CLASS;
            /** @var CrmAccount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CrmAccountTableMap::addInstanceToPool($obj, $key);
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
            $key = CrmAccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CrmAccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CrmAccount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CrmAccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CrmAccountTableMap::COL_CRM_ACCOUNT_ID);
            $criteria->addSelectColumn(CrmAccountTableMap::COL_ADD_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.crm_account_id');
            $criteria->addSelectColumn($alias . '.add_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(CrmAccountTableMap::DATABASE_NAME)->getTable(CrmAccountTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CrmAccountTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CrmAccountTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CrmAccountTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CrmAccount or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CrmAccount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\CrmAccount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CrmAccountTableMap::DATABASE_NAME);
            $criteria->add(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, (array) $values, Criteria::IN);
        }

        $query = CrmAccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CrmAccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CrmAccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the crm_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CrmAccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CrmAccount or Criteria object.
     *
     * @param mixed               $criteria Criteria or CrmAccount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CrmAccount object
        }

        if ($criteria->containsKey(CrmAccountTableMap::COL_CRM_ACCOUNT_ID) && $criteria->keyContainsValue(CrmAccountTableMap::COL_CRM_ACCOUNT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CrmAccountTableMap::COL_CRM_ACCOUNT_ID.')');
        }


        // Set the correct dbName
        $query = CrmAccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CrmAccountTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CrmAccountTableMap::buildTableMap();
