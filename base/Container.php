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

    public function register($binding, $implement = null)
    {
        if ($implement instanceof Closure) {
            $this->bindings[$binding] = $implement;
        } else {
            if (is_null($implement)) {
                $implement = $binding;
            }

            $this->bindings[$binding] = function (Container $container, $parameters) use ($implement) {
                return $container->build($implement, $parameters);
            };
        }
    }

    public function load($binding, $parameters = array())
    {
        if (isset($this->instances[$binding])) {
            return $this->instances[$binding];
        }

        if (isset($this->bindings[$binding])) {
            $instance = call_user_func($this->bindings[$binding], $this, $parameters);
        } else {
            $instance = $this->build($binding, $parameters);
        }

        return $this->instances[$binding] = $instance;
    }

    public function build($binding, $parameters)
    {
        if ($binding instanceof Closure) {
            return call_user_func($binding, $binding);
        }

        $reflector = new ReflectionClass($binding);
        if (!$reflector->isInstantiable()) {
            throw new \Exception("不可实例化" . $reflector->getName());
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
                $dependencies[] = $this->load($dependency->name);
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new \Exception("无法解析{$parameter->getDeclaringClass()->getName()}类中的{$parameter->getName()}参数");
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}