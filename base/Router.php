<?php
/**
 * Copyright (c) 2015,上海二三四五网络科技股份有限公司
 * 摘    要：
 * 作    者：yangj<yangj@2345.com>
 * 修改日期：2016.08.24
 */

namespace Anginie\Base;

class Router
{
    private $request;

    private $routerParamName = 'r';
    private $defaultController = 'site';
    private $defaultAction = 'index';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function parse()
    {
        $router = $this->request->get($this->routerParamName, '');
        if (empty($router))
        {
            $router = $this->defaultController . '/' . $this->defaultAction;
        }

        $routerParams = explode('/', $router);
        $paramCount = count($routerParams);
        if ($paramCount == 1 || $routerParams[$paramCount - 1])
        {
            $action = $this->defaultAction;
        }
        else
        {
            $action = array_pop($routerParams);
        }

        return array(
            $routerParams,
            $action
        );
    }
}