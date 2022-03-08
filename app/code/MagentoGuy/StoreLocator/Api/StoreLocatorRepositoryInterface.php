<?php

namespace MagentoGuy\StoreLocator\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;

/**
 * Interface StoreLocatorRepositoryInterface
 *
 * @package MagentoGuy\StoreLocator\Api
 */
interface StoreLocatorRepositoryInterface
{
    /**
     * @api
     * @param int $storeId
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function get(int $storeId): StoreLocatorInterface;

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \MagentoGuy\StoreLocator\Api\StoreLocatorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * @api
     * @param \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return int
     */
    public function save(StoreLocatorInterface $storeLocator): int;

    /**
     * @param int $storeId
     * @return void
     */
    public function deleteById(int $storeId): void;
}
