<?php

namespace GetStream\Zend\Unit;

use GetStream\Stream\Client;
use GetStream\Zend\Module;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class ModuleTest extends TestCase
{
    /** @test */
    public function implementsServiceProviderInterface()
    {
        // Arrange
        $module = new Module();

        // Act
        // Assert
        $this->assertInstanceOf(ServiceProviderInterface::class, $module);
    }

    /** @test */
    public function setsClientFactory()
    {
        // Arrange
        $module = new Module();

        // Act
        $config = $module->getServiceConfig();

        // Assert
        $this->assertContains('factories', array_keys($config));
        $this->assertContains(Client::class, array_keys($config['factories']));
        $this->assertInternalType('callable', $config['factories'][Client::class]);
    }

    /** @test */
    public function sharesClient()
    {
        // Arrange
        $module = new Module();

        // Act
        $config = $module->getServiceConfig();

        // Assert
        $this->assertContains('shared', array_keys($config));
        $this->assertContains(Client::class, array_keys($config['shared']));
        $this->assertTrue($config['shared'][Client::class]);
    }

    /** @test */
    public function factoryInitiatesClientFromURL()
    {
        // Arrange
        $module = new Module();
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())->method('get')->with('config')->willReturn([
            'stream' => [
                'url' => 'https://blabla:blabla@api.stream-api.com/',
            ],
        ]);

        // Act
        $config = $module->getServiceConfig();
        $callable = $config['factories'][Client::class];

        // Assert
        $response = $callable($container);

        $this->assertInstanceOf(Client::class, $response);
    }

    /** @test */
    public function factoryInitiatesClientFromCredentials()
    {
        // Arrange
        $module = new Module();
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())->method('get')->with('config')->willReturn([
            'stream' => [
                'app_key' => 'mock key',
                'app_secret' => 'mock secret',
            ],
        ]);

        // Act
        $config = $module->getServiceConfig();
        $callable = $config['factories'][Client::class];

        // Assert
        $response = $callable($container);

        $this->assertInstanceOf(Client::class, $response);
    }
}
