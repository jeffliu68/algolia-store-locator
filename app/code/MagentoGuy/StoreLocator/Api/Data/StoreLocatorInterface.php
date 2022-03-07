<?php

namespace MagentoGuy\StoreLocator\Api\Data;

/**
 * Interface StoreLocatorInterface
 *
 * @package MagentoGuy\StoreLocator\Api\Data
 */
interface StoreLocatorInterface
{
    public const TABLE_NAME = "store_locator";
    public const STORE_ID = "store_id";
    public const STORE_NAME = "store_name";
    public const STORE_PHONE = "store_phone";
    public const STORE_ADDRESS = "store_address";
    public const STORE_CITY = "store_city";
    public const STORE_STATE = "store_state";
    public const STORE_ZIP = "store_zip";
    public const STORE_COUNTRY = "store_country";

    /**
     * @return int
     */
    public function getStoreId(): int;

    /**
     * @param int $storeId
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreId(int $storeId);

    /**
     * @return string
     */
    public function getStoreName(): string;

    /**
     * @param string $storeName
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreName(string $storeName);

    /**
     * @return string
     */
    public function getStorePhone(): string;

    /**
     * @param string $storePhone
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStorePhone(string $storePhone);

    /**
     * @return string
     */
    public function getStoreAddress(): string;

    /**
     * @param string $storeAddress
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreAddress(string $storeAddress);

    /**
     * @return string
     */
    public function getStoreCity(): string;

    /**
     * @param string $storeCity
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreCity(string $storeCity);

    /**
     * @return string
     */
    public function getStoreState(): string;

    /**
     * @param string $storeState
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreState(string $storeState);

    /**
     * @return string
     */
    public function getStoreZip(): string;

    /**
     * @param string $storeZip
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreZip(string $storeZip);

    /**
     * @return string
     */
    public function getStoreCountry(): string;

    /**
     * @param string $storeCountry
     * @return \MagentoGuy\StoreLocator\Api\Data\StoreLocatorInterface
     */
    public function setStoreCountry(string $storeCountry);
}
