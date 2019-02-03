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
use models\models\CrmAddress as ChildCrmAddress;
use models\models\CrmAddressQuery as ChildCrmAddressQuery;
use models\models\Map\CrmAddressTableMap;

/**
 * Base class that represents a query for the 'crm_address' table.
 *
 *
 *
 * @method     ChildCrmAddressQuery orderByCrmAddressId($order = Criteria::ASC) Order by the crm_address_id column
 * @method     ChildCrmAddressQuery orderByCrmAccountId($order = Criteria::ASC) Order by the crm_account_id column
 * @method     ChildCrmAddressQuery orderByStreet1($order = Criteria::ASC) Order by the street1 column
 * @method     ChildCrmAddressQuery orderByStreet2($order = Criteria::ASC) Order by the street2 column
 * @method     ChildCrmAddressQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildCrmAddressQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildCrmAddressQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method     ChildCrmAddressQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildCrmAddressQuery orderByIsBilling($order = Criteria::ASC) Order by the is_billing column
 * @method     ChildCrmAddressQuery orderByBillingFirstName($order = Criteria::ASC) Order by the billing_first_name column
 * @method     ChildCrmAddressQuery orderByBillingLastName($order = Criteria::ASC) Order by the billing_last_name column
 * @method     ChildCrmAddressQuery orderByIsShipping($order = Criteria::ASC) Order by the is_shipping column
 * @method     ChildCrmAddressQuery orderByShippingFirstName($order = Criteria::ASC) Order by the shipping_first_name column
 * @method     ChildCrmAddressQuery orderByShippingLastName($order = Criteria::ASC) Order by the shipping_last_name column
 * @method     ChildCrmAddressQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildCrmAddressQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildCrmAddressQuery groupByCrmAddressId() Group by the crm_address_id column
 * @method     ChildCrmAddressQuery groupByCrmAccountId() Group by the crm_account_id column
 * @method     ChildCrmAddressQuery groupByStreet1() Group by the street1 column
 * @method     ChildCrmAddressQuery groupByStreet2() Group by the street2 column
 * @method     ChildCrmAddressQuery groupByCity() Group by the city column
 * @method     ChildCrmAddressQuery groupByState() Group by the state column
 * @method     ChildCrmAddressQuery groupByZip() Group by the zip column
 * @method     ChildCrmAddressQuery groupByCountry() Group by the country column
 * @method     ChildCrmAddressQuery groupByIsBilling() Group by the is_billing column
 * @method     ChildCrmAddressQuery groupByBillingFirstName() Group by the billing_first_name column
 * @method     ChildCrmAddressQuery groupByBillingLastName() Group by the billing_last_name column
 * @method     ChildCrmAddressQuery groupByIsShipping() Group by the is_shipping column
 * @method     ChildCrmAddressQuery groupByShippingFirstName() Group by the shipping_first_name column
 * @method     ChildCrmAddressQuery groupByShippingLastName() Group by the shipping_last_name column
 * @method     ChildCrmAddressQuery groupByStartDate() Group by the start_date column
 * @method     ChildCrmAddressQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildCrmAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmAddressQuery leftJoinCrmAccountRelatedByCrmAccountId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccountRelatedByCrmAccountId relation
 * @method     ChildCrmAddressQuery rightJoinCrmAccountRelatedByCrmAccountId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccountRelatedByCrmAccountId relation
 * @method     ChildCrmAddressQuery innerJoinCrmAccountRelatedByCrmAccountId($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccountRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAddressQuery joinWithCrmAccountRelatedByCrmAccountId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccountRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAddressQuery leftJoinWithCrmAccountRelatedByCrmAccountId() Adds a LEFT JOIN clause and with to the query using the CrmAccountRelatedByCrmAccountId relation
 * @method     ChildCrmAddressQuery rightJoinWithCrmAccountRelatedByCrmAccountId() Adds a RIGHT JOIN clause and with to the query using the CrmAccountRelatedByCrmAccountId relation
 * @method     ChildCrmAddressQuery innerJoinWithCrmAccountRelatedByCrmAccountId() Adds a INNER JOIN clause and with to the query using the CrmAccountRelatedByCrmAccountId relation
 *
 * @method     ChildCrmAddressQuery leftJoinCrmAccountRelatedByCrmAddressId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CrmAccountRelatedByCrmAddressId relation
 * @method     ChildCrmAddressQuery rightJoinCrmAccountRelatedByCrmAddressId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CrmAccountRelatedByCrmAddressId relation
 * @method     ChildCrmAddressQuery innerJoinCrmAccountRelatedByCrmAddressId($relationAlias = null) Adds a INNER JOIN clause to the query using the CrmAccountRelatedByCrmAddressId relation
 *
 * @method     ChildCrmAddressQuery joinWithCrmAccountRelatedByCrmAddressId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CrmAccountRelatedByCrmAddressId relation
 *
 * @method     ChildCrmAddressQuery leftJoinWithCrmAccountRelatedByCrmAddressId() Adds a LEFT JOIN clause and with to the query using the CrmAccountRelatedByCrmAddressId relation
 * @method     ChildCrmAddressQuery rightJoinWithCrmAccountRelatedByCrmAddressId() Adds a RIGHT JOIN clause and with to the query using the CrmAccountRelatedByCrmAddressId relation
 * @method     ChildCrmAddressQuery innerJoinWithCrmAccountRelatedByCrmAddressId() Adds a INNER JOIN clause and with to the query using the CrmAccountRelatedByCrmAddressId relation
 *
 * @method     \models\models\CrmAccountQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCrmAddress findOne(ConnectionInterface $con = null) Return the first ChildCrmAddress matching the query
 * @method     ChildCrmAddress findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmAddress matching the query, or a new ChildCrmAddress object populated from the query conditions when no match is found
 *
 * @method     ChildCrmAddress findOneByCrmAddressId(int $crm_address_id) Return the first ChildCrmAddress filtered by the crm_address_id column
 * @method     ChildCrmAddress findOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmAddress filtered by the crm_account_id column
 * @method     ChildCrmAddress findOneByStreet1(string $street1) Return the first ChildCrmAddress filtered by the street1 column
 * @method     ChildCrmAddress findOneByStreet2(string $street2) Return the first ChildCrmAddress filtered by the street2 column
 * @method     ChildCrmAddress findOneByCity(string $city) Return the first ChildCrmAddress filtered by the city column
 * @method     ChildCrmAddress findOneByState(string $state) Return the first ChildCrmAddress filtered by the state column
 * @method     ChildCrmAddress findOneByZip(string $zip) Return the first ChildCrmAddress filtered by the zip column
 * @method     ChildCrmAddress findOneByCountry(string $country) Return the first ChildCrmAddress filtered by the country column
 * @method     ChildCrmAddress findOneByIsBilling(boolean $is_billing) Return the first ChildCrmAddress filtered by the is_billing column
 * @method     ChildCrmAddress findOneByBillingFirstName(string $billing_first_name) Return the first ChildCrmAddress filtered by the billing_first_name column
 * @method     ChildCrmAddress findOneByBillingLastName(string $billing_last_name) Return the first ChildCrmAddress filtered by the billing_last_name column
 * @method     ChildCrmAddress findOneByIsShipping(boolean $is_shipping) Return the first ChildCrmAddress filtered by the is_shipping column
 * @method     ChildCrmAddress findOneByShippingFirstName(string $shipping_first_name) Return the first ChildCrmAddress filtered by the shipping_first_name column
 * @method     ChildCrmAddress findOneByShippingLastName(string $shipping_last_name) Return the first ChildCrmAddress filtered by the shipping_last_name column
 * @method     ChildCrmAddress findOneByStartDate(string $start_date) Return the first ChildCrmAddress filtered by the start_date column
 * @method     ChildCrmAddress findOneByEndDate(string $end_date) Return the first ChildCrmAddress filtered by the end_date column *

 * @method     ChildCrmAddress requirePk($key, ConnectionInterface $con = null) Return the ChildCrmAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOne(ConnectionInterface $con = null) Return the first ChildCrmAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmAddress requireOneByCrmAddressId(int $crm_address_id) Return the first ChildCrmAddress filtered by the crm_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByCrmAccountId(int $crm_account_id) Return the first ChildCrmAddress filtered by the crm_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByStreet1(string $street1) Return the first ChildCrmAddress filtered by the street1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByStreet2(string $street2) Return the first ChildCrmAddress filtered by the street2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByCity(string $city) Return the first ChildCrmAddress filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByState(string $state) Return the first ChildCrmAddress filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByZip(string $zip) Return the first ChildCrmAddress filtered by the zip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByCountry(string $country) Return the first ChildCrmAddress filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByIsBilling(boolean $is_billing) Return the first ChildCrmAddress filtered by the is_billing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByBillingFirstName(string $billing_first_name) Return the first ChildCrmAddress filtered by the billing_first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByBillingLastName(string $billing_last_name) Return the first ChildCrmAddress filtered by the billing_last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByIsShipping(boolean $is_shipping) Return the first ChildCrmAddress filtered by the is_shipping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByShippingFirstName(string $shipping_first_name) Return the first ChildCrmAddress filtered by the shipping_first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByShippingLastName(string $shipping_last_name) Return the first ChildCrmAddress filtered by the shipping_last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByStartDate(string $start_date) Return the first ChildCrmAddress filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmAddress requireOneByEndDate(string $end_date) Return the first ChildCrmAddress filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmAddress[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmAddress objects based on current ModelCriteria
 * @method     ChildCrmAddress[]|ObjectCollection findByCrmAddressId(int $crm_address_id) Return ChildCrmAddress objects filtered by the crm_address_id column
 * @method     ChildCrmAddress[]|ObjectCollection findByCrmAccountId(int $crm_account_id) Return ChildCrmAddress objects filtered by the crm_account_id column
 * @method     ChildCrmAddress[]|ObjectCollection findByStreet1(string $street1) Return ChildCrmAddress objects filtered by the street1 column
 * @method     ChildCrmAddress[]|ObjectCollection findByStreet2(string $street2) Return ChildCrmAddress objects filtered by the street2 column
 * @method     ChildCrmAddress[]|ObjectCollection findByCity(string $city) Return ChildCrmAddress objects filtered by the city column
 * @method     ChildCrmAddress[]|ObjectCollection findByState(string $state) Return ChildCrmAddress objects filtered by the state column
 * @method     ChildCrmAddress[]|ObjectCollection findByZip(string $zip) Return ChildCrmAddress objects filtered by the zip column
 * @method     ChildCrmAddress[]|ObjectCollection findByCountry(string $country) Return ChildCrmAddress objects filtered by the country column
 * @method     ChildCrmAddress[]|ObjectCollection findByIsBilling(boolean $is_billing) Return ChildCrmAddress objects filtered by the is_billing column
 * @method     ChildCrmAddress[]|ObjectCollection findByBillingFirstName(string $billing_first_name) Return ChildCrmAddress objects filtered by the billing_first_name column
 * @method     ChildCrmAddress[]|ObjectCollection findByBillingLastName(string $billing_last_name) Return ChildCrmAddress objects filtered by the billing_last_name column
 * @method     ChildCrmAddress[]|ObjectCollection findByIsShipping(boolean $is_shipping) Return ChildCrmAddress objects filtered by the is_shipping column
 * @method     ChildCrmAddress[]|ObjectCollection findByShippingFirstName(string $shipping_first_name) Return ChildCrmAddress objects filtered by the shipping_first_name column
 * @method     ChildCrmAddress[]|ObjectCollection findByShippingLastName(string $shipping_last_name) Return ChildCrmAddress objects filtered by the shipping_last_name column
 * @method     ChildCrmAddress[]|ObjectCollection findByStartDate(string $start_date) Return ChildCrmAddress objects filtered by the start_date column
 * @method     ChildCrmAddress[]|ObjectCollection findByEndDate(string $end_date) Return ChildCrmAddress objects filtered by the end_date column
 * @method     ChildCrmAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmAddressQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmAddressQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmAddressQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmAddressQuery) {
            return $criteria;
        }
        $query = new ChildCrmAddressQuery();
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
     * @return ChildCrmAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CrmAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCrmAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT crm_address_id, crm_account_id, street1, street2, city, state, zip, country, is_billing, billing_first_name, billing_last_name, is_shipping, shipping_first_name, shipping_last_name, start_date, end_date FROM crm_address WHERE crm_address_id = :p0';
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
            /** @var ChildCrmAddress $obj */
            $obj = new ChildCrmAddress();
            $obj->hydrate($row);
            CrmAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCrmAddress|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the crm_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCrmAddressId(1234); // WHERE crm_address_id = 1234
     * $query->filterByCrmAddressId(array(12, 34)); // WHERE crm_address_id IN (12, 34)
     * $query->filterByCrmAddressId(array('min' => 12)); // WHERE crm_address_id > 12
     * </code>
     *
     * @see       filterByCrmAccountRelatedByCrmAddressId()
     *
     * @param     mixed $crmAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCrmAddressId($crmAddressId = null, $comparison = null)
    {
        if (is_array($crmAddressId)) {
            $useMinMax = false;
            if (isset($crmAddressId['min'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAddressId['max'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAddressId, $comparison);
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
     * @see       filterByCrmAccountRelatedByCrmAccountId()
     *
     * @param     mixed $crmAccountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCrmAccountId($crmAccountId = null, $comparison = null)
    {
        if (is_array($crmAccountId)) {
            $useMinMax = false;
            if (isset($crmAccountId['min'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($crmAccountId['max'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $crmAccountId, $comparison);
    }

    /**
     * Filter the query on the street1 column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet1('fooValue');   // WHERE street1 = 'fooValue'
     * $query->filterByStreet1('%fooValue%', Criteria::LIKE); // WHERE street1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $street1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByStreet1($street1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_STREET1, $street1, $comparison);
    }

    /**
     * Filter the query on the street2 column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet2('fooValue');   // WHERE street2 = 'fooValue'
     * $query->filterByStreet2('%fooValue%', Criteria::LIKE); // WHERE street2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $street2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByStreet2($street2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_STREET2, $street2, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%', Criteria::LIKE); // WHERE state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $state The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the zip column
     *
     * Example usage:
     * <code>
     * $query->filterByZip('fooValue');   // WHERE zip = 'fooValue'
     * $query->filterByZip('%fooValue%', Criteria::LIKE); // WHERE zip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zip The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByZip($zip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zip)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_ZIP, $zip, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the is_billing column
     *
     * Example usage:
     * <code>
     * $query->filterByIsBilling(true); // WHERE is_billing = true
     * $query->filterByIsBilling('yes'); // WHERE is_billing = true
     * </code>
     *
     * @param     boolean|string $isBilling The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByIsBilling($isBilling = null, $comparison = null)
    {
        if (is_string($isBilling)) {
            $isBilling = in_array(strtolower($isBilling), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_IS_BILLING, $isBilling, $comparison);
    }

    /**
     * Filter the query on the billing_first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingFirstName('fooValue');   // WHERE billing_first_name = 'fooValue'
     * $query->filterByBillingFirstName('%fooValue%', Criteria::LIKE); // WHERE billing_first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingFirstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByBillingFirstName($billingFirstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingFirstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_BILLING_FIRST_NAME, $billingFirstName, $comparison);
    }

    /**
     * Filter the query on the billing_last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBillingLastName('fooValue');   // WHERE billing_last_name = 'fooValue'
     * $query->filterByBillingLastName('%fooValue%', Criteria::LIKE); // WHERE billing_last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $billingLastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByBillingLastName($billingLastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($billingLastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_BILLING_LAST_NAME, $billingLastName, $comparison);
    }

    /**
     * Filter the query on the is_shipping column
     *
     * Example usage:
     * <code>
     * $query->filterByIsShipping(true); // WHERE is_shipping = true
     * $query->filterByIsShipping('yes'); // WHERE is_shipping = true
     * </code>
     *
     * @param     boolean|string $isShipping The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByIsShipping($isShipping = null, $comparison = null)
    {
        if (is_string($isShipping)) {
            $isShipping = in_array(strtolower($isShipping), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_IS_SHIPPING, $isShipping, $comparison);
    }

    /**
     * Filter the query on the shipping_first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingFirstName('fooValue');   // WHERE shipping_first_name = 'fooValue'
     * $query->filterByShippingFirstName('%fooValue%', Criteria::LIKE); // WHERE shipping_first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shippingFirstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByShippingFirstName($shippingFirstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shippingFirstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_SHIPPING_FIRST_NAME, $shippingFirstName, $comparison);
    }

    /**
     * Filter the query on the shipping_last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingLastName('fooValue');   // WHERE shipping_last_name = 'fooValue'
     * $query->filterByShippingLastName('%fooValue%', Criteria::LIKE); // WHERE shipping_last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shippingLastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByShippingLastName($shippingLastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shippingLastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_SHIPPING_LAST_NAME, $shippingLastName, $comparison);
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
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_START_DATE, $startDate, $comparison);
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
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(CrmAddressTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmAddressTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCrmAccountRelatedByCrmAccountId($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CrmAddressTableMap::COL_CRM_ACCOUNT_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
        } else {
            throw new PropelException('filterByCrmAccountRelatedByCrmAccountId() only accepts arguments of type \models\models\CrmAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmAccountRelatedByCrmAccountId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function joinCrmAccountRelatedByCrmAccountId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmAccountRelatedByCrmAccountId');

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
            $this->addJoinObject($join, 'CrmAccountRelatedByCrmAccountId');
        }

        return $this;
    }

    /**
     * Use the CrmAccountRelatedByCrmAccountId relation CrmAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmAccountQuery A secondary query class using the current class as primary query
     */
    public function useCrmAccountRelatedByCrmAccountIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmAccountRelatedByCrmAccountId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmAccountRelatedByCrmAccountId', '\models\models\CrmAccountQuery');
    }

    /**
     * Filter the query by a related \models\models\CrmAccount object
     *
     * @param \models\models\CrmAccount|ObjectCollection $crmAccount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCrmAddressQuery The current query, for fluid interface
     */
    public function filterByCrmAccountRelatedByCrmAddressId($crmAccount, $comparison = null)
    {
        if ($crmAccount instanceof \models\models\CrmAccount) {
            return $this
                ->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAccount->getCrmAccountId(), $comparison);
        } elseif ($crmAccount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAccount->toKeyValue('PrimaryKey', 'CrmAccountId'), $comparison);
        } else {
            throw new PropelException('filterByCrmAccountRelatedByCrmAddressId() only accepts arguments of type \models\models\CrmAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CrmAccountRelatedByCrmAddressId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function joinCrmAccountRelatedByCrmAddressId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CrmAccountRelatedByCrmAddressId');

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
            $this->addJoinObject($join, 'CrmAccountRelatedByCrmAddressId');
        }

        return $this;
    }

    /**
     * Use the CrmAccountRelatedByCrmAddressId relation CrmAccount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\CrmAccountQuery A secondary query class using the current class as primary query
     */
    public function useCrmAccountRelatedByCrmAddressIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCrmAccountRelatedByCrmAddressId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CrmAccountRelatedByCrmAddressId', '\models\models\CrmAccountQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCrmAddress $crmAddress Object to remove from the list of results
     *
     * @return $this|ChildCrmAddressQuery The current query, for fluid interface
     */
    public function prune($crmAddress = null)
    {
        if ($crmAddress) {
            $this->addUsingAlias(CrmAddressTableMap::COL_CRM_ADDRESS_ID, $crmAddress->getCrmAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmAddressTableMap::clearInstancePool();
            CrmAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmAddressQuery
