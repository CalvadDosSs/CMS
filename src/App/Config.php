<?php

namespace App;

final class Config
{
    private static $instance;
    public $configs = [];

    public function __construct($configs) {

        $this->configs = $configs;
    }

    public static function getInstance () : Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function get($config, $default = null)
    {
        return array_get($config, '') ?? $default;
    }
}
