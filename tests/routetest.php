<?php
require_once "../vendor/autoload.php";

$_GET["url"] = "/home/page/1";

$route = new Route();

echo $route->getNextPath()."<br>";
echo $route->getNextPath()."<br>";
var_dump($route->getParam());