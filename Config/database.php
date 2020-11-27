<?php
use Illuminate\Database\Capsule\Manager as DB;

$handle = fopen(dirname(__FILE__,2)."/.env",'r');

$env_arr=[];
while (!feof($handle)){
    $content = explode("=",fgets($handle));
    $env_arr[$content[0]] = trim($content[1]);
}
fclose($handle);

$capsule = new DB;

$capsule->addConnection([
    'driver'    => $env_arr['DB_CONNECTION'],
    'host'      => $env_arr['DB_HOST'],
    'database'  => $env_arr['DB_DATABASE'],
    'username'  => $env_arr['DB_USERNAME'],
    'password'  => $env_arr['DB_PASSWORD'],
    'charset'   => $env_arr['DB_CHARSET'],
    'collation' => $env_arr['DB_COLLATION'],
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
