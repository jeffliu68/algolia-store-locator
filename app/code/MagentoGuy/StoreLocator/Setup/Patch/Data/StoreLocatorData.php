<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Api\StoreLocatorRepositoryInterface;
use MagentoGuy\StoreLocator\Setup\SampleCsvReader;

/**
 * Class StoreLocatorData
 *
 * @package MagentoGuy\StoreLocator\Setup\Patch\Data
 */
class StoreLocatorData implements DataPatchInterface
{
    /**
     * @var SampleCsvReader
     */
    private $sampleCsvReader;

    /**
     * @var StoreLocatorRepositoryInterface
     */
    private $storeLocatorRepository;

    /**
     * @var StoreLocatorInterfaceFactory
     */
    private $storeLocatorFactory;

    /**
     * @var array
     */
    private $aliases;

    /**
     * @param SampleCsvReader $sampleCsvReader
     * @param StoreLocatorRepositoryInterface $storeLocatorRepository
     * @param StoreLocatorInterfaceFactory $storeLocatorFactory
     */
    public function __construct(
        SampleCsvReader $sampleCsvReader,
        StoreLocatorRepositoryInterface $storeLocatorRepository,
        StoreLocatorInterfaceFactory $storeLocatorFactory
    ) {
        $this->sampleCsvReader = $sampleCsvReader;
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->aliases = [];
    }

    /**
     * @inheritDoc
     */
    public function apply(): StoreLocatorData
    {
        $data = $this->sampleCsvReader->read('source/store_locator.csv');

        foreach ($data as $row) {
            /** @var StoreLocatorInterface $storeLocator */
            $storeLocator = $this->storeLocatorFactory->create();
            $storeLocator->setStoreName((string)$row[0]);
            $storeLocator->setStorePhone((string)$row[1]);
            $storeLocator->setStoreAddress((string)$row[2]);
            $storeLocator->setStoreCity((string)$row[3]);
            $storeLocator->setStoreState((string)$row[4]);
            $storeLocator->setStoreZip((string)$row[5]);
            $storeLocator->setStoreCountry((string)$row[6]);
            $this->storeLocatorRepository->save($storeLocator);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }
}
