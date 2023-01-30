<?php

declare(strict_types=1);

namespace Tests\Loader;


use PHPUnit\Framework\TestCase;
use Loader\Config;

/**
 * Class ConfigTest
 * @package Tests
 */
class ConfigTest extends TestCase
{
    /**
     * @covers Loader\Config::__construct()
     */
    public function testClassConstructor()
    {
        // Arrange
        $configMock = new Config('json');

        // Act

        // Assert
        $this->assertInstanceOf('\\Loader\\Adapter\\JsonAdapter', $configMock->getAdapter());
    }

    /**
     * @covers Loader\Config::getConfig()
     */
    public function testGetConfig()
    {
        // Arrange
        $configMock = new Config('json');

        // Act
        $configArray = $configMock->getConfig();

        // Assert
        $this->assertClassHasAttribute('_config', '\\Loader\\Config');
        $this->assertIsArray($configArray);
    }

    /**
     * @covers Loader\Config::getAdapter()
     */
    public function testGetAdapter()
    {
        // Arrange
        $configMock = new Config('json');

        // Act

        // Assert
        $this->assertClassHasAttribute('_adapter', '\\Loader\\Config');
    }

}