<?php

class Controller
{
    protected function view($view, $variables = [])
    {
        extract($variables);

        require "../app/Views/".$view.".php";
    }

    protected function redirect($page)
    {
        header("Location: index.php?page=".$page);
        exit;
    }

    protected function redirectWithMessage($page, $type, $message)
    {
        Flash::set($type, $message);

        header("Location: index.php?page=".$page);

        exit;
    }
}