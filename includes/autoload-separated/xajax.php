<?php

use Xajax\Xajax;
use Xajax\Response\Response;

$loader = require (__DIR__ . '/../../vendor/autoload.php');

$xajax = new Xajax('includes/autoload-separated/server.php');

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', '');

$xajax->plugin('toastr')->setOption('closeButton', true);
$xajax->plugin('toastr')->setOption('positionClass', 'toast-bottom-left');

// Use the Composer autoloader
$xajax->setAutoLoader($loader);

// Add class dirs with namespaces
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/app', 'App');
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/ext', 'Ext');

return $xajax;
