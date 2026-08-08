<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'MR Tailor');

define(
    'BASE_URL',
    'http://localhost/mr_tailor/public/'
);

define(
    'APP_PATH',
    dirname(__DIR__)
);

date_default_timezone_set('Asia/Karachi');