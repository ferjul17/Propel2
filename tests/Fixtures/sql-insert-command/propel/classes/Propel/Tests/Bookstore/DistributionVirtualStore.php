<?php

namespace Propel\Tests\Bookstore;

use Propel\Tests\Bookstore\Map\DistributionTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'distribution' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class DistributionVirtualStore extends DistributionStore
{

    /**
     * Constructs a new DistributionVirtualStore class, setting the type column to DistributionTableMap::CLASSKEY_3838.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setType(DistributionTableMap::CLASSKEY_3838);
    }

} // DistributionVirtualStore
