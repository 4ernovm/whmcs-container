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
    protected static $registered = false;

    /** @var bool */
    protected static $booted = false;

    /**
     * @return boolean
     */
    public function isBooted()
    {
        return self::$booted;
    }

    /**
     * @param $booted
     * @return $this
     */
    public function setBooted($booted)
    {
        self::$booted = $booted;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isRegistered()
    {
        return self::$registered;
    }

    /**
     * @param $registered
     * @return $this
     */
    public function setRegistered($registered)
    {
        self::$registered = $registered;

        return $this;
    }
}