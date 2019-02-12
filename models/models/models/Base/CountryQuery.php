<?php

namespace models\models\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use models\models\Country as ChildCountry;
use models\models\CountryQuery as ChildCountryQuery;
use models\models\Map\CountryTableMap;

/**
 * Base class that represents a query for the 'country' table.
 *
 *
 *
 * @method     ChildCountryQuery orderByCode($order = Criteria::ASC) Order by the Code column
 * @method     ChildCountryQuery orderByName($order = Criteria::ASC) Order by the Name column
 * @method     ChildCountryQuery orderByContinent($order = Criteria::ASC) Order by the Continent column
 * @method     ChildCountryQuery orderByRegion($order = Criteria::ASC) Order by the Region column
 * @method     ChildCountryQuery orderBySurfacearea($order = Criteria::ASC) Order by the SurfaceArea column
 * @method     ChildCountryQuery orderByIndepyear($order = Criteria::ASC) Order by the IndepYear column
 * @method     ChildCountryQuery orderByPopulation($order = Criteria::ASC) Order by the Population column
 * @method     ChildCountryQuery orderByLifeexpectancy($order = Criteria::ASC) Order by the LifeExpectancy column
 * @method     ChildCountryQuery orderByGnp($order = Criteria::ASC) Order by the GNP column
 * @method     ChildCountryQuery orderByGnpold($order = Criteria::ASC) Order by the GNPOld column
 * @method     ChildCountryQuery orderByLocalname($order = Criteria::ASC) Order by the LocalName column
 * @method     ChildCountryQuery orderByGovernmentform($order = Criteria::ASC) Order by the GovernmentForm column
 * @method     ChildCountryQuery orderByHeadofstate($order = Criteria::ASC) Order by the HeadOfState column
 * @method     ChildCountryQuery orderByCapital($order = Criteria::ASC) Order by the Capital column
 * @method     ChildCountryQuery orderByCode2($order = Criteria::ASC) Order by the Code2 column
 *
 * @method     ChildCountryQuery groupByCode() Group by the Code column
 * @method     ChildCountryQuery groupByName() Group by the Name column
 * @method     ChildCountryQuery groupByContinent() Group by the Continent column
 * @method     ChildCountryQuery groupByRegion() Group by the Region column
 * @method     ChildCountryQuery groupBySurfacearea() Group by the SurfaceArea column
 * @method     ChildCountryQuery groupByIndepyear() Group by the IndepYear column
 * @method     ChildCountryQuery groupByPopulation() Group by the Population column
 * @method     ChildCountryQuery groupByLifeexpectancy() Group by the LifeExpectancy column
 * @method     ChildCountryQuery groupByGnp() Group by the GNP column
 * @method     ChildCountryQuery groupByGnpold() Group by the GNPOld column
 * @method     ChildCountryQuery groupByLocalname() Group by the LocalName column
 * @method     ChildCountryQuery groupByGovernmentform() Group by the GovernmentForm column
 * @method     ChildCountryQuery groupByHeadofstate() Group by the HeadOfState column
 * @method     ChildCountryQuery groupByCapital() Group by the Capital column
 * @method     ChildCountryQuery groupByCode2() Group by the Code2 column
 *
 * @method     ChildCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCountry findOne(ConnectionInterface $con = null) Return the first ChildCountry matching the query
 * @method     ChildCountry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCountry matching the query, or a new ChildCountry object populated from the query conditions when no match is found
 *
 * @method     ChildCountry findOneByCode(string $Code) Return the first ChildCountry filtered by the Code column
 * @method     ChildCountry findOneByName(string $Name) Return the first ChildCountry filtered by the Name column
 * @method     ChildCountry findOneByContinent(string $Continent) Return the first ChildCountry filtered by the Continent column
 * @method     ChildCountry findOneByRegion(string $Region) Return the first ChildCountry filtered by the Region column
 * @method     ChildCountry findOneBySurfacearea(double $SurfaceArea) Return the first ChildCountry filtered by the SurfaceArea column
 * @method     ChildCountry findOneByIndepyear(int $IndepYear) Return the first ChildCountry filtered by the IndepYear column
 * @method     ChildCountry findOneByPopulation(int $Population) Return the first ChildCountry filtered by the Population column
 * @method     ChildCountry findOneByLifeexpectancy(double $LifeExpectancy) Return the first ChildCountry filtered by the LifeExpectancy column
 * @method     ChildCountry findOneByGnp(double $GNP) Return the first ChildCountry filtered by the GNP column
 * @method     ChildCountry findOneByGnpold(double $GNPOld) Return the first ChildCountry filtered by the GNPOld column
 * @method     ChildCountry findOneByLocalname(string $LocalName) Return the first ChildCountry filtered by the LocalName column
 * @method     ChildCountry findOneByGovernmentform(string $GovernmentForm) Return the first ChildCountry filtered by the GovernmentForm column
 * @method     ChildCountry findOneByHeadofstate(string $HeadOfState) Return the first ChildCountry filtered by the HeadOfState column
 * @method     ChildCountry findOneByCapital(int $Capital) Return the first ChildCountry filtered by the Capital column
 * @method     ChildCountry findOneByCode2(string $Code2) Return the first ChildCountry filtered by the Code2 column *

 * @method     ChildCountry requirePk($key, ConnectionInterface $con = null) Return the ChildCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOne(ConnectionInterface $con = null) Return the first ChildCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountry requireOneByCode(string $Code) Return the first ChildCountry filtered by the Code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByName(string $Name) Return the first ChildCountry filtered by the Name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByContinent(string $Continent) Return the first ChildCountry filtered by the Continent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByRegion(string $Region) Return the first ChildCountry filtered by the Region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneBySurfacearea(double $SurfaceArea) Return the first ChildCountry filtered by the SurfaceArea column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByIndepyear(int $IndepYear) Return the first ChildCountry filtered by the IndepYear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByPopulation(int $Population) Return the first ChildCountry filtered by the Population column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByLifeexpectancy(double $LifeExpectancy) Return the first ChildCountry filtered by the LifeExpectancy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByGnp(double $GNP) Return the first ChildCountry filtered by the GNP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByGnpold(double $GNPOld) Return the first ChildCountry filtered by the GNPOld column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByLocalname(string $LocalName) Return the first ChildCountry filtered by the LocalName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByGovernmentform(string $GovernmentForm) Return the first ChildCountry filtered by the GovernmentForm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByHeadofstate(string $HeadOfState) Return the first ChildCountry filtered by the HeadOfState column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByCapital(int $Capital) Return the first ChildCountry filtered by the Capital column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountry requireOneByCode2(string $Code2) Return the first ChildCountry filtered by the Code2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCountry objects based on current ModelCriteria
 * @method     ChildCountry[]|ObjectCollection findByCode(string $Code) Return ChildCountry objects filtered by the Code column
 * @method     ChildCountry[]|ObjectCollection findByName(string $Name) Return ChildCountry objects filtered by the Name column
 * @method     ChildCountry[]|ObjectCollection findByContinent(string $Continent) Return ChildCountry objects filtered by the Continent column
 * @method     ChildCountry[]|ObjectCollection findByRegion(string $Region) Return ChildCountry objects filtered by the Region column
 * @method     ChildCountry[]|ObjectCollection findBySurfacearea(double $SurfaceArea) Return ChildCountry objects filtered by the SurfaceArea column
 * @method     ChildCountry[]|ObjectCollection findByIndepyear(int $IndepYear) Return ChildCountry objects filtered by the IndepYear column
 * @method     ChildCountry[]|ObjectCollection findByPopulation(int $Population) Return ChildCountry objects filtered by the Population column
 * @method     ChildCountry[]|ObjectCollection findByLifeexpectancy(double $LifeExpectancy) Return ChildCountry objects filtered by the LifeExpectancy column
 * @method     ChildCountry[]|ObjectCollection findByGnp(double $GNP) Return ChildCountry objects filtered by the GNP column
 * @method     ChildCountry[]|ObjectCollection findByGnpold(double $GNPOld) Return ChildCountry objects filtered by the GNPOld column
 * @method     ChildCountry[]|ObjectCollection findByLocalname(string $LocalName) Return ChildCountry objects filtered by the LocalName column
 * @method     ChildCountry[]|ObjectCollection findByGovernmentform(string $GovernmentForm) Return ChildCountry objects filtered by the GovernmentForm column
 * @method     ChildCountry[]|ObjectCollection findByHeadofstate(string $HeadOfState) Return ChildCountry objects filtered by the HeadOfState column
 * @method     ChildCountry[]|ObjectCollection findByCapital(int $Capital) Return ChildCountry objects filtered by the Capital column
 * @method     ChildCountry[]|ObjectCollection findByCode2(string $Code2) Return ChildCountry objects filtered by the Code2 column
 * @method     ChildCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CountryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CountryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Country', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCountryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCountryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCountryQuery) {
            return $criteria;
        }
        $query = new ChildCountryQuery();
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
     * @return ChildCountry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The Country object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The Country object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The Country object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The Country object has no primary key');
    }

    /**
     * Filter the query on the Code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE Code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE Code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the Name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE Name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE Name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the Continent column
     *
     * Example usage:
     * <code>
     * $query->filterByContinent('fooValue');   // WHERE Continent = 'fooValue'
     * $query->filterByContinent('%fooValue%', Criteria::LIKE); // WHERE Continent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $continent The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByContinent($continent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($continent)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_CONTINENT, $continent, $comparison);
    }

    /**
     * Filter the query on the Region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE Region = 'fooValue'
     * $query->filterByRegion('%fooValue%', Criteria::LIKE); // WHERE Region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $region The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByRegion($region = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_REGION, $region, $comparison);
    }

    /**
     * Filter the query on the SurfaceArea column
     *
     * Example usage:
     * <code>
     * $query->filterBySurfacearea(1234); // WHERE SurfaceArea = 1234
     * $query->filterBySurfacearea(array(12, 34)); // WHERE SurfaceArea IN (12, 34)
     * $query->filterBySurfacearea(array('min' => 12)); // WHERE SurfaceArea > 12
     * </code>
     *
     * @param     mixed $surfacearea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterBySurfacearea($surfacearea = null, $comparison = null)
    {
        if (is_array($surfacearea)) {
            $useMinMax = false;
            if (isset($surfacearea['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_SURFACEAREA, $surfacearea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surfacearea['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_SURFACEAREA, $surfacearea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_SURFACEAREA, $surfacearea, $comparison);
    }

    /**
     * Filter the query on the IndepYear column
     *
     * Example usage:
     * <code>
     * $query->filterByIndepyear(1234); // WHERE IndepYear = 1234
     * $query->filterByIndepyear(array(12, 34)); // WHERE IndepYear IN (12, 34)
     * $query->filterByIndepyear(array('min' => 12)); // WHERE IndepYear > 12
     * </code>
     *
     * @param     mixed $indepyear The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByIndepyear($indepyear = null, $comparison = null)
    {
        if (is_array($indepyear)) {
            $useMinMax = false;
            if (isset($indepyear['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_INDEPYEAR, $indepyear['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($indepyear['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_INDEPYEAR, $indepyear['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_INDEPYEAR, $indepyear, $comparison);
    }

    /**
     * Filter the query on the Population column
     *
     * Example usage:
     * <code>
     * $query->filterByPopulation(1234); // WHERE Population = 1234
     * $query->filterByPopulation(array(12, 34)); // WHERE Population IN (12, 34)
     * $query->filterByPopulation(array('min' => 12)); // WHERE Population > 12
     * </code>
     *
     * @param     mixed $population The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByPopulation($population = null, $comparison = null)
    {
        if (is_array($population)) {
            $useMinMax = false;
            if (isset($population['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_POPULATION, $population['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($population['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_POPULATION, $population['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_POPULATION, $population, $comparison);
    }

    /**
     * Filter the query on the LifeExpectancy column
     *
     * Example usage:
     * <code>
     * $query->filterByLifeexpectancy(1234); // WHERE LifeExpectancy = 1234
     * $query->filterByLifeexpectancy(array(12, 34)); // WHERE LifeExpectancy IN (12, 34)
     * $query->filterByLifeexpectancy(array('min' => 12)); // WHERE LifeExpectancy > 12
     * </code>
     *
     * @param     mixed $lifeexpectancy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByLifeexpectancy($lifeexpectancy = null, $comparison = null)
    {
        if (is_array($lifeexpectancy)) {
            $useMinMax = false;
            if (isset($lifeexpectancy['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_LIFEEXPECTANCY, $lifeexpectancy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lifeexpectancy['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_LIFEEXPECTANCY, $lifeexpectancy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_LIFEEXPECTANCY, $lifeexpectancy, $comparison);
    }

    /**
     * Filter the query on the GNP column
     *
     * Example usage:
     * <code>
     * $query->filterByGnp(1234); // WHERE GNP = 1234
     * $query->filterByGnp(array(12, 34)); // WHERE GNP IN (12, 34)
     * $query->filterByGnp(array('min' => 12)); // WHERE GNP > 12
     * </code>
     *
     * @param     mixed $gnp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByGnp($gnp = null, $comparison = null)
    {
        if (is_array($gnp)) {
            $useMinMax = false;
            if (isset($gnp['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_GNP, $gnp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gnp['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_GNP, $gnp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_GNP, $gnp, $comparison);
    }

    /**
     * Filter the query on the GNPOld column
     *
     * Example usage:
     * <code>
     * $query->filterByGnpold(1234); // WHERE GNPOld = 1234
     * $query->filterByGnpold(array(12, 34)); // WHERE GNPOld IN (12, 34)
     * $query->filterByGnpold(array('min' => 12)); // WHERE GNPOld > 12
     * </code>
     *
     * @param     mixed $gnpold The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByGnpold($gnpold = null, $comparison = null)
    {
        if (is_array($gnpold)) {
            $useMinMax = false;
            if (isset($gnpold['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_GNPOLD, $gnpold['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gnpold['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_GNPOLD, $gnpold['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_GNPOLD, $gnpold, $comparison);
    }

    /**
     * Filter the query on the LocalName column
     *
     * Example usage:
     * <code>
     * $query->filterByLocalname('fooValue');   // WHERE LocalName = 'fooValue'
     * $query->filterByLocalname('%fooValue%', Criteria::LIKE); // WHERE LocalName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $localname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByLocalname($localname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($localname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_LOCALNAME, $localname, $comparison);
    }

    /**
     * Filter the query on the GovernmentForm column
     *
     * Example usage:
     * <code>
     * $query->filterByGovernmentform('fooValue');   // WHERE GovernmentForm = 'fooValue'
     * $query->filterByGovernmentform('%fooValue%', Criteria::LIKE); // WHERE GovernmentForm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $governmentform The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByGovernmentform($governmentform = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($governmentform)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_GOVERNMENTFORM, $governmentform, $comparison);
    }

    /**
     * Filter the query on the HeadOfState column
     *
     * Example usage:
     * <code>
     * $query->filterByHeadofstate('fooValue');   // WHERE HeadOfState = 'fooValue'
     * $query->filterByHeadofstate('%fooValue%', Criteria::LIKE); // WHERE HeadOfState LIKE '%fooValue%'
     * </code>
     *
     * @param     string $headofstate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByHeadofstate($headofstate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($headofstate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_HEADOFSTATE, $headofstate, $comparison);
    }

    /**
     * Filter the query on the Capital column
     *
     * Example usage:
     * <code>
     * $query->filterByCapital(1234); // WHERE Capital = 1234
     * $query->filterByCapital(array(12, 34)); // WHERE Capital IN (12, 34)
     * $query->filterByCapital(array('min' => 12)); // WHERE Capital > 12
     * </code>
     *
     * @param     mixed $capital The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByCapital($capital = null, $comparison = null)
    {
        if (is_array($capital)) {
            $useMinMax = false;
            if (isset($capital['min'])) {
                $this->addUsingAlias(CountryTableMap::COL_CAPITAL, $capital['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capital['max'])) {
                $this->addUsingAlias(CountryTableMap::COL_CAPITAL, $capital['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_CAPITAL, $capital, $comparison);
    }

    /**
     * Filter the query on the Code2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCode2('fooValue');   // WHERE Code2 = 'fooValue'
     * $query->filterByCode2('%fooValue%', Criteria::LIKE); // WHERE Code2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function filterByCode2($code2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryTableMap::COL_CODE2, $code2, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCountry $country Object to remove from the list of results
     *
     * @return $this|ChildCountryQuery The current query, for fluid interface
     */
    public function prune($country = null)
    {
        if ($country) {
            throw new LogicException('Country object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CountryTableMap::clearInstancePool();
            CountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CountryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CountryQuery
