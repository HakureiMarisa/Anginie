<?php

require './base/Autoloader.php';
$loader = new \Anginie\Base\Autoloader();
$loader->addNamespace('\Anginie\\', 'D:/Workspace/Anginie/');
$loader->register();


$container = new \Anginie\Base\Container();

$c = $container->register('\Anginie\Base\Request', null, true);
$c = $container->load('\Anginie\Base\Request');
$c = $container->load('\Anginie\Base\Request');
$c->get('ss');