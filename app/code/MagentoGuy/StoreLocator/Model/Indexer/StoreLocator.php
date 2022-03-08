<?php

namespace MagentoGuy\StoreLocator\Model\Indexer;

use Algolia\AlgoliaSearch\Helper\ConfigHelper;
use MagentoGuy\StoreLocator\Helper\Data as CustomHelper;
use Algolia\AlgoliaSearch\Model\Queue;
use Magento\Framework\Message\ManagerInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

class StoreLocator implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
    private $customHelper;
    private $queue;
    private $configHelper;
    private $messageManager;
    private $output;

    public function __construct(
        CustomHelper $customHelper,
        Queue $queue,
        ConfigHelper $configHelper,
        ManagerInterface $messageManager,
        ConsoleOutput $output
    ) {
        $this->customHelper = $customHelper;
        $this->queue = $queue;
        $this->configHelper = $configHelper;
        $this->messageManager = $messageManager;
        $this->output = $output;
    }

    public function execute($storeIds)
    {
        if (!$this->configHelper->getApplicationID()
            || !$this->configHelper->getAPIKey()
            || !$this->configHelper->getSearchOnlyAPIKey()) {
            $errorMessage = 'Algolia reindexing failed: 
                You need to configure your Algolia credentials in Stores > Configuration > Algolia Search.';

            if (php_sapi_name() === 'cli') {
                $this->output->writeln($errorMessage);

                return;
            }

            $this->messageManager->addErrorMessage($errorMessage);

            return;
        }

        $this->queue->addToQueue($this->customHelper, 'rebuildStoreLocatorIndex', ['storeIds' => $storeIds], 1);
    }

    public function executeFull()
    {
        $this->execute(null);
    }

    public function executeList(array $storeIds)
    {
        $this->execute($storeIds);
    }

    public function executeRow($storeId)
    {
        $this->execute([$storeId]);
    }
}
