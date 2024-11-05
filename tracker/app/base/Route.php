<?php

namespace App\Base;

class Route
{
    protected $uri;
    protected $method;
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get($uri, $callback)
    {
        $this->routes['GET'][$uri] = $callback;
    }

    public function post($uri, $callback)
    {
        $this->routes['POST'][$uri] = $callback;
    }

    public function init()
    {
        $uri = parse_url($this->uri, PHP_URL_PATH);
        $request = new Request(); // Instantiate Request

        if (isset($this->routes[$this->method])) {
            foreach ($this->routes[$this->method] as $route => $callback) {
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
                $pattern = "@^" . $pattern . "$@";

                if (preg_match($pattern, $uri, $matches)) {
//                    print_r(['route params', $uri, $route, $matches[0]]);
                    array_shift($matches); // Remove full match
                    array_unshift($matches, $request); // Add request as the first argument

                    if (is_callable($callback)) {
                        return call_user_func_array($callback, $matches);
                    } elseif (is_array($callback) && count($callback) === 2) {
                        [$class, $method] = $callback;
                        if (class_exists($class) && method_exists($class, $method)) {
                            $controller = new $class();
                            return call_user_func_array([$controller, $method], $matches);
                        }
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
