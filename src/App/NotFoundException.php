<?php

namespace App;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        throw new \Exception('Страница не найдена', 404);
    }
}
