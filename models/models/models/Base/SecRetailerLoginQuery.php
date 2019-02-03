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
use models\models\SecRetailerLogin as ChildSecRetailerLogin;
use models\models\SecRetailerLoginQuery as ChildSecRetailerLoginQuery;
use models\models\Map\SecRetailerLoginTableMap;

/**
 * Base class that represents a query for the 'sec_retailer_login' table.
 *
 *
 *
 * @method     ChildSecRetailerLoginQuery orderBySecRetailerLoginId($order = Criteria::ASC) Order by the sec_retailer_login_id column
 * @method     ChildSecRetailerLoginQuery orderByRetailer($order = Criteria::ASC) Order by the retailer column
 * @method     ChildSecRetailerLoginQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildSecRetailerLoginQuery orderByLoginEmail($order = Criteria::ASC) Order by the login_email column
 * @method     ChildSecRetailerLoginQuery orderByLoginPassword($order = Criteria::ASC) Order by the login_password column
 *
 * @method     ChildSecRetailerLoginQuery groupBySecRetailerLoginId() Group by the sec_retailer_login_id column
 * @method     ChildSecRetailerLoginQuery groupByRetailer() Group by the retailer column
 * @method     ChildSecRetailerLoginQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildSecRetailerLoginQuery groupByLoginEmail() Group by the login_email column
 * @method     ChildSecRetailerLoginQuery groupByLoginPassword() Group by the login_password column
 *
 * @method     ChildSecRetailerLoginQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSecRetailerLoginQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSecRetailerLoginQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSecRetailerLoginQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSecRetailerLoginQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSecRetailerLoginQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSecRetailerLoginQuery leftJoinCrmAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccount relation
 * @method     ChildSecRetailerLoginQuery rightJoinCrmAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccount relation
 * @method     ChildSecRetailerLoginQuery innerJoinCrmAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccount relation
 *
 * @method     ChildSecRetailerLoginQuery joinWithCrmAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccount relation
 *
 * @method     ChildSecRetailerLoginQuery leftJoinWithCrmAccount() Adds a LEFT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildSecRetailerLoginQuery rightJoinWithCrmAccount() Adds a RIGHT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildSecRetailerLoginQuery innerJoinWithCrmAccount() Adds a INNER JOIN clause and with to the query using the CrmAccount relation
 *
 * @method     \models\models\CrmAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSecRetailerLogin findOne(ConnectionInterface $con = null) Return the first ChildSecRetailerLogin matching the query
 * @method     ChildSecRetailerLogin findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSecRetailerLogin matching the query, or a new ChildSecRetailerLogin object populated from the query conditions when no match is found
 *
 * @method     ChildSecRetailerLogin findOneBySecRetailerLoginId(int $sec_retailer_login_id) Return the first ChildSecRetailerLogin filtered by the sec_retailer_login_id column
 * @method     ChildSecRetailerLogin findOneByRetailer(string $retailer) Return the first ChildSecRetailerLogin filtered by the retailer column
 * @method     ChildSecRetailerLogin findOneByCrmAccountId(int $crm_account_id) Return the first ChildSecRetailerLogin filtered by the crm_account_id column
 * @method     ChildSecRetailerLogin findOneByLoginEmail(string $login_email) Return the first ChildSecRetailerLogin filtered by the login_email column
 * @method     ChildSecRetailerLogin findOneByLoginPassword(string $login_password) Return the first ChildSecRetailerLogin filtered by the login_password column *

 * @method     ChildSecRetailerLogin requirePk($key, ConnectionInterface $con = null) Return the ChildSecRetailerLogin by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecRetailerLogin requireOne(ConnectionInterface $con = null) Return the first ChildSecRetailerLogin matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSecRetailerLogin requireOneBySecRetailerLoginId(int $sec_retailer_login_id) Return the first ChildSecRetailerLogin filtered by the sec_retailer_login_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecRetailerLogin requireOneByRetailer(string $retailer) Return the first ChildSecRetailerLogin filtered by the retailer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecRetailerLogin requireOneByCrmAccountId(int $crm_account_id) Return the first ChildSecRetailerLogin filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecRetailerLogin requireOneByLoginEmail(string $login_email) Return the first ChildSecRetailerLogin filtered by the login_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSecRetailerLogin requireOneByLoginPassword(string $login_password) Return the first ChildSecRetailerLogin filtered by the login_password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSecRetailerLogin[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSecRetailerLogin objects based on current ModelCriteria
 * @method     ChildSecRetailerLogin[]|ObjectCollection findBySecRetailerLoginId(int $sec_retailer_login_id) Return ChildSecRetailerLogin objects filtered by the sec_retailer_login_id column
 * @method     ChildSecRetailerLogin[]|ObjectCollection findByRetailer(string $retailer) Return ChildSecRetailerLogin objects filtered by the retailer column
 * @method     ChildSecRetailerLogin[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildSecRetailerLogin objects filtered by the crm_account_id column
 * @method     ChildSecRetailerLogin[]|ObjectCollection findByLoginEmail(string $login_email) Return ChildSecRetailerLogin objects filtered by the login_email column
 * @method     ChildSecRetailerLogin[]|ObjectCollection findByLoginPassword(string $login_password) Return ChildSecRetailerLogin objects filtered by the login_password column
 * @method     ChildSecRetailerLogin[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SecRetailerLoginQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\SecRetailerLoginQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\SecRetailerLogin', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSecRetailerLoginQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSecRetailerLoginQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSecRetailerLoginQuery) {
            return $criteria;
        }
        $query = new ChildSecRetailerLoginQuery();
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
     * @return ChildSecRetailerLogin|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SecRetailerLoginTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SecRetailerLoginTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSecRetailerLogin A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sec_retailer_login_id, retailer, crm_account_id, login_email, login_password FROM sec_retailer_login WHERE sec_retailer_login_id = :p0';
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
            /** @var ChildSecRetailerLogin $obj */
            $obj = new ChildSecRetailerLogin();
            $obj->hydrate($row);
            SecRetailerLoginTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSecRetailerLogin|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the sec_retailer_login_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySecRetailerLoginId(1234); // WHERE sec_retailer_login_id = 1234
     * $query->filterBySecRetailerLoginId(array(12, 34)); // WHERE sec_retailer_login_id IN (12, 34)
     * $query->filterBySecRetailerLoginId(array('min' => 12)); // WHERE sec_retailer_login_id > 12
     * </code>
     *
     * @param     mixed $secRetailerLoginId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterBySecRetailerLoginId($secRetailerLoginId = null, $comparison = null)
    {
        if (is_array($secRetailerLoginId)) {
            $useMinMax = false;
            if (isset($secRetailerLoginId['min'])) {
                $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $secRetailerLoginId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($secRetailerLoginId['max'])) {
                $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $secRetailerLoginId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $secRetailerLoginId, $comparison);
    }

    /**
     * Filter the query on the retailer column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailer('fooValue');   // WHERE retailer = 'fooValue'
     * $query->filterByRetailer('%fooValue%', Criteria::LIKE); // WHERE retailer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $retailer The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByRetailer($retailer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($retailer)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_RETAILER, $retailer, $comparison);
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
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the login_email column
     *
     * Example usage:
     * <code>
     * $query->filterByLoginEmail('fooValue');   // WHERE login_email = 'fooValue'
     * $query->filterByLoginEmail('%fooValue%', Criteria::LIKE); // WHERE login_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $loginEmail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByLoginEmail($loginEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($loginEmail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_LOGIN_EMAIL, $loginEmail, $comparison);
    }

    /**
     * Filter the query on the login_password column
     *
     * Example usage:
     * <code>
     * $query->filterByLoginPassword('fooValue');   // WHERE login_password = 'fooValue'
     * $query->filterByLoginPassword('%fooValue%', Criteria::LIKE); // WHERE login_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $loginPassword The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByLoginPassword($loginPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($loginPassword)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecRetailerLoginTableMap::COL_LOGIN_PASSWORD, $loginPassword, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function filterByCrmAccount($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SecRetailerLoginTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
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
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
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
     * @param   ChildSecRetailerLogin $secRetailerLogin Object to remove from the list of results
     *
     * @return $this|ChildSecRetailerLoginQuery The current query, for fluid interface
     */
    public function prune($secRetailerLogin = null)
    {
        if ($secRetailerLogin) {
            $this->addUsingAlias(SecRetailerLoginTableMap::COL_SEC_RETAILER_LOGIN_ID, $secRetailerLogin->getSecRetailerLoginId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sec_retailer_login table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SecRetailerLoginTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SecRetailerLoginTableMap::clearInstancePool();
            SecRetailerLoginTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SecRetailerLoginTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SecRetailerLoginTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SecRetailerLoginTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SecRetailerLoginTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SecRetailerLoginQuery
