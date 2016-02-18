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

    /** @var [] */
    protected static $registered = [];

    /** @var [] */
    protected static $booted = [];

    /**
     * @return boolean
     */
    public function isBooted()
    {
        return in_array(get_called_class(), static::$booted);
    }

    /**
     * @return $this
     */
    public function setBooted()
    {
        static::$booted = get_called_class();

        return $this;
    }

    /**
     * @return boolean
     */
    public function isRegistered()
    {
        return in_array(get_called_class(), static::$registered);
    }

    /**
     * @return $this
     */
    public function setRegistered()
    {
        static::$registered[] = get_called_class();

        return $this;
    }
}