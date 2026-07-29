<?php

class AppSettings
{
    private static $settings = null;

    public static function get($key, $default = null)
    {
        if (self::$settings === null) {

            $model = new Setting();

            self::$settings = $model->getSettings();

            if (!self::$settings) {
                self::$settings = [];
            }
        }

        return self::$settings[$key] ?? $default;
    }
}