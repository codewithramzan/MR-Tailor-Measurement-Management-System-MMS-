<?php

class Router
{

    private $routes = [];

    public function get($url, $callback)
    {
        $this->routes['GET'][$url] = $callback;
    }

    public function post($url, $callback)
    {
        $this->routes['POST'][$url] = $callback;
    }

    public function dispatch($url, $method)
    {

        if (isset($this->routes[$method][$url])) {

            call_user_func($this->routes[$method][$url]);

        } else {

            echo "404 Page Not Found";

        }

    }

}