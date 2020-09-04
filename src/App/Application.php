<?php

namespace App;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    private $router;
    private $config;

    public function __construct($router, $config)
    {
        $this->router = $router;
        $this->config = $config;
        $this->initializ();
    }

    public function run()
    {
        try {

            $page = $this->router->dispatch();

            if ($page instanceof Renderable) {

                return $page->render();
            } else {

                echo $page;
            }

        } catch (\Exception $e) {

            $this->renderException($e);
        }
    }

    private function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {

            $e->render();
        } else {

            $code = http_response_code();
            echo $code . ' ' . $e->getMessage();
        }
    }

    public function initializ ()
    {
        $capsule = new Capsule();

        $capsule->addConnection([
            'driver'    => $this->config->configs['driver'],
            'host'      => $this->config->configs['host'],
            'database'  => $this->config->configs['dbname'],
            'username'  => $this->config->configs['name'],
            'password'  => $this->config->configs['password'],
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
