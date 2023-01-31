<?php

namespace Loader\Adapter;

/**
 * Abstract adapter
 *
 * @category    Adapter
 * @author      David Villalba Flores
 */
interface LoaderAdapterInterface
{

    /**
     * Get config form a file and create an object with the configuration.
     * @param string $configFileName
     * @return array
     */
    public function loadConfig(string $configFileName): ?array;

    /**
     * Takes Original Config and overwrite config and merge in one config array.
     * @param array $configData
     * @param string $configFileName
     * @return array
     */
    public function overwriteConfig(array $configData, string $configFileName): array;

    /**
     * Validate config file have the right format.
     * @param string $configRawData
     * @return boolean
     */
    public function validate(string $configRawData): bool;


}
