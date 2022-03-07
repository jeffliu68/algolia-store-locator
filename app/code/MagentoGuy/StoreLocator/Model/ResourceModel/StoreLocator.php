<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MagentoGuy\StoreLocator\Model\StoreLocator as StoreLocatorModel;

class StoreLocator extends AbstractDb
{
    protected $_eventPrefix = StoreLocatorModel::TABLE_NAME;

    protected function _construct(): void
    {
        $this->_init(StoreLocatorModel::TABLE_NAME, StoreLocatorModel::STORE_ID);
    }
}
