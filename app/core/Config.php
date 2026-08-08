<?php

class Config
{
    private static $config = null;

    public static function get($key)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Configuration Once
        |--------------------------------------------------------------------------
        */

        if (self::$config === null) {

            /*
            |--------------------------------------------------------------------------
            | Load Default Configuration
            |--------------------------------------------------------------------------
            */

            self::$config = require dirname(__DIR__, 2)
                . "/config/app.php";

            /*
            |--------------------------------------------------------------------------
            | Load Database Settings
            |--------------------------------------------------------------------------
            */

            try {

                $db = new Database();

                $conn = $db->getConnection();

                $stmt = $conn->query("
                    SELECT *
                    FROM settings
                    LIMIT 1
                ");

                $settings = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($settings) {

                    foreach ($settings as $settingKey => $value) {

                        if ($value !== null && $value !== '') {

                            self::$config[$settingKey] = $value;

                        }

                    }

                }

            } catch (Exception $e) {

                /*
                |--------------------------------------------------------------------------
                | Database unavailable
                |--------------------------------------------------------------------------
                | Keep default app.php values.
                |--------------------------------------------------------------------------
                */

            }
        }

        return self::$config[$key] ?? null;
    }
}