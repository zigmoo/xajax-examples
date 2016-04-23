<?php

require (__DIR__ . '/../../vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = Xajax::getInstance();

$xajax->setOption('core.request.uri', 'includes/autoload-separated/server.php');

// $xajax->setOption('core.debug.on', true);
$xajax->setOption('core.prefix.class', '');

$xajax->setOption('toastr.options.closeButton', true);
$xajax->setOption('toastr.options.positionClass', 'toast-bottom-left');

// Use the Composer autoloader
$xajax->useComposerAutoLoader();

// Add class dirs with namespaces
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/app', 'App');
$xajax->addClassDir(__DIR__ . '/../../classes/namespace/ext', 'Ext');

return $xajax;
