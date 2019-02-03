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
use models\models\FinCreditCard as ChildFinCreditCard;
use models\models\FinCreditCardQuery as ChildFinCreditCardQuery;
use models\models\Map\FinCreditCardTableMap;

/**
 * Base class that represents a query for the 'fin_credit_card' table.
 *
 *
 *
 * @method     ChildFinCreditCardQuery orderByFinCreditCardId($order = Criteria::ASC) Order by the fin_credit_card_id column
 * @method     ChildFinCreditCardQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildFinCreditCardQuery orderByNameOnCard($order = Criteria::ASC) Order by the name_on_card column
 * @method     ChildFinCreditCardQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildFinCreditCardQuery orderBySecurityCode($order = Criteria::ASC) Order by the security_code column
 * @method     ChildFinCreditCardQuery orderByExpirationMonth($order = Criteria::ASC) Order by the expiration_month column
 * @method     ChildFinCreditCardQuery orderByExpirationYear($order = Criteria::ASC) Order by the expiration_year column
 * @method     ChildFinCreditCardQuery orderByAddDate($order = Criteria::ASC) Order by the add_date column
 * @method     ChildFinCreditCardQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildFinCreditCardQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildFinCreditCardQuery groupByFinCreditCardId() Group by the fin_credit_card_id column
 * @method     ChildFinCreditCardQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildFinCreditCardQuery groupByNameOnCard() Group by the name_on_card column
 * @method     ChildFinCreditCardQuery groupByNumber() Group by the number column
 * @method     ChildFinCreditCardQuery groupBySecurityCode() Group by the security_code column
 * @method     ChildFinCreditCardQuery groupByExpirationMonth() Group by the expiration_month column
 * @method     ChildFinCreditCardQuery groupByExpirationYear() Group by the expiration_year column
 * @method     ChildFinCreditCardQuery groupByAddDate() Group by the add_date column
 * @method     ChildFinCreditCardQuery groupByStartDate() Group by the start_date column
 * @method     ChildFinCreditCardQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildFinCreditCardQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFinCreditCardQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFinCreditCardQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFinCreditCardQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFinCreditCardQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFinCreditCardQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFinCreditCardQuery leftJoinCrmAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccount relation
 * @method     ChildFinCreditCardQuery rightJoinCrmAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccount relation
 * @method     ChildFinCreditCardQuery innerJoinCrmAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccount relation
 *
 * @method     ChildFinCreditCardQuery joinWithCrmAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccount relation
 *
 * @method     ChildFinCreditCardQuery leftJoinWithCrmAccount() Adds a LEFT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildFinCreditCardQuery rightJoinWithCrmAccount() Adds a RIGHT JOIN clause and with to the query using the CrmAccount relation
 * @method     ChildFinCreditCardQuery innerJoinWithCrmAccount() Adds a INNER JOIN clause and with to the query using the CrmAccount relation
 *
 * @method     \models\models\CrmAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFinCreditCard findOne(ConnectionInterface $con = null) Return the first ChildFinCreditCard matching the query
 * @method     ChildFinCreditCard findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFinCreditCard matching the query, or a new ChildFinCreditCard object populated from the query conditions when no match is found
 *
 * @method     ChildFinCreditCard findOneByFinCreditCardId(int $fin_credit_card_id) Return the first ChildFinCreditCard filtered by the fin_credit_card_id column
 * @method     ChildFinCreditCard findOneByCrmAccountId(int $crm_account_id) Return the first ChildFinCreditCard filtered by the crm_account_id column
 * @method     ChildFinCreditCard findOneByNameOnCard(string $name_on_card) Return the first ChildFinCreditCard filtered by the name_on_card column
 * @method     ChildFinCreditCard findOneByNumber(string $number) Return the first ChildFinCreditCard filtered by the number column
 * @method     ChildFinCreditCard findOneBySecurityCode(string $security_code) Return the first ChildFinCreditCard filtered by the security_code column
 * @method     ChildFinCreditCard findOneByExpirationMonth(int $expiration_month) Return the first ChildFinCreditCard filtered by the expiration_month column
 * @method     ChildFinCreditCard findOneByExpirationYear(int $expiration_year) Return the first ChildFinCreditCard filtered by the expiration_year column
 * @method     ChildFinCreditCard findOneByAddDate(string $add_date) Return the first ChildFinCreditCard filtered by the add_date column
 * @method     ChildFinCreditCard findOneByStartDate(string $start_date) Return the first ChildFinCreditCard filtered by the start_date column
 * @method     ChildFinCreditCard findOneByEndDate(string $end_date) Return the first ChildFinCreditCard filtered by the end_date column *

 * @method     ChildFinCreditCard requirePk($key, ConnectionInterface $con = null) Return the ChildFinCreditCard by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOne(ConnectionInterface $con = null) Return the first ChildFinCreditCard matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinCreditCard requireOneByFinCreditCardId(int $fin_credit_card_id) Return the first ChildFinCreditCard filtered by the fin_credit_card_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByCrmAccountId(int $crm_account_id) Return the first ChildFinCreditCard filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByNameOnCard(string $name_on_card) Return the first ChildFinCreditCard filtered by the name_on_card column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByNumber(string $number) Return the first ChildFinCreditCard filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneBySecurityCode(string $security_code) Return the first ChildFinCreditCard filtered by the security_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByExpirationMonth(int $expiration_month) Return the first ChildFinCreditCard filtered by the expiration_month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByExpirationYear(int $expiration_year) Return the first ChildFinCreditCard filtered by the expiration_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByAddDate(string $add_date) Return the first ChildFinCreditCard filtered by the add_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByStartDate(string $start_date) Return the first ChildFinCreditCard filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinCreditCard requireOneByEndDate(string $end_date) Return the first ChildFinCreditCard filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinCreditCard[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFinCreditCard objects based on current ModelCriteria
 * @method     ChildFinCreditCard[]|ObjectCollection findByFinCreditCardId(int $fin_credit_card_id) Return ChildFinCreditCard objects filtered by the fin_credit_card_id column
 * @method     ChildFinCreditCard[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildFinCreditCard objects filtered by the crm_account_id column
 * @method     ChildFinCreditCard[]|ObjectCollection findByNameOnCard(string $name_on_card) Return ChildFinCreditCard objects filtered by the name_on_card column
 * @method     ChildFinCreditCard[]|ObjectCollection findByNumber(string $number) Return ChildFinCreditCard objects filtered by the number column
 * @method     ChildFinCreditCard[]|ObjectCollection findBySecurityCode(string $security_code) Return ChildFinCreditCard objects filtered by the security_code column
 * @method     ChildFinCreditCard[]|ObjectCollection findByExpirationMonth(int $expiration_month) Return ChildFinCreditCard objects filtered by the expiration_month column
 * @method     ChildFinCreditCard[]|ObjectCollection findByExpirationYear(int $expiration_year) Return ChildFinCreditCard objects filtered by the expiration_year column
 * @method     ChildFinCreditCard[]|ObjectCollection findByAddDate(string $add_date) Return ChildFinCreditCard objects filtered by the add_date column
 * @method     ChildFinCreditCard[]|ObjectCollection findByStartDate(string $start_date) Return ChildFinCreditCard objects filtered by the start_date column
 * @method     ChildFinCreditCard[]|ObjectCollection findByEndDate(string $end_date) Return ChildFinCreditCard objects filtered by the end_date column
 * @method     ChildFinCreditCard[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FinCreditCardQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\FinCreditCardQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\FinCreditCard', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFinCreditCardQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFinCreditCardQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFinCreditCardQuery) {
            return $criteria;
        }
        $query = new ChildFinCreditCardQuery();
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
     * @return ChildFinCreditCard|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FinCreditCardTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFinCreditCard A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT fin_credit_card_id, crm_account_id, name_on_card, number, security_code, expiration_month, expiration_year, add_date, start_date, end_date FROM fin_credit_card WHERE fin_credit_card_id = :p0';
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
            /** @var ChildFinCreditCard $obj */
            $obj = new ChildFinCreditCard();
            $obj->hydrate($row);
            FinCreditCardTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFinCreditCard|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fin_credit_card_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFinCreditCardId(1234); // WHERE fin_credit_card_id = 1234
     * $query->filterByFinCreditCardId(array(12, 34)); // WHERE fin_credit_card_id IN (12, 34)
     * $query->filterByFinCreditCardId(array('min' => 12)); // WHERE fin_credit_card_id > 12
     * </code>
     *
     * @param     mixed $finCreditCardId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByFinCreditCardId($finCreditCardId = null, $comparison = null)
    {
        if (is_array($finCreditCardId)) {
            $useMinMax = false;
            if (isset($finCreditCardId['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $finCreditCardId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finCreditCardId['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $finCreditCardId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $finCreditCardId, $comparison);
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
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the name_on_card column
     *
     * Example usage:
     * <code>
     * $query->filterByNameOnCard('fooValue');   // WHERE name_on_card = 'fooValue'
     * $query->filterByNameOnCard('%fooValue%', Criteria::LIKE); // WHERE name_on_card LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameOnCard The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByNameOnCard($nameOnCard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameOnCard)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_NAME_ON_CARD, $nameOnCard, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterByNumber('%fooValue%', Criteria::LIKE); // WHERE number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $number The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the security_code column
     *
     * Example usage:
     * <code>
     * $query->filterBySecurityCode('fooValue');   // WHERE security_code = 'fooValue'
     * $query->filterBySecurityCode('%fooValue%', Criteria::LIKE); // WHERE security_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $securityCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterBySecurityCode($securityCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($securityCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_SECURITY_CODE, $securityCode, $comparison);
    }

    /**
     * Filter the query on the expiration_month column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationMonth(1234); // WHERE expiration_month = 1234
     * $query->filterByExpirationMonth(array(12, 34)); // WHERE expiration_month IN (12, 34)
     * $query->filterByExpirationMonth(array('min' => 12)); // WHERE expiration_month > 12
     * </code>
     *
     * @param     mixed $expirationMonth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByExpirationMonth($expirationMonth = null, $comparison = null)
    {
        if (is_array($expirationMonth)) {
            $useMinMax = false;
            if (isset($expirationMonth['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_MONTH, $expirationMonth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationMonth['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_MONTH, $expirationMonth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_MONTH, $expirationMonth, $comparison);
    }

    /**
     * Filter the query on the expiration_year column
     *
     * Example usage:
     * <code>
     * $query->filterByExpirationYear(1234); // WHERE expiration_year = 1234
     * $query->filterByExpirationYear(array(12, 34)); // WHERE expiration_year IN (12, 34)
     * $query->filterByExpirationYear(array('min' => 12)); // WHERE expiration_year > 12
     * </code>
     *
     * @param     mixed $expirationYear The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByExpirationYear($expirationYear = null, $comparison = null)
    {
        if (is_array($expirationYear)) {
            $useMinMax = false;
            if (isset($expirationYear['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_YEAR, $expirationYear['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expirationYear['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_YEAR, $expirationYear['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_EXPIRATION_YEAR, $expirationYear, $comparison);
    }

    /**
     * Filter the query on the add_date column
     *
     * Example usage:
     * <code>
     * $query->filterByAddDate('2011-03-14'); // WHERE add_date = '2011-03-14'
     * $query->filterByAddDate('now'); // WHERE add_date = '2011-03-14'
     * $query->filterByAddDate(array('max' => 'yesterday')); // WHERE add_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $addDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByAddDate($addDate = null, $comparison = null)
    {
        if (is_array($addDate)) {
            $useMinMax = false;
            if (isset($addDate['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_ADD_DATE, $addDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addDate['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_ADD_DATE, $addDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_ADD_DATE, $addDate, $comparison);
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
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_START_DATE, $startDate, $comparison);
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
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(FinCreditCardTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinCreditCardTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function filterByCrmAccount($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FinCreditCardTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
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
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
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
     * @param   ChildFinCreditCard $finCreditCard Object to remove from the list of results
     *
     * @return $this|ChildFinCreditCardQuery The current query, for fluid interface
     */
    public function prune($finCreditCard = null)
    {
        if ($finCreditCard) {
            $this->addUsingAlias(FinCreditCardTableMap::COL_FIN_CREDIT_CARD_ID, $finCreditCard->getFinCreditCardId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fin_credit_card table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FinCreditCardTableMap::clearInstancePool();
            FinCreditCardTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FinCreditCardTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FinCreditCardTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FinCreditCardTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FinCreditCardTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FinCreditCardQuery
