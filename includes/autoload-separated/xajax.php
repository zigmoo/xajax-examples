<?php

require (__DIR__ . '/../../vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = Xajax::getInstance();

$xajax->configure('requestURI', 'includes/autoload-separated/server.php');

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', '');

$xajax->plugin('toastr')->setOption('closeButton', true);
$xajax->plugin('toastr')->setOption('positionClass', 'toast-bottom-left');

// Use the Composer autoloader
$xajax->useComposerAutoLoader();

// Add class dirs with namespaces
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/app', 'App');
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/ext', 'Ext');

return $xajax;
