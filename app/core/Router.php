<?php
namespace App\Core;

class Router {
    protected $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] ?? [] as $route => $action) {
            $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Remove full match
                $this->callAction($action, $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    protected function callAction($action, $params = []) {
        if (is_callable($action)) {
            call_user_func_array($action, $params);
        } elseif (is_string($action)) {
            $parts = explode('@', $action);
            $controller = 'App\\Controllers\\' . $parts[0];
            $method = $parts[1];

            $instance = new $controller();
            call_user_func_array([$instance, $method], $params);
        }
    }
}