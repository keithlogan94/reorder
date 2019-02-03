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
use models\models\RequestPayloadValidation as ChildRequestPayloadValidation;
use models\models\RequestPayloadValidationQuery as ChildRequestPayloadValidationQuery;
use models\models\Map\RequestPayloadValidationTableMap;

/**
 * Base class that represents a query for the 'request_payload_validation' table.
 *
 *
 *
 * @method     ChildRequestPayloadValidationQuery orderByRequestIndex($order = Criteria::ASC) Order by the request_index column
 * @method     ChildRequestPayloadValidationQuery orderByValidationMethod($order = Criteria::ASC) Order by the validation_method column
 * @method     ChildRequestPayloadValidationQuery orderByRegex($order = Criteria::ASC) Order by the regex column
 *
 * @method     ChildRequestPayloadValidationQuery groupByRequestIndex() Group by the request_index column
 * @method     ChildRequestPayloadValidationQuery groupByValidationMethod() Group by the validation_method column
 * @method     ChildRequestPayloadValidationQuery groupByRegex() Group by the regex column
 *
 * @method     ChildRequestPayloadValidationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRequestPayloadValidationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRequestPayloadValidationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRequestPayloadValidationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRequestPayloadValidationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRequestPayloadValidationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRequestPayloadValidation findOne(ConnectionInterface $con = null) Return the first ChildRequestPayloadValidation matching the query
 * @method     ChildRequestPayloadValidation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRequestPayloadValidation matching the query, or a new ChildRequestPayloadValidation object populated from the query conditions when no match is found
 *
 * @method     ChildRequestPayloadValidation findOneByRequestIndex(string $request_index) Return the first ChildRequestPayloadValidation filtered by the request_index column
 * @method     ChildRequestPayloadValidation findOneByValidationMethod(string $validation_method) Return the first ChildRequestPayloadValidation filtered by the validation_method column
 * @method     ChildRequestPayloadValidation findOneByRegex(string $regex) Return the first ChildRequestPayloadValidation filtered by the regex column *

 * @method     ChildRequestPayloadValidation requirePk($key, ConnectionInterface $con = null) Return the ChildRequestPayloadValidation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequestPayloadValidation requireOne(ConnectionInterface $con = null) Return the first ChildRequestPayloadValidation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRequestPayloadValidation requireOneByRequestIndex(string $request_index) Return the first ChildRequestPayloadValidation filtered by the request_index column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequestPayloadValidation requireOneByValidationMethod(string $validation_method) Return the first ChildRequestPayloadValidation filtered by the validation_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRequestPayloadValidation requireOneByRegex(string $regex) Return the first ChildRequestPayloadValidation filtered by the regex column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRequestPayloadValidation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRequestPayloadValidation objects based on current ModelCriteria
 * @method     ChildRequestPayloadValidation[]|ObjectCollection findByRequestIndex(string $request_index) Return ChildRequestPayloadValidation objects filtered by the request_index column
 * @method     ChildRequestPayloadValidation[]|ObjectCollection findByValidationMethod(string $validation_method) Return ChildRequestPayloadValidation objects filtered by the validation_method column
 * @method     ChildRequestPayloadValidation[]|ObjectCollection findByRegex(string $regex) Return ChildRequestPayloadValidation objects filtered by the regex column
 * @method     ChildRequestPayloadValidation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RequestPayloadValidationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\RequestPayloadValidationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\RequestPayloadValidation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRequestPayloadValidationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRequestPayloadValidationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRequestPayloadValidationQuery) {
            return $criteria;
        }
        $query = new ChildRequestPayloadValidationQuery();
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
     * @return ChildRequestPayloadValidation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The RequestPayloadValidation object has no primary key');
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
        throw new LogicException('The RequestPayloadValidation object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The RequestPayloadValidation object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The RequestPayloadValidation object has no primary key');
    }

    /**
     * Filter the query on the request_index column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestIndex('fooValue');   // WHERE request_index = 'fooValue'
     * $query->filterByRequestIndex('%fooValue%', Criteria::LIKE); // WHERE request_index LIKE '%fooValue%'
     * </code>
     *
     * @param     string $requestIndex The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function filterByRequestIndex($requestIndex = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requestIndex)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestPayloadValidationTableMap::COL_REQUEST_INDEX, $requestIndex, $comparison);
    }

    /**
     * Filter the query on the validation_method column
     *
     * Example usage:
     * <code>
     * $query->filterByValidationMethod('fooValue');   // WHERE validation_method = 'fooValue'
     * $query->filterByValidationMethod('%fooValue%', Criteria::LIKE); // WHERE validation_method LIKE '%fooValue%'
     * </code>
     *
     * @param     string $validationMethod The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function filterByValidationMethod($validationMethod = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($validationMethod)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestPayloadValidationTableMap::COL_VALIDATION_METHOD, $validationMethod, $comparison);
    }

    /**
     * Filter the query on the regex column
     *
     * Example usage:
     * <code>
     * $query->filterByRegex('fooValue');   // WHERE regex = 'fooValue'
     * $query->filterByRegex('%fooValue%', Criteria::LIKE); // WHERE regex LIKE '%fooValue%'
     * </code>
     *
     * @param     string $regex The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function filterByRegex($regex = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($regex)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequestPayloadValidationTableMap::COL_REGEX, $regex, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRequestPayloadValidation $requestPayloadValidation Object to remove from the list of results
     *
     * @return $this|ChildRequestPayloadValidationQuery The current query, for fluid interface
     */
    public function prune($requestPayloadValidation = null)
    {
        if ($requestPayloadValidation) {
            throw new LogicException('RequestPayloadValidation object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the request_payload_validation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RequestPayloadValidationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RequestPayloadValidationTableMap::clearInstancePool();
            RequestPayloadValidationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RequestPayloadValidationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RequestPayloadValidationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RequestPayloadValidationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RequestPayloadValidationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RequestPayloadValidationQuery
