<?php

// Include Router 
define('ROOT', __DIR__);
require_once(ROOT.'/components/Router.php');
require_once(ROOT . '/components/Db.php');

session_start();

$router = new Router();
$router->start();
