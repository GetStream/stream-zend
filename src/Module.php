<?php

namespace GetStream\Zend;

use Zend\ModuleManager\Feature\ServiceProviderInterface;

use GetStream\Stream\Client;
use Psr\Container\ContainerInterface;

class Module implements ServiceProviderInterface
{
    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Client::class => function (ContainerInterface $container) {
                    $config = $container->get('config');

                    if (isset($config['stream']['url'])) {
                        return Client::herokuConnect($config['stream']['url']);
                    }

                    return new Client(
                        $config['stream']['app_key'],
                        $config['stream']['app_secret']
                    );
                },
            ],
            'shared' => [
                Client::class => true,
            ],
        ];
    }
}
