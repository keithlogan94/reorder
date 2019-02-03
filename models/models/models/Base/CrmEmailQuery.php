<?php

namespace models\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use models\models\CrmEmail as ChildCrmEmail;
use models\models\CrmEmailQuery as ChildCrmEmailQuery;
use models\models\Map\CrmEmailTableMap;

/**
 * Base class that represents a query for the 'crm_email' table.
 *
 *
 *
 * @method     ChildCrmEmailQuery orderByCrmEmailId($order = Criteria::ASC) Order by the crm_email_id column
 * @method     ChildCrmEmailQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildCrmEmailQuery orderByEmailAddress($order = Criteria::ASC) Order by the email_address column
 * @method     ChildCrmEmailQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildCrmEmailQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildCrmEmailQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildCrmEmailQuery groupByCrmEmailId() Group by the crm_email_id column
 * @method     ChildCrmEmailQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildCrmEmailQuery groupByEmailAddress() Group by the email_address column
 * @method     ChildCrmEmailQuery groupByVerified() Group by the verified column
 * @method     ChildCrmEmailQuery groupByStartDate() Group by the start_date column
 * @method     ChildCrmEmailQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildCrmEmailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmEmailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmEmailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmEmailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmEmailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmEmailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmEmailQuery leftJoinCrmAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccount relation
 * @method     ChildCrmEmailQuery rightJoinCrmAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccount relation
 * @method     ChildCrmEmailQuery innerJoinCrmAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccount relation
 *
 * @method     ChildCrmEmailQuery joinWithCrmAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccount relation
 *
 * @method     ChildCrmEmailQuery leftJoinWithCrmAccount() Adds a LEFT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildCrmEmailQuery rightJoinWithCrmAccount() Adds a RIGHT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildCrmEmailQuery innerJoinWithCrmAccount() Adds a INNER JOIN clause and with to the query using the CrmAccount relation
 *
 * @method     \models\models\CrmAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCrmEmail findOne(ConnectionInterface $con = null) Return the first ChildCrmEmail matching the query
 * @method     ChildCrmEmail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmEmail matching the query, or a new ChildCrmEmail object populated from the query conditions when no match is found
 *
 * @method     ChildCrmEmail findOneByCrmEmailId(int $crm_email_id) Return the first ChildCrmEmail filtered by the crm_email_id column
 * @method     ChildCrmEmail findOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmEmail filtered by the crm_account_id column
 * @method     ChildCrmEmail findOneByEmailAddress(string $email_address) Return the first ChildCrmEmail filtered by the email_address column
 * @method     ChildCrmEmail findOneByVerified(boolean $verified) Return the first ChildCrmEmail filtered by the verified column
 * @method     ChildCrmEmail findOneByStartDate(string $start_date) Return the first ChildCrmEmail filtered by the start_date column
 * @method     ChildCrmEmail findOneByEndDate(string $end_date) Return the first ChildCrmEmail filtered by the end_date column *

 * @method     ChildCrmEmail requirePk($key, ConnectionInterface $con = null) Return the ChildCrmEmail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOne(ConnectionInterface $con = null) Return the first ChildCrmEmail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmEmail requireOneByCrmEmailId(int $crm_email_id) Return the first ChildCrmEmail filtered by the crm_email_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmEmail filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOneByEmailAddress(string $email_address) Return the first ChildCrmEmail filtered by the email_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOneByVerified(boolean $verified) Return the first ChildCrmEmail filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOneByStartDate(string $start_date) Return the first ChildCrmEmail filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmEmail requireOneByEndDate(string $end_date) Return the first ChildCrmEmail filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmEmail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmEmail objects based on current ModelCriteria
 * @method     ChildCrmEmail[]|ObjectCollection findByCrmEmailId(int $crm_email_id) Return ChildCrmEmail objects filtered by the crm_email_id column
 * @method     ChildCrmEmail[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildCrmEmail objects filtered by the crm_account_id column
 * @method     ChildCrmEmail[]|ObjectCollection findByEmailAddress(string $email_address) Return ChildCrmEmail objects filtered by the email_address column
 * @method     ChildCrmEmail[]|ObjectCollection findByVerified(boolean $verified) Return ChildCrmEmail objects filtered by the verified column
 * @method     ChildCrmEmail[]|ObjectCollection findByStartDate(string $start_date) Return ChildCrmEmail objects filtered by the start_date column
 * @method     ChildCrmEmail[]|ObjectCollection findByEndDate(string $end_date) Return ChildCrmEmail objects filtered by the end_date column
 * @method     ChildCrmEmail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmEmailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmEmailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmEmail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmEmailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmEmailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmEmailQuery) {
            return $criteria;
        }
        $query = new ChildCrmEmailQuery();
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
     * @return ChildCrmEmail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmEmailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CrmEmailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCrmEmail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT crm_email_id, crm_account_id, email_address, verified, start_date, end_date FROM crm_email WHERE crm_email_id = :p0';
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
            /** @var ChildCrmEmail $obj */
            $obj = new ChildCrmEmail();
            $obj->hydrate($row);
            CrmEmailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCrmEmail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the crm_email_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCrmEmailId(1234); // WHERE crm_email_id = 1234
     * $query->filterByCrmEmailId(array(12, 34)); // WHERE crm_email_id IN (12, 34)
     * $query->filterByCrmEmailId(array('min' => 12)); // WHERE crm_email_id > 12
     * </code>
     *
     * @param     mixed $crmEmailId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByCrmEmailId($crmEmailId = null, $comparison = null)
    {
        if (is_array($crmEmailId)) {
            $useMinMax = false;
            if (isset($crmEmailId['min'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $crmEmailId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmEmailId['max'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $crmEmailId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $crmEmailId, $comparison);
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
     * @see       filterByCrmAccount()
     *
     * @param     mixed $crmAccountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailAddress('fooValue');   // WHERE email_address = 'fooValue'
     * $query->filterByEmailAddress('%fooValue%', Criteria::LIKE); // WHERE email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByEmailAddress($emailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_EMAIL_ADDRESS, $emailAddress, $comparison);
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(true); // WHERE verified = true
     * $query->filterByVerified('yes'); // WHERE verified = true
     * </code>
     *
     * @param     boolean|string $verified The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByVerified($verified = null, $comparison = null)
    {
        if (is_string($verified)) {
            $verified = in_array(strtolower($verified), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_VERIFIED, $verified, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(CrmEmailTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmEmailTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCrmEmailQuery The current query, for fluid interface
     */
    public function filterByCrmAccount($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(CrmEmailTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CrmEmailTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
        } else {
            throw new PropelException('filterByCrmAccount() only accepts arguments of type \models\models\CrmAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmAccount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function joinCrmAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmAccount');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CrmAccount');
        }

        return $this;
    }

    /**
     * Use the CrmAccount relation CrmAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmAccountQuery A secondary query class using the current class as primary query
     */
    public function useCrmAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmAccount', '\models\models\CrmAccountQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCrmEmail $crmEmail Object to remove from the list of results
     *
     * @return $this|ChildCrmEmailQuery The current query, for fluid interface
     */
    public function prune($crmEmail = null)
    {
        if ($crmEmail) {
            $this->addUsingAlias(CrmEmailTableMap::COL_CRM_EMAIL_ID, $crmEmail->getCrmEmailId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_email table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmEmailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmEmailTableMap::clearInstancePool();
            CrmEmailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmEmailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmEmailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmEmailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmEmailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmEmailQuery
