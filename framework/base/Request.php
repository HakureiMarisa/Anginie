<?php

namespace Anginie\Base;

class Request
{
    public function __construct()
    {
        echo '1';
    }

    public function get($paramName, $defaultValue = false)
    {
        return isset($_GET[$paramName]) ? $_GET[$paramName] : $defaultValue;
    }

    public function post($paramName, $defaultValue = false)
    {

    }

    public function request($paramName, $defaultValue = false)
    {

    }

    public function cookie($paramName, $defaultValue = false)
    {

    }

    public function server($paramName, $defaultValue = false)
    {

    }
}