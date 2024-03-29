<?php

namespace Loader;


use Loader\Adapter\JsonAdapter;
use Loader\Adapter\LoaderAdapterInterface;
use Exception;

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

    /**
     * @param array $configs
     */
    public function loadConfigFiles(array $configs): void
    {
        // 1. Load all the files in an array and merge them in one array.
        $result = array_reduce(
            $configs,
            function ($carry, $item) {
                $carry = $this->arrayMergeDeep([$carry, $this->getAdapter()->loadConfig($item)]);
                return $carry;
            },
            $this->getConfig()
        );
        // 2. Add config array to $_globalConfig variable.
        $this->setConfig($result);
    }

    /**
     * Method to merge and overwrite configuration values on the global config array.
     * @param $arrays
     * @return array
     */
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

    /**
     * Get config value per key provided
     * @param string $configParameterKey
     * @return array | string
     * @throws Exception
     */
    public function get(string $configParameterKey)
    {
        // 1. Validate $configParameter
        if (!$this->validateConfigParameterKey($configParameterKey)) {
            throw new Exception('Wrong parameter format.');
        }

        // 2. Split string by "."
        $parameterChain = explode('.', $configParameterKey);

        // 3. Retrieve parameter value from $_globalConfig variable.
        // Note: Retrieve variable value if it's a string or Array if there are more nesting configurations.
        return $this->recursiveArrayRetrieval($parameterChain, $this->getConfig());
    }

    private function validateConfigParameterKey(string $parameterKey): bool
    {
        $matches = [];
        $regex = '/^([A-Za-z0-9]+)(\.[A-Za-z0-9]+)*$/';
        return preg_match($regex, $parameterKey, $matches);
    }

    /**
     * @param array $configValueKey
     * @param array $configArray
     * @return array | string | null
     */
    private function recursiveArrayRetrieval(array $configValueKey, array $configArray)
    {
        // 1. Arrange parameter to access to values.
        $reverseArray = array_reverse($configValueKey);
        $configItemKey = array_pop($reverseArray);

        // 1. breakpoint recursion
        if (count($configValueKey) == 1 &&
            array_key_exists($configItemKey, $configArray)
        ) {
            return $configArray[$configItemKey];
        }

        // 2. Case we still have to go deep on the array.
        // 2.1 unhappy path where the config value doesn't exist.
        if(!array_key_exists($configItemKey, $configArray)) return null;

        // 2.2 happy path: the key exist on the config Array.
        array_shift($configValueKey);
        return $this->recursiveArrayRetrieval($configValueKey, $configArray[$configItemKey]);
    }

}
