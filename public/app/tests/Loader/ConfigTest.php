<?php

declare(strict_types=1);

namespace Tests\Loader;


use PHPUnit\Framework\TestCase;
use Loader\Config;
use Loader\Adapter\JsonAdapter;
use ReflectionClass;
use ReflectionException;

/**
 * Class ConfigTest
 * @package Tests
 */
class ConfigTest extends TestCase
{

    const FIXTURES_FOLDER = 'app/tests/fixtures';

    /**
     * @covers Loader\Config::__construct()
     */
    public function testClassConstruct()
    {
        // Arrange
        $config = new Config('json');

        // Act

        // Assert
        $this->assertInstanceOf('\\Loader\\Adapter\\JsonAdapter', $config->getAdapter());
    }

    /**
     * @covers Loader\Config::getConfig()
     */
    public function testGetConfig()
    {
        // Arrange
        $config = new Config('json');

        // Act
        $configArray = $config->getConfig();

        // Assert
        $this->assertClassHasAttribute('_globalConfig', '\\Loader\\Config');
        $this->assertIsArray($configArray);
    }

    /**
     * @covers Loader\Config::getAdapter()
     */
    public function testGetAdapter()
    {
        // Arrange
        $config = new Config('json');

        // Act

        // Assert
        $this->assertClassHasAttribute('_adapter', '\\Loader\\Config');
    }

    /**
     * @covers Loader\Config::arrayMergeDeep()
     */
    public function testArrayMergeDeep()
    {
        // Arrange
        $array1 = ['environment' => ['database' => 'production']];
        $array2 = [
            'environment' => [
                'database' => 'development',
                'host' => 'divido.dev'
            ]
        ];
        $config = new Config('json');

        // Act
        $result = $this->invokeMethod($config, 'arrayMergeDeep', [[$array1, $array2]]);

        // Assert
        $this->assertEquals('development', $result['environment']['database']);
        $this->assertEquals('divido.dev', $result['environment']['host']);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @covers Loader\Config::loadConfigFiles()
     */
    public function testLoadConfigFiles()
    {
        // Arange
        $configDataMock = $this->getMockBuilder('\\Loader\\Config')
            ->setConstructorArgs(array('json'))
            ->onlyMethods(['getAdapter'])
            ->getMock();
        $configDataMock->expects($this->atLeastOnce())->method('getAdapter')->will(
            $this->returnValue(new JsonAdapter(self::FIXTURES_FOLDER))
        );

        // Act
        $configDataMock->loadConfigFiles(['config.json', 'config.local.json']);

        // Assert
        $this->assertEquals('development', $configDataMock->getConfig()['environment']);
    }

}