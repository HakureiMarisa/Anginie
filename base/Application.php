<?php
/**
 * Copyright (c) 2015,上海二三四五网络科技股份有限公司
 * 摘    要：
 * 作    者：yangj<yangj@2345.com>
 * 修改日期：2016.08.25
 */

namespace Anginie\Base;

class Application extends Container
{

    public function __construct()
    {

    }

    public function run()
    {
        $this->processRequest();
    }

    protected function processRequest()
    {
        $router = $this->load('Router');
        if(file_exists())
    }
}