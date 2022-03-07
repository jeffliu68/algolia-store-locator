<?php

declare(strict_types=1);

namespace MagentoGuy\StoreLocator\Setup;

use Exception;
use Magento\Framework\File\Csv;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader;

/**
 * Class SampleCsvReader
 *
 * @package MagentoGuy\StoreLocator\Setup
 */
class SampleCsvReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var Csv
     */
    private $csv;

    /**
     * SampleCsvReader constructor
     *
     * @param Reader $reader
     * @param Csv $csv
     */

    public function __construct(
        Reader $reader,
        Csv $csv
    ) {
        $this->reader = $reader;
        $this->csv = $csv;
    }

    /**
     * Read the csv file
     *
     * @param string $fileName
     * @return array
     * @throws Exception
     */
    public function read(string $fileName): array
    {
        $path = $this->getFilePath($fileName);

        return $this->csv->getData($path);
    }
    /**
     * Return the path of a file
     *
     * @param string $fileName
     * @return string
     */
    private function getFilePath(string $fileName): string
    {
        $dir = $this->reader->getModuleDir(
            Dir::MODULE_SETUP_DIR,
            'MagentoGuy_StoreLocator'
        );

        return $dir . DIRECTORY_SEPARATOR . $fileName;
    }
}
