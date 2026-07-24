<?php

class Flash
{
    public static function set($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function display()
    {
        if(isset($_SESSION['flash']))
        {
            $flash = $_SESSION['flash'];

            echo '
            <div class="alert alert-'.$flash['type'].' alert-dismissible fade show shadow-sm" role="alert">

                '.$flash['message'].'

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>';

            unset($_SESSION['flash']);
        }
    }
}