<?php 
use src\Config\Route;

require_once "app/start.php";

$route = new Route($_GET);

$route->LoadView();