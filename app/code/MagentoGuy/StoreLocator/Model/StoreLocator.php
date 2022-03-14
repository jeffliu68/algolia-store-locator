<?php
declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface;
use MagentoGuy\StoreLocator\Model\ResourceModel\StoreLocator as ResourceModel;

/**
 * Class StoreLocator
 *
 * @package MagentoGuy\StoreLocator\Model
 */
class StoreLocator extends AbstractModel implements StoreLocatorInterface, IdentityInterface
{

    /**
     * Initialize StoreLocator model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_idFieldName = static::STORE_ID;
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities(): array
    {
        return [
            static::STORE_ID . "_" . $this->getStoreId()
        ];
    }

    /**
     * @inheritDoc
     */
    public function getStoreId(): int
    {
        return (int)$this->getData(static::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId(int $storeId): StoreLocatorInterface
    {
        $this->setData(static::STORE_ID, $storeId);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreName(): string
    {
        return (string)$this->getData(static::STORE_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setStoreName(string $storeName): StoreLocatorInterface
    {
        $this->setData(static::STORE_NAME, $storeName);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStorePhone(): string
    {
        return (string)$this->getData(static::STORE_PHONE);
    }

    /**
     * @inheritDoc
     */
    public function setStorePhone(string $storePhone): StoreLocatorInterface
    {
        $this->setData(static::STORE_PHONE, $storePhone);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreCity(): string
    {
        return (string)$this->getData(static::STORE_CITY);
    }

    /**
     * @inheritDoc
     */
    public function setStoreCity(string $storeCity): StoreLocatorInterface
    {
        $this->setData(static::STORE_CITY, $storeCity);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreState(): string
    {
        return (string)$this->getData(static::STORE_STATE);
    }

    /**
     * @inheritDoc
     */
    public function setStoreState(string $storeState): StoreLocatorInterface
    {
        $this->setData(static::STORE_STATE, $storeState);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreCountry(): string
    {
        return (string)$this->getData(static::STORE_COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setStoreCountry(string $storeCountry): StoreLocatorInterface
    {
        $this->setData(static::STORE_COUNTRY, $storeCountry);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreZip(): string
    {
        return (string)$this->getData(static::STORE_ZIP);
    }

    /**
     * @inheritDoc
     */
    public function setStoreZip(string $storeZip)
    {
        $this->setData(static::STORE_ZIP, $storeZip);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreAddress(): string
    {
        return (string)$this->getData(static::STORE_ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setStoreAddress(string $storeAddress): StoreLocatorInterface
    {
        $this->setData(static::STORE_ADDRESS, $storeAddress);

        return $this;
    }
}
