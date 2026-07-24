<?php

class OldInput
{
    public static function set($data)
    {
        $_SESSION['old'] = $data;
    }

    public static function get($key, $default = '')
    {
        return $_SESSION['old'][$key] ?? $default;
    }

    public static function clear()
    {
        unset($_SESSION['old']);
    }
}