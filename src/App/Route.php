<?php

namespace App;

class Route
{
    public $method;
    public $path = [];
    public $callback = [];

    public function __construct ($path, $callback)
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $path;
        $this->callback = $callback;
    }

    private function prepareCallback($callback)
    {
        return $callback();
    }

    public function getPath()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function match($method, $uri)
    {
        if ($method == 'POST' || $method == 'GET') {

            return preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $uri) . '$/', $this->getPath());
        }
    }

    public function run($uri)
    {
        if (preg_match('/test/', $this->getPath()) && preg_match('/test2/', $this->getPath())) {

            $urlItem = explode('/', $this->getPath());
            return call_user_func_array($uri, array($urlItem[2], $urlItem[4]));
        }

        return $this->prepareCallback($uri);
    }
}
