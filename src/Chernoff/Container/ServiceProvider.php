<?php

namespace Chernoff\Container;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider as BaseProvider;

/**
 * Class ServiceProvider
 * @package Chernoff\Container
 */
abstract class ServiceProvider extends BaseProvider
{
    /** @var  Container */
    protected $app;

    /** @var bool */
    protected static $loaded = false;

    /**
     * @return boolean
     */
    public function isLoaded()
    {
        return self::$loaded;
    }

    /**
     * @param $loaded
     * @return $this
     */
    public function setLoaded($loaded)
    {
        self::$loaded = $loaded;

        return $this;
    }
}