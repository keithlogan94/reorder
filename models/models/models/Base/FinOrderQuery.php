<?php

namespace models\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use models\models\FinOrder as ChildFinOrder;
use models\models\FinOrderQuery as ChildFinOrderQuery;
use models\models\Map\FinOrderTableMap;

/**
 * Base class that represents a query for the 'fin_order' table.
 *
 *
 *
 * @method     ChildFinOrderQuery orderByFinOrderId($order = Criteria::ASC) Order by the fin_order_id column
 * @method     ChildFinOrderQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildFinOrderQuery orderByZincRequestId($order = Criteria::ASC) Order by the zinc_request_id column
 * @method     ChildFinOrderQuery orderByOrderJson($order = Criteria::ASC) Order by the order_json column
 * @method     ChildFinOrderQuery orderByAddTime($order = Criteria::ASC) Order by the add_time column
 *
 * @method     ChildFinOrderQuery groupByFinOrderId() Group by the fin_order_id column
 * @method     ChildFinOrderQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildFinOrderQuery groupByZincRequestId() Group by the zinc_request_id column
 * @method     ChildFinOrderQuery groupByOrderJson() Group by the order_json column
 * @method     ChildFinOrderQuery groupByAddTime() Group by the add_time column
 *
 * @method     ChildFinOrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFinOrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFinOrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFinOrderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFinOrderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFinOrderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFinOrder findOne(ConnectionInterface $con = null) Return the first ChildFinOrder matching the query
 * @method     ChildFinOrder findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFinOrder matching the query, or a new ChildFinOrder object populated from the query conditions when no match is found
 *
 * @method     ChildFinOrder findOneByFinOrderId(int $fin_order_id) Return the first ChildFinOrder filtered by the fin_order_id column
 * @method     ChildFinOrder findOneByCrmAccountId(int $crm_account_id) Return the first ChildFinOrder filtered by the crm_account_id column
 * @method     ChildFinOrder findOneByZincRequestId(string $zinc_request_id) Return the first ChildFinOrder filtered by the zinc_request_id column
 * @method     ChildFinOrder findOneByOrderJson(string $order_json) Return the first ChildFinOrder filtered by the order_json column
 * @method     ChildFinOrder findOneByAddTime(string $add_time) Return the first ChildFinOrder filtered by the add_time column *

 * @method     ChildFinOrder requirePk($key, ConnectionInterface $con = null) Return the ChildFinOrder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinOrder requireOne(ConnectionInterface $con = null) Return the first ChildFinOrder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinOrder requireOneByFinOrderId(int $fin_order_id) Return the first ChildFinOrder filtered by the fin_order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinOrder requireOneByCrmAccountId(int $crm_account_id) Return the first ChildFinOrder filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinOrder requireOneByZincRequestId(string $zinc_request_id) Return the first ChildFinOrder filtered by the zinc_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinOrder requireOneByOrderJson(string $order_json) Return the first ChildFinOrder filtered by the order_json column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinOrder requireOneByAddTime(string $add_time) Return the first ChildFinOrder filtered by the add_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinOrder[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFinOrder objects based on current ModelCriteria
 * @method     ChildFinOrder[]|ObjectCollection findByFinOrderId(int $fin_order_id) Return ChildFinOrder objects filtered by the fin_order_id column
 * @method     ChildFinOrder[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildFinOrder objects filtered by the crm_account_id column
 * @method     ChildFinOrder[]|ObjectCollection findByZincRequestId(string $zinc_request_id) Return ChildFinOrder objects filtered by the zinc_request_id column
 * @method     ChildFinOrder[]|ObjectCollection findByOrderJson(string $order_json) Return ChildFinOrder objects filtered by the order_json column
 * @method     ChildFinOrder[]|ObjectCollection findByAddTime(string $add_time) Return ChildFinOrder objects filtered by the add_time column
 * @method     ChildFinOrder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FinOrderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\FinOrderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\FinOrder', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFinOrderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFinOrderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFinOrderQuery) {
            return $criteria;
        }
        $query = new ChildFinOrderQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFinOrder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FinOrderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FinOrderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFinOrder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT fin_order_id, crm_account_id, zinc_request_id, order_json, add_time FROM fin_order WHERE fin_order_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFinOrder $obj */
            $obj = new ChildFinOrder();
            $obj->hydrate($row);
            FinOrderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFinOrder|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fin_order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFinOrderId(1234); // WHERE fin_order_id = 1234
     * $query->filterByFinOrderId(array(12, 34)); // WHERE fin_order_id IN (12, 34)
     * $query->filterByFinOrderId(array('min' => 12)); // WHERE fin_order_id > 12
     * </code>
     *
     * @param     mixed $finOrderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByFinOrderId($finOrderId = null, $comparison = null)
    {
        if (is_array($finOrderId)) {
            $useMinMax = false;
            if (isset($finOrderId['min'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $finOrderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finOrderId['max'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $finOrderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $finOrderId, $comparison);
    }

    /**
     * Filter the query on the crm_account_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCrmAccountId(1234); // WHERE crm_account_id = 1234
     * $query->filterByCrmAccountId(array(12, 34)); // WHERE crm_account_id IN (12, 34)
     * $query->filterByCrmAccountId(array('min' => 12)); // WHERE crm_account_id > 12
     * </code>
     *
     * @param     mixed $crmAccountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinOrderTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the zinc_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByZincRequestId('fooValue');   // WHERE zinc_request_id = 'fooValue'
     * $query->filterByZincRequestId('%fooValue%', Criteria::LIKE); // WHERE zinc_request_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zincRequestId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByZincRequestId($zincRequestId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zincRequestId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinOrderTableMap::COL_ZINC_REQUEST_ID, $zincRequestId, $comparison);
    }

    /**
     * Filter the query on the order_json column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderJson('fooValue');   // WHERE order_json = 'fooValue'
     * $query->filterByOrderJson('%fooValue%', Criteria::LIKE); // WHERE order_json LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orderJson The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByOrderJson($orderJson = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderJson)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinOrderTableMap::COL_ORDER_JSON, $orderJson, $comparison);
    }

    /**
     * Filter the query on the add_time column
     *
     * Example usage:
     * <code>
     * $query->filterByAddTime('2011-03-14'); // WHERE add_time = '2011-03-14'
     * $query->filterByAddTime('now'); // WHERE add_time = '2011-03-14'
     * $query->filterByAddTime(array('max' => 'yesterday')); // WHERE add_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $addTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function filterByAddTime($addTime = null, $comparison = null)
    {
        if (is_array($addTime)) {
            $useMinMax = false;
            if (isset($addTime['min'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_ADD_TIME, $addTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addTime['max'])) {
                $this->addUsingAlias(FinOrderTableMap::COL_ADD_TIME, $addTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinOrderTableMap::COL_ADD_TIME, $addTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFinOrder $finOrder Object to remove from the list of results
     *
     * @return $this|ChildFinOrderQuery The current query, for fluid interface
     */
    public function prune($finOrder = null)
    {
        if ($finOrder) {
            $this->addUsingAlias(FinOrderTableMap::COL_FIN_ORDER_ID, $finOrder->getFinOrderId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fin_order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinOrderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FinOrderTableMap::clearInstancePool();
            FinOrderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinOrderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FinOrderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FinOrderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FinOrderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FinOrderQuery
