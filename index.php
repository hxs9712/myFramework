<?php
require 'vendor/autoload.php';
require 'router.php';
require 'config/database.php';

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

$request = urldecode($_SERVER['PATH_INFO']);

$route_map = $route[trim($request,'/')];

if (!$route_map){
    die("404");
}

$class = 'App\Controller\\'.explode('@',$route_map)[0];
$func = explode('@',$route_map)[1];

(new $class())->$func();
