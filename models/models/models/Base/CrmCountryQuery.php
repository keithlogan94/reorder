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
use models\models\CrmCountry as ChildCrmCountry;
use models\models\CrmCountryQuery as ChildCrmCountryQuery;
use models\models\Map\CrmCountryTableMap;

/**
 * Base class that represents a query for the 'crm_country' table.
 *
 *
 *
 * @method     ChildCrmCountryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCrmCountryQuery orderByContinent($order = Criteria::ASC) Order by the continent column
 * @method     ChildCrmCountryQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method     ChildCrmCountryQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method     ChildCrmCountryQuery groupByName() Group by the name column
 * @method     ChildCrmCountryQuery groupByContinent() Group by the continent column
 * @method     ChildCrmCountryQuery groupByRegion() Group by the region column
 * @method     ChildCrmCountryQuery groupByActive() Group by the active column
 *
 * @method     ChildCrmCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCrmCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCrmCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCrmCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCrmCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCrmCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCrmCountry findOne(ConnectionInterface $con = null) Return the first ChildCrmCountry matching the query
 * @method     ChildCrmCountry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCrmCountry matching the query, or a new ChildCrmCountry object populated from the query conditions when no match is found
 *
 * @method     ChildCrmCountry findOneByName(string $name) Return the first ChildCrmCountry filtered by the name column
 * @method     ChildCrmCountry findOneByContinent(string $continent) Return the first ChildCrmCountry filtered by the continent column
 * @method     ChildCrmCountry findOneByRegion(string $region) Return the first ChildCrmCountry filtered by the region column
 * @method     ChildCrmCountry findOneByActive(boolean $active) Return the first ChildCrmCountry filtered by the active column *

 * @method     ChildCrmCountry requirePk($key, ConnectionInterface $con = null) Return the ChildCrmCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmCountry requireOne(ConnectionInterface $con = null) Return the first ChildCrmCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmCountry requireOneByName(string $name) Return the first ChildCrmCountry filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmCountry requireOneByContinent(string $continent) Return the first ChildCrmCountry filtered by the continent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmCountry requireOneByRegion(string $region) Return the first ChildCrmCountry filtered by the region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCrmCountry requireOneByActive(boolean $active) Return the first ChildCrmCountry filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCrmCountry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCrmCountry objects based on current ModelCriteria
 * @method     ChildCrmCountry[]|ObjectCollection findByName(string $name) Return ChildCrmCountry objects filtered by the name column
 * @method     ChildCrmCountry[]|ObjectCollection findByContinent(string $continent) Return ChildCrmCountry objects filtered by the continent column
 * @method     ChildCrmCountry[]|ObjectCollection findByRegion(string $region) Return ChildCrmCountry objects filtered by the region column
 * @method     ChildCrmCountry[]|ObjectCollection findByActive(boolean $active) Return ChildCrmCountry objects filtered by the active column
 * @method     ChildCrmCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CrmCountryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\CrmCountryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\CrmCountry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCrmCountryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCrmCountryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCrmCountryQuery) {
            return $criteria;
        }
        $query = new ChildCrmCountryQuery();
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
     * @return ChildCrmCountry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The CrmCountry object has no primary key');
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
        throw new LogicException('The CrmCountry object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The CrmCountry object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The CrmCountry object has no primary key');
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmCountryTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the continent column
     *
     * Example usage:
     * <code>
     * $query->filterByContinent('fooValue');   // WHERE continent = 'fooValue'
     * $query->filterByContinent('%fooValue%', Criteria::LIKE); // WHERE continent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $continent The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByContinent($continent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($continent)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmCountryTableMap::COL_CONTINENT, $continent, $comparison);
    }

    /**
     * Filter the query on the region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE region = 'fooValue'
     * $query->filterByRegion('%fooValue%', Criteria::LIKE); // WHERE region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $region The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByRegion($region = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CrmCountryTableMap::COL_REGION, $region, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CrmCountryTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCrmCountry $crmCountry Object to remove from the list of results
     *
     * @return $this|ChildCrmCountryQuery The current query, for fluid interface
     */
    public function prune($crmCountry = null)
    {
        if ($crmCountry) {
            throw new LogicException('CrmCountry object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the crm_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CrmCountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CrmCountryTableMap::clearInstancePool();
            CrmCountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CrmCountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CrmCountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CrmCountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CrmCountryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CrmCountryQuery
