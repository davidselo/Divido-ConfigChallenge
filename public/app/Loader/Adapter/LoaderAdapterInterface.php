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
     * Validate config file have the right format.
     * @param string $configRawData
     * @return boolean
     */
    public function validate(string $configRawData): bool;


}
