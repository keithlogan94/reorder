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
use models\models\SysConfig as ChildSysConfig;
use models\models\SysConfigQuery as ChildSysConfigQuery;
use models\models\Map\SysConfigTableMap;

/**
 * Base class that represents a query for the 'sys_config' table.
 *
 *
 *
 * @method     ChildSysConfigQuery orderBySysConfigId($order = Criteria::ASC) Order by the sys_config_id column
 * @method     ChildSysConfigQuery orderByConfigKey($order = Criteria::ASC) Order by the config_key column
 * @method     ChildSysConfigQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSysConfigQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildSysConfigQuery orderByAddTime($order = Criteria::ASC) Order by the add_time column
 *
 * @method     ChildSysConfigQuery groupBySysConfigId() Group by the sys_config_id column
 * @method     ChildSysConfigQuery groupByConfigKey() Group by the config_key column
 * @method     ChildSysConfigQuery groupByDescription() Group by the description column
 * @method     ChildSysConfigQuery groupByValue() Group by the value column
 * @method     ChildSysConfigQuery groupByAddTime() Group by the add_time column
 *
 * @method     ChildSysConfigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysConfigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysConfigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysConfigQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysConfigQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysConfigQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysConfig findOne(ConnectionInterface $con = null) Return the first ChildSysConfig matching the query
 * @method     ChildSysConfig findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysConfig matching the query, or a new ChildSysConfig object populated from the query conditions when no match is found
 *
 * @method     ChildSysConfig findOneBySysConfigId(int $sys_config_id) Return the first ChildSysConfig filtered by the sys_config_id column
 * @method     ChildSysConfig findOneByConfigKey(string $config_key) Return the first ChildSysConfig filtered by the config_key column
 * @method     ChildSysConfig findOneByDescription(string $description) Return the first ChildSysConfig filtered by the description column
 * @method     ChildSysConfig findOneByValue(string $value) Return the first ChildSysConfig filtered by the value column
 * @method     ChildSysConfig findOneByAddTime(string $add_time) Return the first ChildSysConfig filtered by the add_time column *

 * @method     ChildSysConfig requirePk($key, ConnectionInterface $con = null) Return the ChildSysConfig by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysConfig requireOne(ConnectionInterface $con = null) Return the first ChildSysConfig matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysConfig requireOneBySysConfigId(int $sys_config_id) Return the first ChildSysConfig filtered by the sys_config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysConfig requireOneByConfigKey(string $config_key) Return the first ChildSysConfig filtered by the config_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysConfig requireOneByDescription(string $description) Return the first ChildSysConfig filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysConfig requireOneByValue(string $value) Return the first ChildSysConfig filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysConfig requireOneByAddTime(string $add_time) Return the first ChildSysConfig filtered by the add_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysConfig[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysConfig objects based on current ModelCriteria
 * @method     ChildSysConfig[]|ObjectCollection findBySysConfigId(int $sys_config_id) Return ChildSysConfig objects filtered by the sys_config_id column
 * @method     ChildSysConfig[]|ObjectCollection findByConfigKey(string $config_key) Return ChildSysConfig objects filtered by the config_key column
 * @method     ChildSysConfig[]|ObjectCollection findByDescription(string $description) Return ChildSysConfig objects filtered by the description column
 * @method     ChildSysConfig[]|ObjectCollection findByValue(string $value) Return ChildSysConfig objects filtered by the value column
 * @method     ChildSysConfig[]|ObjectCollection findByAddTime(string $add_time) Return ChildSysConfig objects filtered by the add_time column
 * @method     ChildSysConfig[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysConfigQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\SysConfigQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\SysConfig', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysConfigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysConfigQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysConfigQuery) {
            return $criteria;
        }
        $query = new ChildSysConfigQuery();
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
     * @return ChildSysConfig|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysConfigTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysConfigTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysConfig A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sys_config_id, config_key, description, value, add_time FROM sys_config WHERE sys_config_id = :p0';
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
            /** @var ChildSysConfig $obj */
            $obj = new ChildSysConfig();
            $obj->hydrate($row);
            SysConfigTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysConfig|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the sys_config_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySysConfigId(1234); // WHERE sys_config_id = 1234
     * $query->filterBySysConfigId(array(12, 34)); // WHERE sys_config_id IN (12, 34)
     * $query->filterBySysConfigId(array('min' => 12)); // WHERE sys_config_id > 12
     * </code>
     *
     * @param     mixed $sysConfigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterBySysConfigId($sysConfigId = null, $comparison = null)
    {
        if (is_array($sysConfigId)) {
            $useMinMax = false;
            if (isset($sysConfigId['min'])) {
                $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $sysConfigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sysConfigId['max'])) {
                $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $sysConfigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $sysConfigId, $comparison);
    }

    /**
     * Filter the query on the config_key column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigKey('fooValue');   // WHERE config_key = 'fooValue'
     * $query->filterByConfigKey('%fooValue%', Criteria::LIKE); // WHERE config_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configKey The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByConfigKey($configKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configKey)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysConfigTableMap::COL_CONFIG_KEY, $configKey, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysConfigTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysConfigTableMap::COL_VALUE, $value, $comparison);
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
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function filterByAddTime($addTime = null, $comparison = null)
    {
        if (is_array($addTime)) {
            $useMinMax = false;
            if (isset($addTime['min'])) {
                $this->addUsingAlias(SysConfigTableMap::COL_ADD_TIME, $addTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addTime['max'])) {
                $this->addUsingAlias(SysConfigTableMap::COL_ADD_TIME, $addTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysConfigTableMap::COL_ADD_TIME, $addTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysConfig $sysConfig Object to remove from the list of results
     *
     * @return $this|ChildSysConfigQuery The current query, for fluid interface
     */
    public function prune($sysConfig = null)
    {
        if ($sysConfig) {
            $this->addUsingAlias(SysConfigTableMap::COL_SYS_CONFIG_ID, $sysConfig->getSysConfigId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysConfigTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysConfigTableMap::clearInstancePool();
            SysConfigTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysConfigTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysConfigTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysConfigTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysConfigTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysConfigQuery
