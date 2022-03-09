<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use MagentoGuy\StoreLocator\Model\Indexer\StoreLocator\Processor;
use MagentoGuy\StoreLocator\Model\StoreLocator as StoreLocatorModel;

class StoreLocator extends AbstractDb
{
    protected $_eventPrefix = StoreLocatorModel::TABLE_NAME;
    private Processor $indexProcessor;

    public function __construct(
        Context $context,
        Processor $indexProcessor,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->indexProcessor = $indexProcessor;
    }

    protected function _construct(): void
    {
        $this->_init(StoreLocatorModel::TABLE_NAME, StoreLocatorModel::STORE_ID);
    }

    protected function _afterSave(AbstractModel $object)
    {
        parent::_afterSave($object);
        $storeId = $object->getStoreId();
        $this->addCommitCallback(function () use ($storeId) {
            if (!$this->indexProcessor->isIndexerScheduled()) {
                $this->indexProcessor->reindexRow($storeId);
            }
        });
    }
}
