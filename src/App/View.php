<?php

namespace App;

class View implements Renderable
{
    public $path;
    public $title;

    public function __construct($path, $title)
    {
        $this->path = $path;
        $this->title = $title;
    }

    public function render()
    {
        $base_dir = __DIR__ . '/view/';
        $file = $base_dir . str_replace('.', '/', '$this->path') . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
}