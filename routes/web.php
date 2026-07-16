<?php
$router = new Router();
$router->get('/', function () {

    $controller = new AuthController();

    $controller->login();

});