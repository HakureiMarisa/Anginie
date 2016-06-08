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

require 'Container.php';
$container = new Container();
$a = $container->bind('\Anginie\Base\A', array('a' => 2));

$a->dump();

var_dump($a);