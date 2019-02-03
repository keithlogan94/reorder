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
use models\models\CrmLoginCredentials as ChildCrmLoginCredentials;
use models\models\CrmLoginCredentialsQuery as ChildCrmLoginCredentialsQuery;
use models\models\Map\CrmLoginCredentialsTableMap;

/**
 * Base class that represents a query for the 'crm_login_credentials' table.
 *
 *
 *
 * @method     ChildCrmLoginCredentialsQuery orderByCrmLoginCredentialsId($order = Criteria::ASC) Order by the crm_login_credentials_id column
 * @method     ChildCrmLoginCredentialsQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildCrmLoginCredentialsQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildCrmLoginCredentialsQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildCrmLoginCredentialsQuery orderByAddTime($order = Criteria::ASC) Order by the add_time column
 *
 * @method     ChildCrmLoginCredentialsQuery groupByCrmLoginCredentialsId() Group by the crm_login_credentials_id column
 * @method     ChildCrmLoginCredentialsQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildCrmLoginCredentialsQuery groupByUsername() Group by the username column
 * @method     ChildCrmLoginCredentialsQuery groupByPassword() Group by the password column
 * @method     ChildCrmLoginCredentialsQuery groupByAddTime() Group by the add_time column
 *
 * @method     ChildCrmLoginCredentialsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmLoginCredentialsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmLoginCredentialsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmLoginCredentialsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmLoginCredentialsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmLoginCredentialsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmLoginCredentials findOne(ConnectionInterface $con = null) Return the first ChildCrmLoginCredentials matching the query
 * @method     ChildCrmLoginCredentials findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmLoginCredentials matching the query, or a new ChildCrmLoginCredentials object populated from the query conditions when no match is found
 *
 * @method     ChildCrmLoginCredentials findOneByCrmLoginCredentialsId(int $crm_login_credentials_id) Return the first ChildCrmLoginCredentials filtered by the crm_login_credentials_id column
 * @method     ChildCrmLoginCredentials findOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmLoginCredentials filtered by the crm_account_id column
 * @method     ChildCrmLoginCredentials findOneByUsername(string $username) Return the first ChildCrmLoginCredentials filtered by the username column
 * @method     ChildCrmLoginCredentials findOneByPassword(string $password) Return the first ChildCrmLoginCredentials filtered by the password column
 * @method     ChildCrmLoginCredentials findOneByAddTime(string $add_time) Return the first ChildCrmLoginCredentials filtered by the add_time column *

 * @method     ChildCrmLoginCredentials requirePk($key, ConnectionInterface $con = null) Return the ChildCrmLoginCredentials by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmLoginCredentials requireOne(ConnectionInterface $con = null) Return the first ChildCrmLoginCredentials matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmLoginCredentials requireOneByCrmLoginCredentialsId(int $crm_login_credentials_id) Return the first ChildCrmLoginCredentials filtered by the crm_login_credentials_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmLoginCredentials requireOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmLoginCredentials filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmLoginCredentials requireOneByUsername(string $username) Return the first ChildCrmLoginCredentials filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmLoginCredentials requireOneByPassword(string $password) Return the first ChildCrmLoginCredentials filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmLoginCredentials requireOneByAddTime(string $add_time) Return the first ChildCrmLoginCredentials filtered by the add_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmLoginCredentials[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmLoginCredentials objects based on current ModelCriteria
 * @method     ChildCrmLoginCredentials[]|ObjectCollection findByCrmLoginCredentialsId(int $crm_login_credentials_id) Return ChildCrmLoginCredentials objects filtered by the crm_login_credentials_id column
 * @method     ChildCrmLoginCredentials[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildCrmLoginCredentials objects filtered by the crm_account_id column
 * @method     ChildCrmLoginCredentials[]|ObjectCollection findByUsername(string $username) Return ChildCrmLoginCredentials objects filtered by the username column
 * @method     ChildCrmLoginCredentials[]|ObjectCollection findByPassword(string $password) Return ChildCrmLoginCredentials objects filtered by the password column
 * @method     ChildCrmLoginCredentials[]|ObjectCollection findByAddTime(string $add_time) Return ChildCrmLoginCredentials objects filtered by the add_time column
 * @method     ChildCrmLoginCredentials[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmLoginCredentialsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmLoginCredentialsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmLoginCredentials', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmLoginCredentialsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmLoginCredentialsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmLoginCredentialsQuery) {
            return $criteria;
        }
        $query = new ChildCrmLoginCredentialsQuery();
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
     * @return ChildCrmLoginCredentials|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmLoginCredentialsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CrmLoginCredentialsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCrmLoginCredentials A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT crm_login_credentials_id, crm_account_id, username, password, add_time FROM crm_login_credentials WHERE crm_login_credentials_id = :p0';
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
            /** @var ChildCrmLoginCredentials $obj */
            $obj = new ChildCrmLoginCredentials();
            $obj->hydrate($row);
            CrmLoginCredentialsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCrmLoginCredentials|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the crm_login_credentials_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCrmLoginCredentialsId(1234); // WHERE crm_login_credentials_id = 1234
     * $query->filterByCrmLoginCredentialsId(array(12, 34)); // WHERE crm_login_credentials_id IN (12, 34)
     * $query->filterByCrmLoginCredentialsId(array('min' => 12)); // WHERE crm_login_credentials_id > 12
     * </code>
     *
     * @param     mixed $crmLoginCredentialsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByCrmLoginCredentialsId($crmLoginCredentialsId = null, $comparison = null)
    {
        if (is_array($crmLoginCredentialsId)) {
            $useMinMax = false;
            if (isset($crmLoginCredentialsId['min'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $crmLoginCredentialsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmLoginCredentialsId['max'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $crmLoginCredentialsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $crmLoginCredentialsId, $comparison);
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
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function filterByAddTime($addTime = null, $comparison = null)
    {
        if (is_array($addTime)) {
            $useMinMax = false;
            if (isset($addTime['min'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_ADD_TIME, $addTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addTime['max'])) {
                $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_ADD_TIME, $addTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_ADD_TIME, $addTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCrmLoginCredentials $crmLoginCredentials Object to remove from the list of results
     *
     * @return $this|ChildCrmLoginCredentialsQuery The current query, for fluid interface
     */
    public function prune($crmLoginCredentials = null)
    {
        if ($crmLoginCredentials) {
            $this->addUsingAlias(CrmLoginCredentialsTableMap::COL_CRM_LOGIN_CREDENTIALS_ID, $crmLoginCredentials->getCrmLoginCredentialsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_login_credentials table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmLoginCredentialsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmLoginCredentialsTableMap::clearInstancePool();
            CrmLoginCredentialsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmLoginCredentialsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmLoginCredentialsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmLoginCredentialsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmLoginCredentialsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmLoginCredentialsQuery
