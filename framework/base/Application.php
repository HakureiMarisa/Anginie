<?php

namespace Anginie\Base;

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
        $router = $this->load('\Anginie\Base\Router')->parse();
        $controller = $this->load('\App\Controllers\\' . $router[0] . 'Controller');
        call_user_func(array($controller, $router[1]));
    }
}