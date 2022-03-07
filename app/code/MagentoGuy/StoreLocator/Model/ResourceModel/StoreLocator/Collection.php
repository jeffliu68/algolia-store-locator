<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct(): void
    {
        $this->_init(
            \MagentoGuy\StoreLocator\Model\StoreLocator::class,
            \MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator::class
        );
    }
}
