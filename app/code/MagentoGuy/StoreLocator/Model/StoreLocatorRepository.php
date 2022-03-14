<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Api\StoreLocatorRepositoryInterface;
use MagentoGuy\StoreLocator\Model\StoreLocator\Command\Get;
use MagentoGuy\StoreLocator\Model\StoreLocator\Command\GetList;
use MagentoGuy\StoreLocator\Model\StoreLocator\Command\Save;
use MagentoGuy\StoreLocator\Model\StoreLocator\Command\DeleteById;
use MagentoGuy\StoreLocator\Api\StoreLocatorSearchResultInterface;

/**
 * Class StoreLocatorRepository
 *
 * @package MagentoGuy\StoreLocator\Model
 */
class StoreLocatorRepository implements StoreLocatorRepositoryInterface
{
    /**
     * @var Get
     */
    private $get;

    /**
     * @var GetList
     */
    private $getList;

    /**
     * @var Save
     */
    private $save;
    /**
     * @var DeleteById
     */
    private $deleteById;

    /**
     * StoreLocatorRepository constructor
     *
     * @param Get $get
     * @param GetList $getList
     * @param Save $save
     * @param DeleteById $deleteById
     */
    public function __construct(
        Get $get,
        GetList $getList,
        Save $save,
        DeleteById $deleteById
    ) {
        $this->get = $get;
        $this->getList = $getList;
        $this->save = $save;
        $this->deleteById = $deleteById;
    }

    /**
     * Get Command
     *
     * @param int $storeId
     * @return StoreLocatorInterface
     * @throws NoSuchEntityException
     */
    public function get(int $storeId): StoreLocatorInterface
    {
        return $this->get->execute($storeId);
    }

    /**
     * GetList Command
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return StoreLocatorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): StoreLocatorInterface
    {
        return $this->getList->execute($searchCriteria);
    }

    /**
     * Save Command
     *
     * @param StoreLocatorInterface $storeLocator
     * @return int
     * @throws CouldNotSaveException
     */
    public function save(StoreLocatorInterface $storeLocator): int
    {
        return $this->save->execute($storeLocator);
    }

    /**
     * @param int $storeId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $storeId): void
    {
        $this->deleteById->execute($storeId);
    }
}
