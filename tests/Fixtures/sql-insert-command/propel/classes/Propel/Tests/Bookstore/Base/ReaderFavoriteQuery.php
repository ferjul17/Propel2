<?php

namespace Propel\Tests\Bookstore\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Tests\Bookstore\ReaderFavorite as ChildReaderFavorite;
use Propel\Tests\Bookstore\ReaderFavoriteQuery as ChildReaderFavoriteQuery;
use Propel\Tests\Bookstore\Map\ReaderFavoriteTableMap;

/**
 * Base class that represents a query for the 'reader_favorite' table.
 *
 *
 *
 * @method     ChildReaderFavoriteQuery orderByBookId($order = Criteria::ASC) Order by the book_id column
 * @method     ChildReaderFavoriteQuery orderByReaderId($order = Criteria::ASC) Order by the reader_id column
 *
 * @method     ChildReaderFavoriteQuery groupByBookId() Group by the book_id column
 * @method     ChildReaderFavoriteQuery groupByReaderId() Group by the reader_id column
 *
 * @method     ChildReaderFavoriteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReaderFavoriteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReaderFavoriteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReaderFavoriteQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ChildReaderFavoriteQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ChildReaderFavoriteQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ChildReaderFavoriteQuery leftJoinBookReader($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookReader relation
 * @method     ChildReaderFavoriteQuery rightJoinBookReader($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookReader relation
 * @method     ChildReaderFavoriteQuery innerJoinBookReader($relationAlias = null) Adds a INNER JOIN clause to the query using the BookReader relation
 *
 * @method     ChildReaderFavoriteQuery leftJoinBookOpinion($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookOpinion relation
 * @method     ChildReaderFavoriteQuery rightJoinBookOpinion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookOpinion relation
 * @method     ChildReaderFavoriteQuery innerJoinBookOpinion($relationAlias = null) Adds a INNER JOIN clause to the query using the BookOpinion relation
 *
 * @method     \Propel\Tests\Bookstore\BookQuery|\Propel\Tests\Bookstore\BookReaderQuery|\Propel\Tests\Bookstore\BookOpinionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReaderFavorite findOne(ConnectionInterface $con = null) Return the first ChildReaderFavorite matching the query
 * @method     ChildReaderFavorite findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReaderFavorite matching the query, or a new ChildReaderFavorite object populated from the query conditions when no match is found
 *
 * @method     ChildReaderFavorite findOneByBookId(int $book_id) Return the first ChildReaderFavorite filtered by the book_id column
 * @method     ChildReaderFavorite findOneByReaderId(int $reader_id) Return the first ChildReaderFavorite filtered by the reader_id column
 *
 * @method     ChildReaderFavorite[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReaderFavorite objects based on current ModelCriteria
 * @method     ChildReaderFavorite[]|ObjectCollection findByBookId(int $book_id) Return ChildReaderFavorite objects filtered by the book_id column
 * @method     ChildReaderFavorite[]|ObjectCollection findByReaderId(int $reader_id) Return ChildReaderFavorite objects filtered by the reader_id column
 * @method     ChildReaderFavorite[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReaderFavoriteQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Propel\Tests\Bookstore\Base\ReaderFavoriteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'bookstore', $modelName = '\\Propel\\Tests\\Bookstore\\ReaderFavorite', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReaderFavoriteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReaderFavoriteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReaderFavoriteQuery) {
            return $criteria;
        }
        $query = new ChildReaderFavoriteQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$book_id, $reader_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReaderFavorite|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ReaderFavoriteTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReaderFavoriteTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildReaderFavorite A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT BOOK_ID, READER_ID FROM reader_favorite WHERE BOOK_ID = :p0 AND READER_ID = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReaderFavorite $obj */
            $obj = new ChildReaderFavorite();
            $obj->hydrate($row);
            ReaderFavoriteTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildReaderFavorite|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ReaderFavoriteTableMap::COL_BOOK_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ReaderFavoriteTableMap::COL_READER_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the book_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookId(1234); // WHERE book_id = 1234
     * $query->filterByBookId(array(12, 34)); // WHERE book_id IN (12, 34)
     * $query->filterByBookId(array('min' => 12)); // WHERE book_id > 12
     * </code>
     *
     * @see       filterByBook()
     *
     * @see       filterByBookOpinion()
     *
     * @param     mixed $bookId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByBookId($bookId = null, $comparison = null)
    {
        if (is_array($bookId)) {
            $useMinMax = false;
            if (isset($bookId['min'])) {
                $this->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $bookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookId['max'])) {
                $this->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $bookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $bookId, $comparison);
    }

    /**
     * Filter the query on the reader_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReaderId(1234); // WHERE reader_id = 1234
     * $query->filterByReaderId(array(12, 34)); // WHERE reader_id IN (12, 34)
     * $query->filterByReaderId(array('min' => 12)); // WHERE reader_id > 12
     * </code>
     *
     * @see       filterByBookReader()
     *
     * @see       filterByBookOpinion()
     *
     * @param     mixed $readerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByReaderId($readerId = null, $comparison = null)
    {
        if (is_array($readerId)) {
            $useMinMax = false;
            if (isset($readerId['min'])) {
                $this->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $readerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($readerId['max'])) {
                $this->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $readerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $readerId, $comparison);
    }

    /**
     * Filter the query by a related \Propel\Tests\Bookstore\Book object
     *
     * @param \Propel\Tests\Bookstore\Book|ObjectCollection $book The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByBook($book, $comparison = null)
    {
        if ($book instanceof \Propel\Tests\Bookstore\Book) {
            return $this
                ->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $book->getId(), $comparison);
        } elseif ($book instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $book->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBook() only accepts arguments of type \Propel\Tests\Bookstore\Book or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Book relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function joinBook($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Book');

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
            $this->addJoinObject($join, 'Book');
        }

        return $this;
    }

    /**
     * Use the Book relation Book object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Tests\Bookstore\BookQuery A secondary query class using the current class as primary query
     */
    public function useBookQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBook($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Book', '\Propel\Tests\Bookstore\BookQuery');
    }

    /**
     * Filter the query by a related \Propel\Tests\Bookstore\BookReader object
     *
     * @param \Propel\Tests\Bookstore\BookReader|ObjectCollection $bookReader The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByBookReader($bookReader, $comparison = null)
    {
        if ($bookReader instanceof \Propel\Tests\Bookstore\BookReader) {
            return $this
                ->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $bookReader->getId(), $comparison);
        } elseif ($bookReader instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $bookReader->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBookReader() only accepts arguments of type \Propel\Tests\Bookstore\BookReader or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookReader relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function joinBookReader($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookReader');

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
            $this->addJoinObject($join, 'BookReader');
        }

        return $this;
    }

    /**
     * Use the BookReader relation BookReader object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Tests\Bookstore\BookReaderQuery A secondary query class using the current class as primary query
     */
    public function useBookReaderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookReader($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookReader', '\Propel\Tests\Bookstore\BookReaderQuery');
    }

    /**
     * Filter the query by a related \Propel\Tests\Bookstore\BookOpinion object
     *
     * @param \Propel\Tests\Bookstore\BookOpinion $bookOpinion The related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function filterByBookOpinion($bookOpinion, $comparison = null)
    {
        if ($bookOpinion instanceof \Propel\Tests\Bookstore\BookOpinion) {
            return $this
                ->addUsingAlias(ReaderFavoriteTableMap::COL_BOOK_ID, $bookOpinion->getBookId(), $comparison)
                ->addUsingAlias(ReaderFavoriteTableMap::COL_READER_ID, $bookOpinion->getReaderId(), $comparison);
        } else {
            throw new PropelException('filterByBookOpinion() only accepts arguments of type \Propel\Tests\Bookstore\BookOpinion');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookOpinion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function joinBookOpinion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookOpinion');

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
            $this->addJoinObject($join, 'BookOpinion');
        }

        return $this;
    }

    /**
     * Use the BookOpinion relation BookOpinion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Propel\Tests\Bookstore\BookOpinionQuery A secondary query class using the current class as primary query
     */
    public function useBookOpinionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookOpinion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookOpinion', '\Propel\Tests\Bookstore\BookOpinionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReaderFavorite $readerFavorite Object to remove from the list of results
     *
     * @return $this|ChildReaderFavoriteQuery The current query, for fluid interface
     */
    public function prune($readerFavorite = null)
    {
        if ($readerFavorite) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ReaderFavoriteTableMap::COL_BOOK_ID), $readerFavorite->getBookId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ReaderFavoriteTableMap::COL_READER_ID), $readerFavorite->getReaderId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the reader_favorite table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReaderFavoriteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReaderFavoriteTableMap::clearInstancePool();
            ReaderFavoriteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReaderFavoriteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReaderFavoriteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReaderFavoriteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReaderFavoriteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReaderFavoriteQuery
