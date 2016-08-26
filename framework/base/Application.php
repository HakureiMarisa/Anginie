<?php

namespace Anginie\Base;

use Anginie\Exception\HttpException;

class Application extends Container
{

    public function __construct()
    {

    }

    public function run()
    {
        $this->processRequest();
    }

    protected function processRequest()
    {
        $router = $this->load('Anginie\Base\Router')->parse();
        $controller = $this->load('App\Controllers\\' . $router[0] . 'Controller');
        if(!method_exists($controller, $router[1]))
        {
            throw new HttpException();
        }
        call_user_func(array($controller, $router[1]));
    }
}