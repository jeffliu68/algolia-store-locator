<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Api;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @package MagentoGuy\StoreLocator\Api
 */
interface StoreLocatorSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface[]
     */
    public function getItems(): array;

    /**
     * @param \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface[] $items
     * @return void
     */
    public function setItems(array $items): void;
}
