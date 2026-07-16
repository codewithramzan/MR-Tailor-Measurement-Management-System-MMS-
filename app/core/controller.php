<?php

class Controller
{
    public function view($view, $variables = [])
    {
        extract($variables);

        require dirname(__DIR__) . "/Views/" . $view . ".php";
    }
}