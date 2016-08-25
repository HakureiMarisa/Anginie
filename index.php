<?php

require 'framework/base/Autoloader.php';
$loader = new \Anginie\Base\Autoloader();
$loader->addNamespace('\Anginie\\', 'D:/Workspace/Anginie/framework/');
$loader->addNamespace('\App\\', 'D:/Workspace/Anginie/app/');
$loader->register();


$app = new \Anginie\Base\Application();


$app->run();