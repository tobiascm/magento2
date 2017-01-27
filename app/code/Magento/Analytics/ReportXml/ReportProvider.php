<?php
/**
 * Copyright © 2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Analytics\ReportXml;

use Magento\Framework\Api\SearchCriteria;

/**
 * Class ReportProvider
 *
 * Providers for reports data
 */
class ReportProvider
{
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var ConnectionFactory
     */
    private $connectionFactory;

    public function __construct(
        QueryFactory $queryFactory,
        ConnectionFactory $connectionFactory
    ) {
        $this->queryFactory = $queryFactory;
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * Returns report data by name and criteria
     *
     * @param string $name
     * @param SearchCriteria|null $criteria
     * @return \IteratorIterator
     */
    public function getReport($name, SearchCriteria $criteria = null)
    {
        $query = $this->queryFactory->create($name);
        $connection = $this->connectionFactory->getConnection($query->getConnectionName());
        $statement = $connection->query($query->getSelect());
        return new \IteratorIterator($statement);

    }
}
