<?php

require 'Autoloader.php';
$loader = new Autoloader();
$loader->addNamespace('\Anginie\\', 'D:/Workspace/Anginie/');
$loader->register();

require 'Container.php';
$container = new Container();
$c = $container->load('Anginie\base\c');

$c->say();