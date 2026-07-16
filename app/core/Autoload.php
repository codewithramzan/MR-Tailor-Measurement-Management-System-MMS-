<?php

spl_autoload_register(function ($class) {

    $folders = [

        "../app/Core/",
        "../app/Controllers/",
        "../app/Models/"

    ];

    foreach ($folders as $folder) {

        $file = $folder . $class . ".php";

        if (file_exists($file)) {

            require_once $file;

            return;
        }
    }
});