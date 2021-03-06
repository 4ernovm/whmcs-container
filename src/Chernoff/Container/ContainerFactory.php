<?php

namespace Chernoff\Container;

use Illuminate\Container\Container;

/**
 * Class ContainerFactory
 * @package Chernoff\Container
 */
class ContainerFactory
{
    /** @var Container */
    private static $container;

    /** @var  array */
    private static $providers = [];

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
            self::register(new $provider(self::getContainer()));
        }
    }

    /**
     * @param array $providers
     */
    public static function bootProviders(array $providers)
    {
        self::$providers = array_unique(array_merge(self::$providers, $providers));
        self::registerProviders(self::$providers);

        foreach (self::$providers as $provider) {
            self::boot(new $provider(self::getContainer()));
        }
    }

    /**
     * @param ServiceProvider $provider
     */
    protected static function register(ServiceProvider $provider)
    {
        // We want to register services only once.
        if (!$provider->isRegistered()) {
            $provider->setRegistered()->register();
        }
    }

    /**
     * @param ServiceProvider $provider
     */
    protected static function boot(ServiceProvider $provider)
    {
        // We want to boot services only once.
        if (!$provider->isBooted()) {
            $provider->setBooted()->boot();
        }
    }
}
