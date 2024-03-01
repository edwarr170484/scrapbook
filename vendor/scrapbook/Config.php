<?php
namespace Scrapbook\Core;

class Config{
    static private $config;

    static public function load(array $config)
    {
        self::$config = json_decode(json_encode($config));
    }

    static public function get($value)
    {
        return self::$config->$value;
    }
}