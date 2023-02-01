<?php

namespace Loader;


use Loader\Adapter\JsonAdapter;
use Loader\Adapter\LoaderAdapterInterface;

class Config
{
    /**
     * @var array
     */
    private $_globalConfig = [];

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

    public function loadConfigFiles(array $configHandlers): void
    {
        // 1. Load all the files in an array and merge them in one array.
        $result = array_reduce(
            $configHandlers,
            function ($carry, $item) {
                $carry = $this->arrayMergeDeep([$carry, $this->getAdapter()->loadConfig($item)]);
                return $carry;
            },
            $this->getConfig()
        );
        // 2. Add config array to $_globalConfig variable.
        $this->setConfig($result);
    }

    private function arrayMergeDeep($arrays): array
    {
        $result = [];
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (is_integer($key)) {
                    $result[] = $value;
                } elseif (isset($result[$key]) &&
                    is_array($result[$key]) &&
                    is_array($value)) {
                    $result[$key] = $this->arrayMergeDeep(
                        [
                            $result[$key],
                            $value,
                        ]
                    );
                } else {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }

    public function getAdapter(): LoaderAdapterInterface
    {
        return $this->_adapter;
    }

    public function getConfig(): array
    {
        return $this->_globalConfig;
    }

    public function setConfig(array $config): array
    {
        return $this->_globalConfig = $config;
    }

}
