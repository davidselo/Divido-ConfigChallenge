<?php

namespace Loader;


use Loader\Adapter\JsonAdapter;
use Loader\Adapter\LoaderAdapterInterface;

class Config
{
    /**
     * @var array
     */
    private $_config = [];

    /**
     * @var LoaderAdapterInterface
     */
    private $_adapter;

    private $_adaptersMap = [
        'json' => 'Loader\Adapter\JsonAdapter'
    ];

    public function __construct(string $configType)
    {
        $this->_adapter = new $this->_adaptersMap[$configType]();
    }


    public function getConfig(): array
    {
        return $this->_config;
    }

    public function getAdapter(): LoaderAdapterInterface
    {
        return $this->_adapter;
    }

    public function loadConfigFiles( array $configHandlers){
        // 1. Load all the files in an array and merge them in one array.
        // 2. Add config array to $_config variable.
    }

}
