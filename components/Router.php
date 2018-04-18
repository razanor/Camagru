<?php

class Router {

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    /**
     * Returns request string URI
     */
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $str = substr($_SERVER['REQUEST_URI'], strlen("/index.php/"));
            return trim($str, '/');
        }
    }
    public function run()
    {
        // Get query string
        $uri = $this->getURI();
        
        // Check availability for this query in routes.php
        foreach($this->routes as $uriPattern => $path) {

            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                // Getting internal route from extrernal using regular expression

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                


                // Determining which controller and action handles query
                $parts = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($parts).'Controller');
                $actionName = 'action'. ucfirst(array_shift($parts));
                $parameters = $parts;
                

                
                // Connect file with specific class-controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Creating object and calling method(action)

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
                
            }
        }
    }
}