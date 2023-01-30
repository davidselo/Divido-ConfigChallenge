<?php

namespace Loader\Adapter;

use Exception;
use Loader\Adapter\LoaderInterface;

class JsonAdapter implements LoaderAdapterInterface
{

    private $_configPath = 'app/data/static';

    /**
     * @param array $configData
     * @param string $configOverwrite
     * @return array
     * @throws Exception
     */
    public function overwriteConfig(array $configData, string $configOverwrite): array
    {
        // We assume $configData is already retrieved with loadConfig, therefore is a valid config file.
        // 1. Load overwrite config.
        $overwriteConfigArray = $this->loadConfig($configOverwrite);

        // 2. merge array and return new config.

        return array_merge($configData, $overwriteConfigArray);
    }

    /**
     * @param string $configData
     * @return array
     * @throws Exception
     */
    public function loadConfig(string $configData): array
    {
        // 1. Check file exists.
        $fileContent = file_get_contents("." . DS . $this->_configPath . DS . $configData);
        if (!$fileContent) {
            throw new Exception("An error has occurred on config retrieval");
        }

        // 2. validate file.
        $this->validate($fileContent);

        // 3. return array with the file content.
        return json_decode($fileContent, true);
    }

    /**
     * @param string $configData
     * @return bool
     * @throws Exception
     */
    public function validate(string $configData): bool
    {
        $configArray = json_decode($configData, true);
        if (!$configArray) {
            throw new Exception("Invalid Json File");
        }
        return true;
    }
}