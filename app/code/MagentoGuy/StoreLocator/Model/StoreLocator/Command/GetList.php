<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\StoreLocator\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use MagentoGuy\StoreLocator\Api\StoreLocatorSearchResultInterface;
use MagentoGuy\StoreLocator\Api\StoreLocatorSearchResultInterfaceFactory;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator\Collection;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

/**
 * Class GetList
 *
 * @package MagentoGuy\StoreLocator\Model\StoreLocator\Command
 */
class GetList
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StoreLocatorSearchResultInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * GetList constructor
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreLocatorSearchResultInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreLocatorSearchResultInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return StoreLocatorSearchResultInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null)
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        /** @var StoreLocatorSearchResultInterface $searchResult */
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
