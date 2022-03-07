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
     * @param int $id
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function get(int $store_id): StoreLocatorInterface;

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Add a new store or update an existing one
     *
     * @api
     * @param \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface $storeLocator
     * @return int
     */
    public function save(StoreLocatorInterface $storeLocator): int;

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void;
}
