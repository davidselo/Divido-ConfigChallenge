<?php
declare(strict_types=1);

namespace Tests\Loader;


use PHPUnit\Framework\TestCase;
use Loader\Config;

/**
 * Class ConfigTest
 * @package Tests
 * @covers
 */
class ConfigTest extends TestCase
{
    public function testClassConstructor(){
        // arrange
        $config = new Config('json');
        // act

        // assert
        $this->assertSame('Loader\Adapter\JsonAdapter', get_class($config->getAdapter()));

    }

}