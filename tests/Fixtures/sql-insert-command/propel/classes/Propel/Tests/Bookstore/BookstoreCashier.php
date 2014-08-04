<?php

namespace Propel\Tests\Bookstore;

use Propel\Tests\Bookstore\Map\BookstoreEmployeeTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'bookstore_employee' table.
 *
 * Hierarchical table to represent employees of a bookstore.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class BookstoreCashier extends BookstoreEmployee
{

    /**
     * Constructs a new BookstoreCashier class, setting the class_key column to BookstoreEmployeeTableMap::CLASSKEY_2.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(BookstoreEmployeeTableMap::CLASSKEY_2);
    }

} // BookstoreCashier
