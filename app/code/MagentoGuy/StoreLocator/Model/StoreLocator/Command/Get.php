<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\StoreLocator\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use MagentoGuy\StoreLocator\Model\StoreLocator as StoreLocatorModel;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator;

/**
 * Class Get
 *
 * @package MagentoGuy\StoreLocator\Model\StoreLocator\Command
 */
class Get
{
    /**
     * @var StoreLocatorInterfaceFactory
     */
    private $storeLocatorInterfaceFactory;

    /**
     * @var StoreLocator
     */
    private $storeLocatorResource;

    /**
     * Get constructor
     *
     * @param StoreLocatorInterfaceFactory $storeLocatorInterfaceFactory
     * @param StoreLocator $storeLocatorResource
     */
    public function __construct(
        StoreLocatorInterfaceFactory $storeLocatorInterfaceFactory,
        StoreLocator $storeLocatorResource
    ) {
        $this->storeLocatorInterfaceFactory = $storeLocatorInterfaceFactory;
        $this->storeLocatorResource = $storeLocatorResource;
    }

    /**
     * @param int $id
     * @return StoreLocatorInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $id): StoreLocatorInterface
    {
        /** @var StoreLocatorInterface $storeLocator */
        $storeLocator = $this->storeLocatorInterfaceFactory->create();
        $this->storeLocatorResource->load($storeLocator, $id, StoreLocatorModel::STORE_ID);

        if (!$storeLocator->getStoreId()) {
            throw new NoSuchEntityException(__('Store with id "%value" does not exist.', ['value' => $id]));
        }

        return $storeLocator;
    }
}
