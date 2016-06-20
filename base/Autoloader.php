<?php

namespace Anginie\Base;

class Autoloader
{
    private $prefixes = array();

    public function register()
    {
    	spl_autoload_register(array($this, 'loadClass'));
    }

    public function addNamespace($prefix, $namespace, $prepend = false)
    {
        $prefix = trim($prefix, '\\') . '\\';

        if(!isset($this->prefixes[$prefix]))
        {
            $this->prefixes[$prefix] = array();
        }

        if($prepend)
        {
            array_unshift($this->prefixes[$prefix], $namespace);
        }
        else
        {
            array_push($this->prefixes[$prefix], $namespace);
        }
    }

    public function loadClass($class)
    {
    	if($file = $this->loadFile($class)) 
    	{
    		anginie_scope_isolate_include($file);
    	}
    }

    private function loadFile($class)
    {
    	$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        
    }
}

function anginie_scope_isolate_include($file)
{
	include_once $file;
}