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
use models\models\CrmPerson as ChildCrmPerson;
use models\models\CrmPersonQuery as ChildCrmPersonQuery;
use models\models\Map\CrmPersonTableMap;

/**
 * Base class that represents a query for the 'crm_person' table.
 *
 *
 *
 * @method     ChildCrmPersonQuery orderByCrmPersonId($order = Criteria::ASC) Order by the crm_person_id column
 * @method     ChildCrmPersonQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildCrmPersonQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildCrmPersonQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildCrmPersonQuery orderByMiddleName($order = Criteria::ASC) Order by the middle_name column
 * @method     ChildCrmPersonQuery orderByBirthday($order = Criteria::ASC) Order by the birthday column
 * @method     ChildCrmPersonQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildCrmPersonQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 *
 * @method     ChildCrmPersonQuery groupByCrmPersonId() Group by the crm_person_id column
 * @method     ChildCrmPersonQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildCrmPersonQuery groupByFirstName() Group by the first_name column
 * @method     ChildCrmPersonQuery groupByLastName() Group by the last_name column
 * @method     ChildCrmPersonQuery groupByMiddleName() Group by the middle_name column
 * @method     ChildCrmPersonQuery groupByBirthday() Group by the birthday column
 * @method     ChildCrmPersonQuery groupByGender() Group by the gender column
 * @method     ChildCrmPersonQuery groupByPhoneNumber() Group by the phone_number column
 *
 * @method     ChildCrmPersonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmPersonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmPersonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmPersonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmPersonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmPersonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmPersonQuery leftJoinCrmAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccount relation
 * @method     ChildCrmPersonQuery rightJoinCrmAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccount relation
 * @method     ChildCrmPersonQuery innerJoinCrmAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccount relation
 *
 * @method     ChildCrmPersonQuery joinWithCrmAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccount relation
 *
 * @method     ChildCrmPersonQuery leftJoinWithCrmAccount() Adds a LEFT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildCrmPersonQuery rightJoinWithCrmAccount() Adds a RIGHT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildCrmPersonQuery innerJoinWithCrmAccount() Adds a INNER JOIN clause and with to the query using the CrmAccount relation
 *
 * @method     \models\models\CrmAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCrmPerson findOne(ConnectionInterface $con = null) Return the first ChildCrmPerson matching the query
 * @method     ChildCrmPerson findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmPerson matching the query, or a new ChildCrmPerson object populated from the query conditions when no match is found
 *
 * @method     ChildCrmPerson findOneByCrmPersonId(int $crm_person_id) Return the first ChildCrmPerson filtered by the crm_person_id column
 * @method     ChildCrmPerson findOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmPerson filtered by the crm_account_id column
 * @method     ChildCrmPerson findOneByFirstName(string $first_name) Return the first ChildCrmPerson filtered by the first_name column
 * @method     ChildCrmPerson findOneByLastName(string $last_name) Return the first ChildCrmPerson filtered by the last_name column
 * @method     ChildCrmPerson findOneByMiddleName(string $middle_name) Return the first ChildCrmPerson filtered by the middle_name column
 * @method     ChildCrmPerson findOneByBirthday(string $birthday) Return the first ChildCrmPerson filtered by the birthday column
 * @method     ChildCrmPerson findOneByGender(string $gender) Return the first ChildCrmPerson filtered by the gender column
 * @method     ChildCrmPerson findOneByPhoneNumber(string $phone_number) Return the first ChildCrmPerson filtered by the phone_number column *

 * @method     ChildCrmPerson requirePk($key, ConnectionInterface $con = null) Return the ChildCrmPerson by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOne(ConnectionInterface $con = null) Return the first ChildCrmPerson matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmPerson requireOneByCrmPersonId(int $crm_person_id) Return the first ChildCrmPerson filtered by the crm_person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmPerson filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByFirstName(string $first_name) Return the first ChildCrmPerson filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByLastName(string $last_name) Return the first ChildCrmPerson filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByMiddleName(string $middle_name) Return the first ChildCrmPerson filtered by the middle_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByBirthday(string $birthday) Return the first ChildCrmPerson filtered by the birthday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByGender(string $gender) Return the first ChildCrmPerson filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmPerson requireOneByPhoneNumber(string $phone_number) Return the first ChildCrmPerson filtered by the phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmPerson[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmPerson objects based on current ModelCriteria
 * @method     ChildCrmPerson[]|ObjectCollection findByCrmPersonId(int $crm_person_id) Return ChildCrmPerson objects filtered by the crm_person_id column
 * @method     ChildCrmPerson[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildCrmPerson objects filtered by the crm_account_id column
 * @method     ChildCrmPerson[]|ObjectCollection findByFirstName(string $first_name) Return ChildCrmPerson objects filtered by the first_name column
 * @method     ChildCrmPerson[]|ObjectCollection findByLastName(string $last_name) Return ChildCrmPerson objects filtered by the last_name column
 * @method     ChildCrmPerson[]|ObjectCollection findByMiddleName(string $middle_name) Return ChildCrmPerson objects filtered by the middle_name column
 * @method     ChildCrmPerson[]|ObjectCollection findByBirthday(string $birthday) Return ChildCrmPerson objects filtered by the birthday column
 * @method     ChildCrmPerson[]|ObjectCollection findByGender(string $gender) Return ChildCrmPerson objects filtered by the gender column
 * @method     ChildCrmPerson[]|ObjectCollection findByPhoneNumber(string $phone_number) Return ChildCrmPerson objects filtered by the phone_number column
 * @method     ChildCrmPerson[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmPersonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmPersonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmPerson', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmPersonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmPersonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmPersonQuery) {
            return $criteria;
        }
        $query = new ChildCrmPersonQuery();
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
     * @return ChildCrmPerson|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmPersonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CrmPersonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCrmPerson A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT crm_person_id, crm_account_id, first_name, last_name, middle_name, birthday, gender, phone_number FROM crm_person WHERE crm_person_id = :p0';
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
            /** @var ChildCrmPerson $obj */
            $obj = new ChildCrmPerson();
            $obj->hydrate($row);
            CrmPersonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCrmPerson|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the crm_person_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCrmPersonId(1234); // WHERE crm_person_id = 1234
     * $query->filterByCrmPersonId(array(12, 34)); // WHERE crm_person_id IN (12, 34)
     * $query->filterByCrmPersonId(array('min' => 12)); // WHERE crm_person_id > 12
     * </code>
     *
     * @param     mixed $crmPersonId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByCrmPersonId($crmPersonId = null, $comparison = null)
    {
        if (is_array($crmPersonId)) {
            $useMinMax = false;
            if (isset($crmPersonId['min'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $crmPersonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmPersonId['max'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $crmPersonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $crmPersonId, $comparison);
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
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the middle_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleName('fooValue');   // WHERE middle_name = 'fooValue'
     * $query->filterByMiddleName('%fooValue%', Criteria::LIKE); // WHERE middle_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $middleName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByMiddleName($middleName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($middleName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_MIDDLE_NAME, $middleName, $comparison);
    }

    /**
     * Filter the query on the birthday column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthday('2011-03-14'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday('now'); // WHERE birthday = '2011-03-14'
     * $query->filterByBirthday(array('max' => 'yesterday')); // WHERE birthday > '2011-03-13'
     * </code>
     *
     * @param     mixed $birthday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByBirthday($birthday = null, $comparison = null)
    {
        if (is_array($birthday)) {
            $useMinMax = false;
            if (isset($birthday['min'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_BIRTHDAY, $birthday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthday['max'])) {
                $this->addUsingAlias(CrmPersonTableMap::COL_BIRTHDAY, $birthday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_BIRTHDAY, $birthday, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
     * $query->filterByPhoneNumber('%fooValue%', Criteria::LIKE); // WHERE phone_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmPersonTableMap::COL_PHONE_NUMBER, $phoneNumber, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCrmPersonQuery The current query, for fluid interface
     */
    public function filterByCrmAccount($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(CrmPersonTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CrmPersonTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
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
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
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
     * @param   ChildCrmPerson $crmPerson Object to remove from the list of results
     *
     * @return $this|ChildCrmPersonQuery The current query, for fluid interface
     */
    public function prune($crmPerson = null)
    {
        if ($crmPerson) {
            $this->addUsingAlias(CrmPersonTableMap::COL_CRM_PERSON_ID, $crmPerson->getCrmPersonId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_person table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmPersonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmPersonTableMap::clearInstancePool();
            CrmPersonTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmPersonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmPersonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmPersonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmPersonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmPersonQuery
