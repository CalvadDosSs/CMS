<?php

namespace App;

class Router
{
    public $path = [];
    private $callback = [];
    private $url;
    private $route;

    public function get($path, $callback)
    {
        gettype($callback) === 'string' ?
            $this->path[] = $routePath = '/index_extra.php' . $this->getCorrectPath($path) :
            $this->path[] = $routePath = $this->getCorrectPath($path);
        $this->callback[] = $callback;
        $this->route = new Route($this->path, $this->callback);
        $this->url = $this->route->getPath();
    }

    private function getCorrectPath($path)
    {
        $count = strlen($path);

        if ($path[$count - 1] === '/') {

            $path = substr($path, 0, $count - 1);
        }

        if ($path === '' || $path['0'] !== '/') {

            $path = '/' . $path;
        }

        return $path;
    }

    public function dispatch()
    {
        $success = false;

        for ($i = 0; $i < count($this->route->path); $i++) {

            if (gettype($this->route->callback[$i]) === 'string') {

                $arr = explode('@', $this->route->callback[$i]);
                $callback[] = $arr[0]::getPageName($arr[1]);
            } else {

                $callback[] = $this->route->run($this->route->callback[$i]);
            }

            if ($this->route->match($this->route->method, $this->route->path[$i])) {

                echo $callback[$i];
                $success = true;

            }
        }

        if (!(in_array($this->url, $this->route->path)) && !$success) {

            return new NotFoundException();
        }
    }
}
