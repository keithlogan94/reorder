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
use models\models\FinCreditCard;
use models\models\FinCreditCardQuery;


/**
 * This class defines the structure of the 'fin_credit_card' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FinCreditCardTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.FinCreditCardTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fin_credit_card';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\FinCreditCard';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.FinCreditCard';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the fin_credit_card_id field
     */
    const COL_FIN_CREDIT_CARD_ID = 'fin_credit_card.fin_credit_card_id';

    /**
     * the column name for the crm_account_id field
     */
    const COL_CRM_ACCOUNT_ID = 'fin_credit_card.crm_account_id';

    /**
     * the column name for the name_on_card field
     */
    const COL_NAME_ON_CARD = 'fin_credit_card.name_on_card';

    /**
     * the column name for the number field
     */
    const COL_NUMBER = 'fin_credit_card.number';

    /**
     * the column name for the security_code field
     */
    const COL_SECURITY_CODE = 'fin_credit_card.security_code';

    /**
     * the column name for the expiration_month field
     */
    const COL_EXPIRATION_MONTH = 'fin_credit_card.expiration_month';

    /**
     * the column name for the expiration_year field
     */
    const COL_EXPIRATION_YEAR = 'fin_credit_card.expiration_year';

    /**
     * the column name for the add_date field
     */
    const COL_ADD_DATE = 'fin_credit_card.add_date';

    /**
     * the column name for the start_date field
     */
    const COL_START_DATE = 'fin_credit_card.start_date';

    /**
     * the column name for the end_date field
     */
    const COL_END_DATE = 'fin_credit_card.end_date';

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
        self::TYPE_PHPNAME       => array('FinCreditCardId', 'CrmAccountId', 'NameOnCard', 'Number', 'SecurityCode', 'ExpirationMonth', 'ExpirationYear', 'AddDate', 'StartDate', 'EndDate', ),
        self::TYPE_CAMELNAME     => array('finCreditCardId', 'crmAccountId', 'nameOnCard', 'number', 'securityCode', 'expirationMonth', 'expirationYear', 'addDate', 'startDate', 'endDate', ),
        self::TYPE_COLNAME       => array(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, FinCreditCardTableMap::COL_NAME_ON_CARD, FinCreditCardTableMap::COL_NUMBER, FinCreditCardTableMap::COL_SECURITY_CODE, FinCreditCardTableMap::COL_EXPIRATION_MONTH, FinCreditCardTableMap::COL_EXPIRATION_YEAR, FinCreditCardTableMap::COL_ADD_DATE, FinCreditCardTableMap::COL_START_DATE, FinCreditCardTableMap::COL_END_DATE, ),
        self::TYPE_FIELDNAME     => array('fin_credit_card_id', 'crm_account_id', 'name_on_card', 'number', 'security_code', 'expiration_month', 'expiration_year', 'add_date', 'start_date', 'end_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('FinCreditCardId' => 0, 'CrmAccountId' => 1, 'NameOnCard' => 2, 'Number' => 3, 'SecurityCode' => 4, 'ExpirationMonth' => 5, 'ExpirationYear' => 6, 'AddDate' => 7, 'StartDate' => 8, 'EndDate' => 9, ),
        self::TYPE_CAMELNAME     => array('finCreditCardId' => 0, 'crmAccountId' => 1, 'nameOnCard' => 2, 'number' => 3, 'securityCode' => 4, 'expirationMonth' => 5, 'expirationYear' => 6, 'addDate' => 7, 'startDate' => 8, 'endDate' => 9, ),
        self::TYPE_COLNAME       => array(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID => 0, FinCreditCardTableMap::COL_CRM_ACCOUNT_ID => 1, FinCreditCardTableMap::COL_NAME_ON_CARD => 2, FinCreditCardTableMap::COL_NUMBER => 3, FinCreditCardTableMap::COL_SECURITY_CODE => 4, FinCreditCardTableMap::COL_EXPIRATION_MONTH => 5, FinCreditCardTableMap::COL_EXPIRATION_YEAR => 6, FinCreditCardTableMap::COL_ADD_DATE => 7, FinCreditCardTableMap::COL_START_DATE => 8, FinCreditCardTableMap::COL_END_DATE => 9, ),
        self::TYPE_FIELDNAME     => array('fin_credit_card_id' => 0, 'crm_account_id' => 1, 'name_on_card' => 2, 'number' => 3, 'security_code' => 4, 'expiration_month' => 5, 'expiration_year' => 6, 'add_date' => 7, 'start_date' => 8, 'end_date' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('fin_credit_card');
        $this->setPhpName('FinCreditCard');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\FinCreditCard');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('fin_credit_card_id', 'FinCreditCardId', 'INTEGER', true, null, null);
        $this->addForeignKey('crm_account_id', 'CrmAccountId', 'INTEGER', 'crm_account', 'crm_account_id', true, null, null);
        $this->addColumn('name_on_card', 'NameOnCard', 'VARCHAR', true, 150, null);
        $this->addColumn('number', 'Number', 'VARCHAR', true, 30, null);
        $this->addColumn('security_code', 'SecurityCode', 'VARCHAR', false, 10, null);
        $this->addColumn('expiration_month', 'ExpirationMonth', 'TINYINT', true, null, null);
        $this->addColumn('expiration_year', 'ExpirationYear', 'SMALLINT', true, null, null);
        $this->addColumn('add_date', 'AddDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FinCreditCardId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FinCreditCardTableMap::CLASS_DEFAULT : FinCreditCardTableMap::OM_CLASS;
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
     * @return array           (FinCreditCard object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FinCreditCardTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FinCreditCardTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FinCreditCardTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FinCreditCardTableMap::OM_CLASS;
            /** @var FinCreditCard $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FinCreditCardTableMap::addInstanceToPool($obj, $key);
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
            $key = FinCreditCardTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FinCreditCardTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FinCreditCard $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FinCreditCardTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_NAME_ON_CARD);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_NUMBER);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_SECURITY_CODE);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_EXPIRATION_MONTH);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_EXPIRATION_YEAR);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_ADD_DATE);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_START_DATE);
            $criteria->addSelectColumn(FinCreditCardTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.fin_credit_card_id');
            $criteria->addSelectColumn($alias . '.crm_account_id');
            $criteria->addSelectColumn($alias . '.name_on_card');
            $criteria->addSelectColumn($alias . '.number');
            $criteria->addSelectColumn($alias . '.security_code');
            $criteria->addSelectColumn($alias . '.expiration_month');
            $criteria->addSelectColumn($alias . '.expiration_year');
            $criteria->addSelectColumn($alias . '.add_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(FinCreditCardTableMap::DATABASE_NAME)->getTable(FinCreditCardTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FinCreditCardTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FinCreditCardTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FinCreditCardTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FinCreditCard or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FinCreditCard object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\FinCreditCard) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FinCreditCardTableMap::DATABASE_NAME);
            $criteria->add(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, (array) $values, Criteria::IN);
        }

        $query = FinCreditCardQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FinCreditCardTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FinCreditCardTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fin_credit_card table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FinCreditCardQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FinCreditCard or Criteria object.
     *
     * @param mixed               $criteria Criteria or FinCreditCard object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FinCreditCard object
        }

        if ($criteria->containsKey(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID) && $criteria->keyContainsValue(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID.')');
        }


        // Set the correct dbName
        $query = FinCreditCardQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FinCreditCardTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FinCreditCardTableMap::buildTableMap();
