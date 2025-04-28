<?php

class Router
{
    protected $routes = [];
    protected $uri;
    protected $method;
    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');
        $this->method = ($_POST['_method']) ?? $_SERVER['REQUEST_METHOD'];
        //dump([$this->uri, $this->method]);
    }

    protected function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }
    public function put($uri, $controller) 
    {
        $this->add($uri, $controller, 'PUT');
    }
    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }
    

    public function match () {
        $isMatched = false;
        foreach ($this->routes as $route) {
            if(($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) {
                $isMatched = true;
                require_once(CONTROLLERS."/{$route['controller']}");
                break;
            }
        }
        if ($isMatched == false)
        {
            abort();
        }
    }
}