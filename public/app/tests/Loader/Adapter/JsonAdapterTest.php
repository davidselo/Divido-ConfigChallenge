<?php


declare(strict_types=1);

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));

use PHPUnit\Framework\TestCase;
use Loader\Adapter\JsonAdapter;

class JsonAdapterTest extends TestCase
{
    const FIXTURES_FOLDER = 'app/tests/fixtures';
    const CONFIG_FILE_SUCCESS_FIXTURE = 'config.json';
    const CONFIG_FILE_FAILURE_FIXTURE = 'config.invalid.json';

    /**
     * @covers Loader\Adapter\LoaderInterface::overwriteConfig()
     */
    public function testOverwriteConfig(): void
    {
        // Arrange
        $configDataArrayMock = ['environment' => 'staging'];
        $jsonAdapterMock = new JsonAdapter(self::FIXTURES_FOLDER);

        // Act
        $result = $jsonAdapterMock->overwriteConfig($configDataArrayMock, self::CONFIG_FILE_SUCCESS_FIXTURE);

        // Assert
        $this->assertEquals($result['environment'], 'production');
    }

    /**
     * @covers Loader\Adapter\LoaderInterface::__construct()
     */
    public function testJsonAdapterConstruct()
    {
        // Arrange
        $jsonAdapterMock = new JsonAdapter();

        // Act

        // Assert
        $this->assertInstanceOf('\\Loader\\Adapter\\JsonAdapter', $jsonAdapterMock);
    }

    /**
     * @covers Loader\Adapter\LoaderInterface::loadConfig()
     */
    public function testLoadConfigOnSuccess()
    {
        // Arrange
        $configDataMock = $this->getMockBuilder('\\Loader\\Adapter\\JsonAdapter')
            ->setConstructorArgs(array(self::FIXTURES_FOLDER))
            ->onlyMethods(['validate'])
            ->getMock();
        $configDataMock->expects($this->once())->method('validate')->will($this->returnValue(true));

        // Act
        $result = $configDataMock->loadConfig(self::CONFIG_FILE_SUCCESS_FIXTURE);

        // Assert
        $this->assertEquals('production', $result['environment']);
    }

    /**
     * @covers Loader\Adapter\LoaderInterface::loadConfig()
     */
    public function testLoadConfigOnFailure()
    {
        // Arrange
        $jsonAdapterMock = new JsonAdapter(self::FIXTURES_FOLDER);

        // Act
        $this->expectException(Exception::class);
        $result = $jsonAdapterMock->loadConfig(self::CONFIG_FILE_FAILURE_FIXTURE);
        // Assert

    }

    /**
     * @covers Loader\Adapter\LoaderInterface::validate()
     * @throws Exception
     */
    public function testValidateOnSuccess(): void
    {
        $jsonAdapterMock = new JsonAdapter(self::FIXTURES_FOLDER);
        $fileContentMock = <<< JSON
                {
                  "environment": "production",
                  "database": {
                    "host": "mysql",
                    "port": 3306,
                    "username": "divido",
                    "password": "divido"
                  },
                  "cache": {
                    "redis": {
                      "host": "redis",
                      "port": 6379
                    }
                  }
                }
JSON;

        $result = $jsonAdapterMock->validate($fileContentMock);
        $this->assertTrue($result);
    }

    /**
     * @covers Loader\Adapter\LoaderInterface::validate()
     */
    public function testValidateOnFailure(): void
    {
        $jsonAdapterMock = new JsonAdapter(self::FIXTURES_FOLDER);
        $fileContentMock = <<< JSON
                This is not a valid JSON file
JSON;
        $this->expectException(Exception::class);
        $jsonAdapterMock->validate($fileContentMock);
    }

}