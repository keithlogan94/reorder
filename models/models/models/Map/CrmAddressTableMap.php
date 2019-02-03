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
use models\models\CrmAddress;
use models\models\CrmAddressQuery;


/**
 * This class defines the structure of the 'crm_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CrmAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.CrmAddressTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'crm_address';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\CrmAddress';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.CrmAddress';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the crm_address_id field
     */
    const COL_CRM_ADDRESS_ID = 'crm_address.crm_address_id';

    /**
     * the column name for the crm_account_id field
     */
    const COL_CRM_ACCOUNT_ID = 'crm_address.crm_account_id';

    /**
     * the column name for the street1 field
     */
    const COL_STREET1 = 'crm_address.street1';

    /**
     * the column name for the street2 field
     */
    const COL_STREET2 = 'crm_address.street2';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'crm_address.city';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'crm_address.state';

    /**
     * the column name for the zip field
     */
    const COL_ZIP = 'crm_address.zip';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'crm_address.country';

    /**
     * the column name for the is_billing field
     */
    const COL_IS_BILLING = 'crm_address.is_billing';

    /**
     * the column name for the billing_first_name field
     */
    const COL_BILLING_FIRST_NAME = 'crm_address.billing_first_name';

    /**
     * the column name for the billing_last_name field
     */
    const COL_BILLING_LAST_NAME = 'crm_address.billing_last_name';

    /**
     * the column name for the is_shipping field
     */
    const COL_IS_SHIPPING = 'crm_address.is_shipping';

    /**
     * the column name for the shipping_first_name field
     */
    const COL_SHIPPING_FIRST_NAME = 'crm_address.shipping_first_name';

    /**
     * the column name for the shipping_last_name field
     */
    const COL_SHIPPING_LAST_NAME = 'crm_address.shipping_last_name';

    /**
     * the column name for the start_date field
     */
    const COL_START_DATE = 'crm_address.start_date';

    /**
     * the column name for the end_date field
     */
    const COL_END_DATE = 'crm_address.end_date';

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
        self::TYPE_PHPNAME       => array('CrmAddressId', 'CrmAccountId', 'Street1', 'Street2', 'City', 'State', 'Zip', 'Country', 'IsBilling', 'BillingFirstName', 'BillingLastName', 'IsShipping', 'ShippingFirstName', 'ShippingLastName', 'StartDate', 'EndDate', ),
        self::TYPE_CAMELNAME     => array('crmAddressId', 'crmAccountId', 'street1', 'street2', 'city', 'state', 'zip', 'country', 'isBilling', 'billingFirstName', 'billingLastName', 'isShipping', 'shippingFirstName', 'shippingLastName', 'startDate', 'endDate', ),
        self::TYPE_COLNAME       => array(CrmAddressTableMap::COL_CRM_ADDRESS_ID, CrmAddressTableMap::COL_CRM_ACCOUNT_ID, CrmAddressTableMap::COL_STREET1, CrmAddressTableMap::COL_STREET2, CrmAddressTableMap::COL_CITY, CrmAddressTableMap::COL_STATE, CrmAddressTableMap::COL_ZIP, CrmAddressTableMap::COL_COUNTRY, CrmAddressTableMap::COL_IS_BILLING, CrmAddressTableMap::COL_BILLING_FIRST_NAME, CrmAddressTableMap::COL_BILLING_LAST_NAME, CrmAddressTableMap::COL_IS_SHIPPING, CrmAddressTableMap::COL_SHIPPING_FIRST_NAME, CrmAddressTableMap::COL_SHIPPING_LAST_NAME, CrmAddressTableMap::COL_START_DATE, CrmAddressTableMap::COL_END_DATE, ),
        self::TYPE_FIELDNAME     => array('crm_address_id', 'crm_account_id', 'street1', 'street2', 'city', 'state', 'zip', 'country', 'is_billing', 'billing_first_name', 'billing_last_name', 'is_shipping', 'shipping_first_name', 'shipping_last_name', 'start_date', 'end_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CrmAddressId' => 0, 'CrmAccountId' => 1, 'Street1' => 2, 'Street2' => 3, 'City' => 4, 'State' => 5, 'Zip' => 6, 'Country' => 7, 'IsBilling' => 8, 'BillingFirstName' => 9, 'BillingLastName' => 10, 'IsShipping' => 11, 'ShippingFirstName' => 12, 'ShippingLastName' => 13, 'StartDate' => 14, 'EndDate' => 15, ),
        self::TYPE_CAMELNAME     => array('crmAddressId' => 0, 'crmAccountId' => 1, 'street1' => 2, 'street2' => 3, 'city' => 4, 'state' => 5, 'zip' => 6, 'country' => 7, 'isBilling' => 8, 'billingFirstName' => 9, 'billingLastName' => 10, 'isShipping' => 11, 'shippingFirstName' => 12, 'shippingLastName' => 13, 'startDate' => 14, 'endDate' => 15, ),
        self::TYPE_COLNAME       => array(CrmAddressTableMap::COL_CRM_ADDRESS_ID => 0, CrmAddressTableMap::COL_CRM_ACCOUNT_ID => 1, CrmAddressTableMap::COL_STREET1 => 2, CrmAddressTableMap::COL_STREET2 => 3, CrmAddressTableMap::COL_CITY => 4, CrmAddressTableMap::COL_STATE => 5, CrmAddressTableMap::COL_ZIP => 6, CrmAddressTableMap::COL_COUNTRY => 7, CrmAddressTableMap::COL_IS_BILLING => 8, CrmAddressTableMap::COL_BILLING_FIRST_NAME => 9, CrmAddressTableMap::COL_BILLING_LAST_NAME => 10, CrmAddressTableMap::COL_IS_SHIPPING => 11, CrmAddressTableMap::COL_SHIPPING_FIRST_NAME => 12, CrmAddressTableMap::COL_SHIPPING_LAST_NAME => 13, CrmAddressTableMap::COL_START_DATE => 14, CrmAddressTableMap::COL_END_DATE => 15, ),
        self::TYPE_FIELDNAME     => array('crm_address_id' => 0, 'crm_account_id' => 1, 'street1' => 2, 'street2' => 3, 'city' => 4, 'state' => 5, 'zip' => 6, 'country' => 7, 'is_billing' => 8, 'billing_first_name' => 9, 'billing_last_name' => 10, 'is_shipping' => 11, 'shipping_first_name' => 12, 'shipping_last_name' => 13, 'start_date' => 14, 'end_date' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('crm_address');
        $this->setPhpName('CrmAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\CrmAddress');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignPrimaryKey('crm_address_id', 'CrmAddressId', 'INTEGER' , 'crm_account', 'crm_account_id', true, null, null);
        $this->addForeignKey('crm_account_id', 'CrmAccountId', 'INTEGER', 'crm_account', 'crm_account_id', true, null, null);
        $this->addColumn('street1', 'Street1', 'VARCHAR', true, 200, null);
        $this->addColumn('street2', 'Street2', 'VARCHAR', false, 200, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 100, null);
        $this->addColumn('state', 'State', 'VARCHAR', true, 10, null);
        $this->addColumn('zip', 'Zip', 'VARCHAR', false, 10, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 10, null);
        $this->addColumn('is_billing', 'IsBilling', 'BOOLEAN', true, 1, false);
        $this->addColumn('billing_first_name', 'BillingFirstName', 'VARCHAR', false, 40, null);
        $this->addColumn('billing_last_name', 'BillingLastName', 'VARCHAR', false, 40, null);
        $this->addColumn('is_shipping', 'IsShipping', 'BOOLEAN', true, 1, false);
        $this->addColumn('shipping_first_name', 'ShippingFirstName', 'VARCHAR', false, 40, null);
        $this->addColumn('shipping_last_name', 'ShippingLastName', 'VARCHAR', false, 40, null);
        $this->addColumn('start_date', 'StartDate', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('end_date', 'EndDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CrmAccountRelatedByCrmAccountId', '\\models\\models\\CrmAccount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':crm_account_id',
    1 => ':crm_account_id',
  ),
), null, null, null, false);
        $this->addRelation('CrmAccountRelatedByCrmAddressId', '\\models\\models\\CrmAccount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':crm_address_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CrmAddressId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CrmAddressTableMap::CLASS_DEFAULT : CrmAddressTableMap::OM_CLASS;
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
     * @return array           (CrmAddress object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CrmAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CrmAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CrmAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CrmAddressTableMap::OM_CLASS;
            /** @var CrmAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CrmAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = CrmAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CrmAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CrmAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CrmAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CrmAddressTableMap::COL_CRM_ADDRESS_ID);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_CRM_ACCOUNT_ID);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_STREET1);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_STREET2);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_STATE);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_ZIP);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_IS_BILLING);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_BILLING_FIRST_NAME);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_BILLING_LAST_NAME);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_IS_SHIPPING);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_SHIPPING_FIRST_NAME);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_SHIPPING_LAST_NAME);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_START_DATE);
            $criteria->addSelectColumn(CrmAddressTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.crm_address_id');
            $criteria->addSelectColumn($alias . '.crm_account_id');
            $criteria->addSelectColumn($alias . '.street1');
            $criteria->addSelectColumn($alias . '.street2');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.zip');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.is_billing');
            $criteria->addSelectColumn($alias . '.billing_first_name');
            $criteria->addSelectColumn($alias . '.billing_last_name');
            $criteria->addSelectColumn($alias . '.is_shipping');
            $criteria->addSelectColumn($alias . '.shipping_first_name');
            $criteria->addSelectColumn($alias . '.shipping_last_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(CrmAddressTableMap::DATABASE_NAME)->getTable(CrmAddressTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CrmAddressTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CrmAddressTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CrmAddressTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CrmAddress or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CrmAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\CrmAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CrmAddressTableMap::DATABASE_NAME);
            $criteria->add(CrmAddressTableMap::COL_CRM_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = CrmAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CrmAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CrmAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the crm_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CrmAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CrmAddress or Criteria object.
     *
     * @param mixed               $criteria Criteria or CrmAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CrmAddress object
        }

        if ($criteria->containsKey(CrmAddressTableMap::COL_CRM_ADDRESS_ID) && $criteria->keyContainsValue(CrmAddressTableMap::COL_CRM_ADDRESS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CrmAddressTableMap::COL_CRM_ADDRESS_ID.')');
        }


        // Set the correct dbName
        $query = CrmAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CrmAddressTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CrmAddressTableMap::buildTableMap();
