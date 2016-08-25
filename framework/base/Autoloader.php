<?php

namespace Anginie\Base;

class Autoloader
{
    private $namespaces = array();

    public function register()
    {
    	spl_autoload_register(array($this, 'loadClass'));
    }

    public function addNamespace($namespace, $dirPath, $prepend = false)
    {
        $namespace = trim($namespace, '\\') . '\\';

        if(!isset($this->namespaces[$namespace]))
        {
            $this->namespaces[$namespace] = array();
        }

        if($prepend)
        {
            array_unshift($this->namespaces[$namespace], $dirPath);
        }
        else
        {
            array_push($this->namespaces[$namespace], $dirPath);
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
        foreach($this->namespaces as $namespace => $dirPaths)
        {
            if (false !== strpos($class, $namespace)) {
                foreach ($dirPaths as $dirPath) {
                    $path = str_replace('\\', DIRECTORY_SEPARATOR, str_replace($namespace, $dirPath, $class)) . '.php';
                    if (file_exists($path)) {
                        return $path;
                    }
                }
            }
        }
    }
}

function anginie_scope_isolate_include($file)
{
	include_once $file;
}