<?php

namespace Core;
class Router
{
    private $routes = [];

    public function get($uri, $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }
    public function post($uri, $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }
    public function delete($uri, $action): void
    {
        $this->routes['DELETE'][$uri] = $action;
    }
    public function put($uri, $action): void
    {
        $this->routes['PUT'][$uri] = $action;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                if (is_callable($action)) {
                    call_user_func_array($action, $matches);
                } elseif (is_array($action)) {
                    [$controller, $method] = $action;
                    call_user_func_array([new $controller, $method], $matches);
                }
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}