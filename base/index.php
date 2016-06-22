<?php

namespace Anginie\Base;

class B
{

}

class A 
{
    private $b;
    private $a;
    public function __construct($a = 1, B $b)
    {   
        $this->b = $b;
        $this->a = $a;
    }

    public function dump()
    {
var_dump($this);
    }
}

require 'Autoloader.php';
$loader = new Autoloader();
$loader->register();

$a = new c\c();