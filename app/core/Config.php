<?php

class Config
{
    private static $config = null;

    public static function get($key)
    {
        if (self::$config === null) {

            // Load default configuration
            self::$config = require dirname(__DIR__, 2) . "/config/app.php";

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

                // Ignore database errors and continue using app.php defaults

            }

        }

        return self::$config[$key] ?? null;
    }
}  