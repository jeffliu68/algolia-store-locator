<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\StoreLocator\Command;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator;

/**
 * Class Save
 *
 * @package MagentoGuy\StoreLocator\Model\StoreLocator\Command
 */
class Save
{
    /**
     * @var StoreLocator
     */
    private $storeLocatorResource;

    /**
     * Save constructor
     *
     * @param StoreLocator $storeLocator
     */
    public function __construct(StoreLocator $storeLocator)
    {
        $this->storeLocatorResource = $storeLocator;
    }

    /**
     * @param StoreLocatorInterface $storeLocator
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(StoreLocatorInterface $storeLocator): int
    {
        try {
            $this->storeLocatorResource->save($storeLocator);

            return $storeLocator->getStoreId();
        } catch (Exception $e) {
            throw new CouldNotSaveException(__('Could not save store'), $e);
        }
    }
}
