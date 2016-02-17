<?php

namespace Chernoff\Container;

use Illuminate\Container\Container;

/**
 * Class ContainerFactory
 * @package Chernoff\Container
 */
class ContainerFactory
{
    /** @var  \Illuminate\Container\Container */
    private static $container;

    private function __construct() {}

    private function __clone() {}

    /**
     * @return \Illuminate\Container\Container
     */
    public static function getContainer()
    {
        if (empty(self::$container)) {
            self::$container = new Container();
        }

        return self::$container;
    }

    /**
     * @param array $providers
     */
    public static function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            /** @var ServiceProvider $instance */
            $instance = new $provider(self::getContainer());

            // We want to register services only once.
            if (!$instance->isRegistered()) {
                $instance->setRegistered(true)->register();
            }
        }
    }

    /**
     * @param array $providers
     */
    public static function bootProviders(array $providers)
    {
        foreach ($providers as $provider) {
            /** @var ServiceProvider $instance */
            $instance = new $provider(self::getContainer());

            // We want to boot services only once.
            if (!$instance->isBooted()) {
                $instance->setBooted(true)->boot();
            }
        }
    }
}
