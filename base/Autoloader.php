<?php

namespace Anginie\Base;

class Autoloader
{
    public function register()
    {
    	spl_autoload_register(array($this, 'load'));
    }

    public function load($class)
    {
    	if($file = $this->loadFile($class)) 
    	{
    		anginie_scope_isolate_include($file);
    	}
    }

    private function loadFile($class)
    {
    	
    }
}

function anginie_scope_isolate_include($file)
{
	include_once $file;
}