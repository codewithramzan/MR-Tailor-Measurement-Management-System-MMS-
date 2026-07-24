<?php

class Config
{
    private static $config;

    public static function get($key)
    {
        if (self::$config === null)
        {
            self::$config = require dirname(__DIR__, 2) . "/config/app.php";
        }

        return self::$config[$key] ?? null;
    }
}