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
use models\models\CrmAccount as ChildCrmAccount;
use models\models\CrmAccountQuery as ChildCrmAccountQuery;
use models\models\Map\CrmAccountTableMap;

/**
 * Base class that represents a query for the 'crm_account' table.
 *
 *
 *
 * @method     ChildCrmAccountQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildCrmAccountQuery orderByAddTime($order = Criteria::ASC) Order by the add_time column
 *
 * @method     ChildCrmAccountQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildCrmAccountQuery groupByAddTime() Group by the add_time column
 *
 * @method     ChildCrmAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmAccountQuery leftJoinCrmAddressRelatedByCrmAccountId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAddressRelatedByCrmAccountId relation
 * @method     ChildCrmAccountQuery rightJoinCrmAddressRelatedByCrmAccountId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAddressRelatedByCrmAccountId relation
 * @method     ChildCrmAccountQuery innerJoinCrmAddressRelatedByCrmAccountId($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAddressRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAccountQuery joinWithCrmAddressRelatedByCrmAccountId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAddressRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithCrmAddressRelatedByCrmAccountId() Adds a LEFT JOIN clause and with to the query using the CrmAddressRelatedByCrmAccountId relation
 * @method     ChildCrmAccountQuery rightJoinWithCrmAddressRelatedByCrmAccountId() Adds a RIGHT JOIN clause and with to the query using the CrmAddressRelatedByCrmAccountId relation
 * @method     ChildCrmAccountQuery innerJoinWithCrmAddressRelatedByCrmAccountId() Adds a INNER JOIN clause and with to the query using the CrmAddressRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAccountQuery leftJoinCrmAddressRelatedByCrmAddressId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAddressRelatedByCrmAddressId relation
 * @method     ChildCrmAccountQuery rightJoinCrmAddressRelatedByCrmAddressId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAddressRelatedByCrmAddressId relation
 * @method     ChildCrmAccountQuery innerJoinCrmAddressRelatedByCrmAddressId($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAddressRelatedByCrmAddressId relation
 *
 * @method     ChildCrmAccountQuery joinWithCrmAddressRelatedByCrmAddressId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAddressRelatedByCrmAddressId relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithCrmAddressRelatedByCrmAddressId() Adds a LEFT JOIN clause and with to the query using the CrmAddressRelatedByCrmAddressId relation
 * @method     ChildCrmAccountQuery rightJoinWithCrmAddressRelatedByCrmAddressId() Adds a RIGHT JOIN clause and with to the query using the CrmAddressRelatedByCrmAddressId relation
 * @method     ChildCrmAccountQuery innerJoinWithCrmAddressRelatedByCrmAddressId() Adds a INNER JOIN clause and with to the query using the CrmAddressRelatedByCrmAddressId relation
 *
 * @method     ChildCrmAccountQuery leftJoinCrmEmail($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmEmail relation
 * @method     ChildCrmAccountQuery rightJoinCrmEmail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmEmail relation
 * @method     ChildCrmAccountQuery innerJoinCrmEmail($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmEmail relation
 *
 * @method     ChildCrmAccountQuery joinWithCrmEmail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmEmail relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithCrmEmail() Adds a LEFT JOIN clause and with to the query using the CrmEmail relation
 * @method     ChildCrmAccountQuery rightJoinWithCrmEmail() Adds a RIGHT JOIN clause and with to the query using the CrmEmail relation
 * @method     ChildCrmAccountQuery innerJoinWithCrmEmail() Adds a INNER JOIN clause and with to the query using the CrmEmail relation
 *
 * @method     ChildCrmAccountQuery leftJoinCrmPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmPerson relation
 * @method     ChildCrmAccountQuery rightJoinCrmPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmPerson relation
 * @method     ChildCrmAccountQuery innerJoinCrmPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmPerson relation
 *
 * @method     ChildCrmAccountQuery joinWithCrmPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmPerson relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithCrmPerson() Adds a LEFT JOIN clause and with to the query using the CrmPerson relation
 * @method     ChildCrmAccountQuery rightJoinWithCrmPerson() Adds a RIGHT JOIN clause and with to the query using the CrmPerson relation
 * @method     ChildCrmAccountQuery innerJoinWithCrmPerson() Adds a INNER JOIN clause and with to the query using the CrmPerson relation
 *
 * @method     ChildCrmAccountQuery leftJoinFinCreditCard($relationAlias = null) Adds a LEFT JOIN clause to the query using the FinCreditCard relation
 * @method     ChildCrmAccountQuery rightJoinFinCreditCard($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FinCreditCard relation
 * @method     ChildCrmAccountQuery innerJoinFinCreditCard($relationAlias = null) Adds a INNER JOIN clause to the query using the FinCreditCard relation
 *
 * @method     ChildCrmAccountQuery joinWithFinCreditCard($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FinCreditCard relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithFinCreditCard() Adds a LEFT JOIN clause and with to the query using the FinCreditCard relation
 * @method     ChildCrmAccountQuery rightJoinWithFinCreditCard() Adds a RIGHT JOIN clause and with to the query using the FinCreditCard relation
 * @method     ChildCrmAccountQuery innerJoinWithFinCreditCard() Adds a INNER JOIN clause and with to the query using the FinCreditCard relation
 *
 * @method     ChildCrmAccountQuery leftJoinSecRetailerLogin($relationAlias = null) Adds a LEFT JOIN clause to the query using the SecRetailerLogin relation
 * @method     ChildCrmAccountQuery rightJoinSecRetailerLogin($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SecRetailerLogin relation
 * @method     ChildCrmAccountQuery innerJoinSecRetailerLogin($relationAlias = null) Adds a INNER JOIN clause to the query using the SecRetailerLogin relation
 *
 * @method     ChildCrmAccountQuery joinWithSecRetailerLogin($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SecRetailerLogin relation
 *
 * @method     ChildCrmAccountQuery leftJoinWithSecRetailerLogin() Adds a LEFT JOIN clause and with to the query using the SecRetailerLogin relation
 * @method     ChildCrmAccountQuery rightJoinWithSecRetailerLogin() Adds a RIGHT JOIN clause and with to the query using the SecRetailerLogin relation
 * @method     ChildCrmAccountQuery innerJoinWithSecRetailerLogin() Adds a INNER JOIN clause and with to the query using the SecRetailerLogin relation
 *
 * @method     \models\models\CrmAddressQuery|\models\models\CrmEmailQuery|\models\models\CrmPersonQuery|\models\models\FinCreditCardQuery|\models\models\SecRetailerLoginQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCrmAccount findOne(ConnectionInterface $con = null) Return the first ChildCrmAccount matching the query
 * @method     ChildCrmAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmAccount matching the query, or a new ChildCrmAccount object populated from the query conditions when no match is found
 *
 * @method     ChildCrmAccount findOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmAccount filtered by the crm_account_id column
 * @method     ChildCrmAccount findOneByAddTime(string $add_time) Return the first ChildCrmAccount filtered by the add_time column *

 * @method     ChildCrmAccount requirePk($key, ConnectionInterface $con = null) Return the ChildCrmAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAccount requireOne(ConnectionInterface $con = null) Return the first ChildCrmAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmAccount requireOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmAccount filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAccount requireOneByAddTime(string $add_time) Return the first ChildCrmAccount filtered by the add_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmAccount[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmAccount objects based on current ModelCriteria
 * @method     ChildCrmAccount[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildCrmAccount objects filtered by the crm_account_id column
 * @method     ChildCrmAccount[]|ObjectCollection findByAddTime(string $add_time) Return ChildCrmAccount objects filtered by the add_time column
 * @method     ChildCrmAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmAccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmAccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmAccountQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmAccountQuery) {
            return $criteria;
        }
        $query = new ChildCrmAccountQuery();
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
     * @return ChildCrmAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CrmAccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCrmAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT crm_account_id, add_time FROM crm_account WHERE crm_account_id = :p0';
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
            /** @var ChildCrmAccount $obj */
            $obj = new ChildCrmAccount();
            $obj->hydrate($row);
            CrmAccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCrmAccount|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
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
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByAddTime($addTime = null, $comparison = null)
    {
        if (is_array($addTime)) {
            $useMinMax = false;
            if (isset($addTime['min'])) {
                $this->addUsingAlias(CrmAccountTableMap::COL_ADD_TIME, $addTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addTime['max'])) {
                $this->addUsingAlias(CrmAccountTableMap::COL_ADD_TIME, $addTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAccountTableMap::COL_ADD_TIME, $addTime, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAddress object
     *
     * @param \models\models\CrmAddress|ObjectCollection $crmAddress the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByCrmAddressRelatedByCrmAccountId($crmAddress, $comparison = null)
    {
        if ($crmAddress instanceof \models\models\CrmAddress) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAddress->getCrmAccountId(), $comparison);
        } elseif ($crmAddress instanceof ObjectCollection) {
            return $this
                ->useCrmAddressRelatedByCrmAccountIdQuery()
                ->filterByPrimaryKeys($crmAddress->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCrmAddressRelatedByCrmAccountId() only accepts arguments of type \models\models\CrmAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmAddressRelatedByCrmAccountId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinCrmAddressRelatedByCrmAccountId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmAddressRelatedByCrmAccountId');

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
            $this->addJoinObject($join, 'CrmAddressRelatedByCrmAccountId');
        }

        return $this;
    }

    /**
     * Use the CrmAddressRelatedByCrmAccountId relation CrmAddress object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmAddressQuery A secondary query class using the current class as primary query
     */
    public function useCrmAddressRelatedByCrmAccountIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmAddressRelatedByCrmAccountId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmAddressRelatedByCrmAccountId', '\models\models\CrmAddressQuery');
    }

    /**
     * Filter the query by a related \models\models\CrmAddress object
     *
     * @param \models\models\CrmAddress|ObjectCollection $crmAddress the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByCrmAddressRelatedByCrmAddressId($crmAddress, $comparison = null)
    {
        if ($crmAddress instanceof \models\models\CrmAddress) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAddress->getCrmAddressId(), $comparison);
        } elseif ($crmAddress instanceof ObjectCollection) {
            return $this
                ->useCrmAddressRelatedByCrmAddressIdQuery()
                ->filterByPrimaryKeys($crmAddress->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCrmAddressRelatedByCrmAddressId() only accepts arguments of type \models\models\CrmAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmAddressRelatedByCrmAddressId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinCrmAddressRelatedByCrmAddressId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmAddressRelatedByCrmAddressId');

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
            $this->addJoinObject($join, 'CrmAddressRelatedByCrmAddressId');
        }

        return $this;
    }

    /**
     * Use the CrmAddressRelatedByCrmAddressId relation CrmAddress object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmAddressQuery A secondary query class using the current class as primary query
     */
    public function useCrmAddressRelatedByCrmAddressIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmAddressRelatedByCrmAddressId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmAddressRelatedByCrmAddressId', '\models\models\CrmAddressQuery');
    }

    /**
     * Filter the query by a related \models\models\CrmEmail object
     *
     * @param \models\models\CrmEmail|ObjectCollection $crmEmail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByCrmEmail($crmEmail, $comparison = null)
    {
        if ($crmEmail instanceof \models\models\CrmEmail) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmEmail->getCrmAccountId(), $comparison);
        } elseif ($crmEmail instanceof ObjectCollection) {
            return $this
                ->useCrmEmailQuery()
                ->filterByPrimaryKeys($crmEmail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCrmEmail() only accepts arguments of type \models\models\CrmEmail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmEmail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinCrmEmail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmEmail');

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
            $this->addJoinObject($join, 'CrmEmail');
        }

        return $this;
    }

    /**
     * Use the CrmEmail relation CrmEmail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmEmailQuery A secondary query class using the current class as primary query
     */
    public function useCrmEmailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmEmail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmEmail', '\models\models\CrmEmailQuery');
    }

    /**
     * Filter the query by a related \models\models\CrmPerson object
     *
     * @param \models\models\CrmPerson|ObjectCollection $crmPerson the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByCrmPerson($crmPerson, $comparison = null)
    {
        if ($crmPerson instanceof \models\models\CrmPerson) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmPerson->getCrmAccountId(), $comparison);
        } elseif ($crmPerson instanceof ObjectCollection) {
            return $this
                ->useCrmPersonQuery()
                ->filterByPrimaryKeys($crmPerson->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCrmPerson() only accepts arguments of type \models\models\CrmPerson or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmPerson relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinCrmPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmPerson');

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
            $this->addJoinObject($join, 'CrmPerson');
        }

        return $this;
    }

    /**
     * Use the CrmPerson relation CrmPerson object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmPersonQuery A secondary query class using the current class as primary query
     */
    public function useCrmPersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmPerson', '\models\models\CrmPersonQuery');
    }

    /**
     * Filter the query by a related \models\models\FinCreditCard object
     *
     * @param \models\models\FinCreditCard|ObjectCollection $finCreditCard the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterByFinCreditCard($finCreditCard, $comparison = null)
    {
        if ($finCreditCard instanceof \models\models\FinCreditCard) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $finCreditCard->getCrmAccountId(), $comparison);
        } elseif ($finCreditCard instanceof ObjectCollection) {
            return $this
                ->useFinCreditCardQuery()
                ->filterByPrimaryKeys($finCreditCard->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFinCreditCard() only accepts arguments of type \models\models\FinCreditCard or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FinCreditCard relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinFinCreditCard($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FinCreditCard');

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
            $this->addJoinObject($join, 'FinCreditCard');
        }

        return $this;
    }

    /**
     * Use the FinCreditCard relation FinCreditCard object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\FinCreditCardQuery A secondary query class using the current class as primary query
     */
    public function useFinCreditCardQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFinCreditCard($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FinCreditCard', '\models\models\FinCreditCardQuery');
    }

    /**
     * Filter the query by a related \models\models\SecRetailerLogin object
     *
     * @param \models\models\SecRetailerLogin|ObjectCollection $secRetailerLogin the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCrmAccountQuery The current query, for fluid interface
     */
    public function filterBySecRetailerLogin($secRetailerLogin, $comparison = null)
    {
        if ($secRetailerLogin instanceof \models\models\SecRetailerLogin) {
            return $this
                ->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $secRetailerLogin->getCrmAccountId(), $comparison);
        } elseif ($secRetailerLogin instanceof ObjectCollection) {
            return $this
                ->useSecRetailerLoginQuery()
                ->filterByPrimaryKeys($secRetailerLogin->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySecRetailerLogin() only accepts arguments of type \models\models\SecRetailerLogin or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SecRetailerLogin relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function joinSecRetailerLogin($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SecRetailerLogin');

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
            $this->addJoinObject($join, 'SecRetailerLogin');
        }

        return $this;
    }

    /**
     * Use the SecRetailerLogin relation SecRetailerLogin object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\SecRetailerLoginQuery A secondary query class using the current class as primary query
     */
    public function useSecRetailerLoginQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSecRetailerLogin($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SecRetailerLogin', '\models\models\SecRetailerLoginQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCrmAccount $crmAccount Object to remove from the list of results
     *
     * @return $this|ChildCrmAccountQuery The current query, for fluid interface
     */
    public function prune($crmAccount = null)
    {
        if ($crmAccount) {
            $this->addUsingAlias(CrmAccountTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmAccountTableMap::clearInstancePool();
            CrmAccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmAccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmAccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmAccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmAccountQuery
