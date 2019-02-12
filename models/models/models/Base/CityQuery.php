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
use models\models\City as ChildCity;
use models\models\CityQuery as ChildCityQuery;
use models\models\Map\CityTableMap;

/**
 * Base class that represents a query for the 'city' table.
 *
 *
 *
 * @method     ChildCityQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildCityQuery orderByName($order = Criteria::ASC) Order by the Name column
 * @method     ChildCityQuery orderByCountrycode($order = Criteria::ASC) Order by the CountryCode column
 * @method     ChildCityQuery orderByDistrict($order = Criteria::ASC) Order by the District column
 * @method     ChildCityQuery orderByPopulation($order = Criteria::ASC) Order by the Population column
 *
 * @method     ChildCityQuery groupById() Group by the ID column
 * @method     ChildCityQuery groupByName() Group by the Name column
 * @method     ChildCityQuery groupByCountrycode() Group by the CountryCode column
 * @method     ChildCityQuery groupByDistrict() Group by the District column
 * @method     ChildCityQuery groupByPopulation() Group by the Population column
 *
 * @method     ChildCityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCity findOne(ConnectionInterface $con = null) Return the first ChildCity matching the query
 * @method     ChildCity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCity matching the query, or a new ChildCity object populated from the query conditions when no match is found
 *
 * @method     ChildCity findOneById(int $ID) Return the first ChildCity filtered by the ID column
 * @method     ChildCity findOneByName(string $Name) Return the first ChildCity filtered by the Name column
 * @method     ChildCity findOneByCountrycode(string $CountryCode) Return the first ChildCity filtered by the CountryCode column
 * @method     ChildCity findOneByDistrict(string $District) Return the first ChildCity filtered by the District column
 * @method     ChildCity findOneByPopulation(int $Population) Return the first ChildCity filtered by the Population column *

 * @method     ChildCity requirePk($key, ConnectionInterface $con = null) Return the ChildCity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOne(ConnectionInterface $con = null) Return the first ChildCity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCity requireOneById(int $ID) Return the first ChildCity filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByName(string $Name) Return the first ChildCity filtered by the Name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByCountrycode(string $CountryCode) Return the first ChildCity filtered by the CountryCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByDistrict(string $District) Return the first ChildCity filtered by the District column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCity requireOneByPopulation(int $Population) Return the first ChildCity filtered by the Population column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCity objects based on current ModelCriteria
 * @method     ChildCity[]|ObjectCollection findById(int $ID) Return ChildCity objects filtered by the ID column
 * @method     ChildCity[]|ObjectCollection findByName(string $Name) Return ChildCity objects filtered by the Name column
 * @method     ChildCity[]|ObjectCollection findByCountrycode(string $CountryCode) Return ChildCity objects filtered by the CountryCode column
 * @method     ChildCity[]|ObjectCollection findByDistrict(string $District) Return ChildCity objects filtered by the District column
 * @method     ChildCity[]|ObjectCollection findByPopulation(int $Population) Return ChildCity objects filtered by the Population column
 * @method     ChildCity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\City', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCityQuery) {
            return $criteria;
        }
        $query = new ChildCityQuery();
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
     * @return ChildCity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The City object has no primary key');
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
        throw new LogicException('The City object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The City object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The City object has no primary key');
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the CountryCode column
     *
     * Example usage:
     * <code>
     * $query->filterByCountrycode('fooValue');   // WHERE CountryCode = 'fooValue'
     * $query->filterByCountrycode('%fooValue%', Criteria::LIKE); // WHERE CountryCode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $countrycode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByCountrycode($countrycode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countrycode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityTableMap::COL_COUNTRYCODE, $countrycode, $comparison);
    }

    /**
     * Filter the query on the District column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrict('fooValue');   // WHERE District = 'fooValue'
     * $query->filterByDistrict('%fooValue%', Criteria::LIKE); // WHERE District LIKE '%fooValue%'
     * </code>
     *
     * @param     string $district The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByDistrict($district = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($district)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityTableMap::COL_DISTRICT, $district, $comparison);
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
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function filterByPopulation($population = null, $comparison = null)
    {
        if (is_array($population)) {
            $useMinMax = false;
            if (isset($population['min'])) {
                $this->addUsingAlias(CityTableMap::COL_POPULATION, $population['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($population['max'])) {
                $this->addUsingAlias(CityTableMap::COL_POPULATION, $population['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityTableMap::COL_POPULATION, $population, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCity $city Object to remove from the list of results
     *
     * @return $this|ChildCityQuery The current query, for fluid interface
     */
    public function prune($city = null)
    {
        if ($city) {
            throw new LogicException('City object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the city table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CityTableMap::clearInstancePool();
            CityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CityQuery
