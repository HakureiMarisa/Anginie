<?php

namespace Anginie\Base;

use Closure;
use ArrayAccess;
use ReflectionClass;
use ReflectionMethod;
use ReflectionFunction;
use ReflectionParameter;

class Container #implements ArrayAccess
{
    protected static $instance;

    protected $resolved = array();

    protected $bindings = array();

    protected $instances = array();

    public function register($binding, $implement)
    {
        
    }

    public function load($binding, $parameters = array())
    {
        if (isset($this->instances[$binding])) {
           return $this->instances[$binding];
        }

        $instance = $this->build($binding, $parameters);

        return $this->instances[$binding] = $instance;
    }

    private function bulid($binding, $parameters)
    {
        if ($binding instanceof Closure) {
            return call_user_func($binding, $binding);
        }

        $reflector = new ReflectionClass($binding);
        if (!$reflector->isInstantiable()) {
            throw new Exception("不可实例化" . $reflector->getName());
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $binding;
        }

        $dependencies = array();

        $reflectionParameters = $constructor->getParameters();


        foreach ($reflectionParameters as $i => $parameter) {
            if (isset($parameters[$parameter->getName()])) {
                $dependencies[] = $parameters[$parameter->getName()];
                continue;
            }

            $dependency = $parameter->getClass();
            if (!is_null($dependency)) {
                $dependencies[] = $this->bind($dependency->name);
            }else if ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            }else{
                throw new \Exception("无法解析{$parameter->getDeclaringClass()->getName()}类中的{$parameter->getName()}参数");
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}