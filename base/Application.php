<?php
/**
 * Copyright (c) 2015,�Ϻ�������������Ƽ��ɷ����޹�˾
 * ժ    Ҫ��
 * ��    �ߣ�yangj<yangj@2345.com>
 * �޸����ڣ�2016.08.25
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