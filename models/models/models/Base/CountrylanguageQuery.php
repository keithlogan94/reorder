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
use models\models\Countrylanguage as ChildCountrylanguage;
use models\models\CountrylanguageQuery as ChildCountrylanguageQuery;
use models\models\Map\CountrylanguageTableMap;

/**
 * Base class that represents a query for the 'countrylanguage' table.
 *
 *
 *
 * @method     ChildCountrylanguageQuery orderByCountrycode($order = Criteria::ASC) Order by the CountryCode column
 * @method     ChildCountrylanguageQuery orderByLanguage($order = Criteria::ASC) Order by the Language column
 * @method     ChildCountrylanguageQuery orderByIsofficial($order = Criteria::ASC) Order by the IsOfficial column
 * @method     ChildCountrylanguageQuery orderByPercentage($order = Criteria::ASC) Order by the Percentage column
 *
 * @method     ChildCountrylanguageQuery groupByCountrycode() Group by the CountryCode column
 * @method     ChildCountrylanguageQuery groupByLanguage() Group by the Language column
 * @method     ChildCountrylanguageQuery groupByIsofficial() Group by the IsOfficial column
 * @method     ChildCountrylanguageQuery groupByPercentage() Group by the Percentage column
 *
 * @method     ChildCountrylanguageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCountrylanguageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCountrylanguageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCountrylanguageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCountrylanguageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCountrylanguageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCountrylanguage findOne(ConnectionInterface $con = null) Return the first ChildCountrylanguage matching the query
 * @method     ChildCountrylanguage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCountrylanguage matching the query, or a new ChildCountrylanguage object populated from the query conditions when no match is found
 *
 * @method     ChildCountrylanguage findOneByCountrycode(string $CountryCode) Return the first ChildCountrylanguage filtered by the CountryCode column
 * @method     ChildCountrylanguage findOneByLanguage(string $Language) Return the first ChildCountrylanguage filtered by the Language column
 * @method     ChildCountrylanguage findOneByIsofficial(string $IsOfficial) Return the first ChildCountrylanguage filtered by the IsOfficial column
 * @method     ChildCountrylanguage findOneByPercentage(double $Percentage) Return the first ChildCountrylanguage filtered by the Percentage column *

 * @method     ChildCountrylanguage requirePk($key, ConnectionInterface $con = null) Return the ChildCountrylanguage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountrylanguage requireOne(ConnectionInterface $con = null) Return the first ChildCountrylanguage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountrylanguage requireOneByCountrycode(string $CountryCode) Return the first ChildCountrylanguage filtered by the CountryCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountrylanguage requireOneByLanguage(string $Language) Return the first ChildCountrylanguage filtered by the Language column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountrylanguage requireOneByIsofficial(string $IsOfficial) Return the first ChildCountrylanguage filtered by the IsOfficial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCountrylanguage requireOneByPercentage(double $Percentage) Return the first ChildCountrylanguage filtered by the Percentage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCountrylanguage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCountrylanguage objects based on current ModelCriteria
 * @method     ChildCountrylanguage[]|ObjectCollection findByCountrycode(string $CountryCode) Return ChildCountrylanguage objects filtered by the CountryCode column
 * @method     ChildCountrylanguage[]|ObjectCollection findByLanguage(string $Language) Return ChildCountrylanguage objects filtered by the Language column
 * @method     ChildCountrylanguage[]|ObjectCollection findByIsofficial(string $IsOfficial) Return ChildCountrylanguage objects filtered by the IsOfficial column
 * @method     ChildCountrylanguage[]|ObjectCollection findByPercentage(double $Percentage) Return ChildCountrylanguage objects filtered by the Percentage column
 * @method     ChildCountrylanguage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CountrylanguageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CountrylanguageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Countrylanguage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCountrylanguageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCountrylanguageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCountrylanguageQuery) {
            return $criteria;
        }
        $query = new ChildCountrylanguageQuery();
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
     * @return ChildCountrylanguage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The Countrylanguage object has no primary key');
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
        throw new LogicException('The Countrylanguage object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The Countrylanguage object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The Countrylanguage object has no primary key');
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
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByCountrycode($countrycode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countrycode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountrylanguageTableMap::COL_COUNTRYCODE, $countrycode, $comparison);
    }

    /**
     * Filter the query on the Language column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguage('fooValue');   // WHERE Language = 'fooValue'
     * $query->filterByLanguage('%fooValue%', Criteria::LIKE); // WHERE Language LIKE '%fooValue%'
     * </code>
     *
     * @param     string $language The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByLanguage($language = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($language)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountrylanguageTableMap::COL_LANGUAGE, $language, $comparison);
    }

    /**
     * Filter the query on the IsOfficial column
     *
     * Example usage:
     * <code>
     * $query->filterByIsofficial('fooValue');   // WHERE IsOfficial = 'fooValue'
     * $query->filterByIsofficial('%fooValue%', Criteria::LIKE); // WHERE IsOfficial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isofficial The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByIsofficial($isofficial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isofficial)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountrylanguageTableMap::COL_ISOFFICIAL, $isofficial, $comparison);
    }

    /**
     * Filter the query on the Percentage column
     *
     * Example usage:
     * <code>
     * $query->filterByPercentage(1234); // WHERE Percentage = 1234
     * $query->filterByPercentage(array(12, 34)); // WHERE Percentage IN (12, 34)
     * $query->filterByPercentage(array('min' => 12)); // WHERE Percentage > 12
     * </code>
     *
     * @param     mixed $percentage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function filterByPercentage($percentage = null, $comparison = null)
    {
        if (is_array($percentage)) {
            $useMinMax = false;
            if (isset($percentage['min'])) {
                $this->addUsingAlias(CountrylanguageTableMap::COL_PERCENTAGE, $percentage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($percentage['max'])) {
                $this->addUsingAlias(CountrylanguageTableMap::COL_PERCENTAGE, $percentage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountrylanguageTableMap::COL_PERCENTAGE, $percentage, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCountrylanguage $countrylanguage Object to remove from the list of results
     *
     * @return $this|ChildCountrylanguageQuery The current query, for fluid interface
     */
    public function prune($countrylanguage = null)
    {
        if ($countrylanguage) {
            throw new LogicException('Countrylanguage object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the countrylanguage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CountrylanguageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CountrylanguageTableMap::clearInstancePool();
            CountrylanguageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CountrylanguageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CountrylanguageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CountrylanguageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CountrylanguageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CountrylanguageQuery