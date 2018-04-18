<?php

// FRONT CONTROLLER
// 1. General settings
// 2. System files connection
    define ('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.php');
// 3. Setting up connection with DB
// 4. Router call
$router = new Router();
$router->run();