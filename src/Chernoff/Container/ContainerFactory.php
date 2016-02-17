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
    public static function loadProviders(array $providers)
    {
        foreach ($providers as $provider) {
            /** @var ServiceProvider $instance */
            $instance = new $provider(self::getContainer());

            // We want to load services only once.
            if (!$instance->isLoaded()) {
                $instance->setLoaded(true)->register();
            }
        }
    }
}
