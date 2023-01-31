<?php

namespace Loader\Adapter;

use Exception;
use Loader\Adapter\LoaderInterface;

class JsonAdapter implements LoaderAdapterInterface
{
    /**
     * @var string
     */
    private $_configPath;

    /**
     * JsonAdapter constructor.
     * @param string $configPath
     */
    public function __construct(string $configPath = 'app/data/static')
    {
        $this->_configPath = $configPath;
    }

    /**
     * @param array $configData
     * @param string $configFileName
     * @return array
     * @throws Exception
     */
    public function overwriteConfig(array $configData, string $configFileName): array
    {
        // We assume $configData is already retrieved with loadConfig, therefore is a valid config file.
        // 1. Load overwrite config.
        $overwriteConfigArray = $this->loadConfig($configFileName);

        // 2. merge array and return new config.

        return array_merge($configData, $overwriteConfigArray);
    }

    /**
     * @param string $configFileName
     * @return array
     * @throws Exception
     */
    public function loadConfig(string $configFileName): ?array
    {
        // 1. Check file exists.
        $fileContent = file_get_contents("." . DS . $this->_configPath . DS . $configFileName);
        if (!$fileContent) {
            throw new Exception("An error has occurred on config retrieval");
        }

        // 2. validate file.
        $this->validate($fileContent);

        // 3. return array with the file content.
        return json_decode($fileContent, true);
    }

    /**
     * @param string $configRawData
     * @return bool
     * @throws Exception
     */
    public function validate(string $configRawData): bool
    {
        $configArray = json_decode($configRawData, true);
        if (!$configArray) {
            throw new Exception("Invalid Json File");
        }
        return true;
    }
}