<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $path = ROOT.'/components/routes.php';
        $this->routes = include($path);
    }
    /**
     * return request string
     */
    private function get_uri()
    {
        if (!empty($_SERVER['QUERY_STRING'])) {
            return trim($_SERVER['QUERY_STRING'], '/');
        }
    }
    /**
     * Find controller and call appropriate method
     */
    public function start()
    {
        $uri = $this->get_uri();
        
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
    
                $arr = explode('/', $internalRoute);

                $controllerName = array_shift($arr).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($arr));

                $parameters = $arr;
            
                $controllerFile = ROOT . '/App/Controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName($parameters);
                if ($result != null) {
                    break ;
                }           
            }
        }
    }
}