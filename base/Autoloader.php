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
    	$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $pos = strrpos($class, '\\');
        if (false !== $pos)
        {
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, 0, $pos)) . DIRECTORY_SEPARATOR;
            $className = substr($class, $pos + 1);
        } else {
            $classPath = null;
            $className = $class;
        }

        foreach($this->namespaces as $namespace => $dirPaths)
        {
            if (false !== strstr($class, $namespace)) {
                foreach ($dirPaths as $dirPath) {

                    if (file_exists($dirPath . DIRECTORY_SEPARATOR . $className)) {
                        return $dirPath . DIRECTORY_SEPARATOR . $className;
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