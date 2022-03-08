<?php

namespace MagentoGuy\StoreLocator\Helper;

use Algolia\AlgoliaSearch\Helper\Entity\AdditionalSectionHelper;
use Algolia\AlgoliaSearch\Helper\Entity\CategoryHelper;
use Algolia\AlgoliaSearch\Helper\Entity\PageHelper;
use Algolia\AlgoliaSearch\Helper\Entity\ProductHelper;
use Algolia\AlgoliaSearch\Helper\Entity\SuggestionHelper;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\App\Config\ScopeCodeResolver;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\App\Emulation;
use Magento\Store\Model\StoreManagerInterface;
use Algolia\AlgoliaSearch\Helper\ConfigHelper;
use Algolia\AlgoliaSearch\Helper\AlgoliaHelper;
use Algolia\AlgoliaSearch\Helper\Logger;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

class Data extends \Algolia\AlgoliaSearch\Helper\Data
{
    private $algoliaHelper;

    private $configHelper;

    private $collectionFactory;

    public function __construct(
        AlgoliaHelper $algoliaHelper,
        ConfigHelper $configHelper,
        ProductHelper $producthelper,
        CategoryHelper $categoryHelper,
        PageHelper $pageHelper,
        SuggestionHelper $suggestionHelper,
        AdditionalSectionHelper $additionalSectionHelper,
        StockRegistryInterface $stockRegistry,
        Emulation $emulation,
        Logger $logger,
        ResourceConnection $resource,
        ManagerInterface $eventManager,
        ScopeCodeResolver $scopeCodeResolver,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct(
            $algoliaHelper, $configHelper, $producthelper, $categoryHelper, $pageHelper, $suggestionHelper,
            $additionalSectionHelper, $stockRegistry, $emulation, $logger, $resource, $eventManager, $scopeCodeResolver, $storeManager
        );

        $this->collectionFactory = $collectionFactory;
        $this->configHelper = $configHelper;
        $this->algoliaHelper = $algoliaHelper;
    }

    public function rebuildStoreLocatorIndex($storeIds)
    {
        $collection = $this->getCollectionQuery($storeIds);

        $collection->load();

        $indexName = $this->getIndexName('_store_locator');

        $indexData = [];

        foreach ($collection as $item) {
            $storeLocatorObject = [
                'objectID'          => $item->getData('store_id'),
                'store_name'        => $item->getData('store_name'),
                'store_phone'       => $item->getData('store_phone'),
                'store_address'     => $item->getData('store_address'),
                'store_city'        => $item->getData('store_city'),
                'store_state'        => $item->getData('store_state'),
                'store_zip'        => $item->getData('store_zip'),
                'store_country'        => $item->getData('store_country'),
            ];
            array_push($indexData, $storeLocatorObject);
        }

        if (count($indexData) > 0) {
            $this->algoliaHelper->addObjects($indexData, $indexName);
        }

        unset($indexData);

        $collection->walk('clearInstance');
        $collection->clear();

        unset($collection);
    }

    private function getCollectionQuery($storeIds = null)
    {
        /** @var \MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator\Collection $collection */
        $collection = $this->collectionFactory->create();
        if ($storeIds) {
            $collection->addFieldToFilter('store_id', ['in' => $storeIds]);
        }

        return $collection;
    }
}
