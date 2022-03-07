<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\StoreLocator\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use MagentoGuy\StoreLocator\Model\StoreLocator as StoreLocatorModel;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator;

/**
 * Class DeleteById
 * @package MagentoGuy\StoreLocator\Model\StoreLocator\Command
 */
class DeleteById
{
    /**
     * @var StoreLocator
     */
    private $storeLocatorResource;

    /**
     * @var StoreLocatorInterfaceFactory
     */
    private $storeLocatorInterfaceFactory;

    /**
     * DeleteById constructor.
     * @param StoreLocator $storeLocatorResource
     * @param StoreLocatorInterfaceFactory $storeLocatorInterfaceFactory
     */
    public function __construct(
        StoreLocator $storeLocatorResource,
        StoreLocatorInterfaceFactory $storeLocatorInterfaceFactory
    ) {
        $this->storeLocatorResource = $storeLocatorResource;
        $this->storeLocatorInterfaceFactory = $storeLocatorInterfaceFactory;
    }

    /**
     * @param int $id
     * @throws NoSuchEntityException
     * @throws \Exception
     */
    public function execute(int $id): void
    {
        /** @var StoreLocatorInterface $storeLocator */
        $storeLocator = $this->storeLocatorInterfaceFactory->create();
        $this->storeLocatorResource->load($storeLocator, $id, StoreLocatorModel::STORE_ID);

        if (!$storeLocator->getStoreId()) {
            throw new NoSuchEntityException(
                __(
                    'There is no store with "%fieldValue" for "%fieldName". Verify and try again.',
                    [
                        'fieldName' => StoreLocatorModel::STORE_ID,
                        'fieldValue' => $id
                    ]
                )
            );
        }

        $this->storeLocatorResource->delete($storeLocator);
    }
}
