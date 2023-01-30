<?php

namespace Loader;


use Loader\Adapter\JsonAdapter;
use Loader\Adapter\LoaderAdapterInterface;

class Config
{
    /**
     * @var array
     */
    private $_config;

    /**
     * @var LoaderAdapterInterface
     */
    private $_adapter;

    private $_adaptersMap = [
        'json' => 'Loader\Adapter\JsonAdapter'
    ];

    public function __construct(string $configType)
    {
        // @todo: error handling on no adapter found.
        $this->_adapter = new $this->_adaptersMap[$configType]();
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->_config;
    }

    public function getAdapter(): LoaderAdapterInterface
    {
        return $this->_adapter;
    }

}
