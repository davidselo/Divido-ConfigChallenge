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
     * @param string $file
     * @return array
     */
    public function loadConfig(string $file): array;

    /**
     * Overwrite config array values with additional config.
     * @param string $file
     * @return array
     */
    public function overwriteConfig(string $file): array;


}
