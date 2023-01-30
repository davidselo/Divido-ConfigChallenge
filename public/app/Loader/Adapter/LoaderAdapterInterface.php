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
     * @param string $configData
     * @return array
     */
    public function loadConfig(string $configData): array;

    /**
     * Takes Original Config and overwrite config and merge in one config array.
     * @param array $configData
     * @param string $configOverwrite
     * @return array
     */
    public function overwriteConfig(array $configData, string $configOverwrite): array;

    /**
     * Validate config file have the right format.
     * @param string $configData
     * @return boolean
     */
    public function validate(string $configData): bool;


}
