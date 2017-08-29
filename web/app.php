<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';
if (PHP_VERSION_ID < 70000) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

// Feel free to remove this, extend it, or make something more sophisticated.
$currentEnvironment = getenv('TYPE_ENVIRONNEMENT');
$currentEnvironment = empty($currentEnvironment) || !$currentEnvironment ?
    'prod' :
    strtolower($currentEnvironment);
$isDebugEnvironment = in_array($currentEnvironment,['localdev', 'dev']);

// Go kernel with properties
$kernel = new AppKernel($currentEnvironment, $isDebugEnvironment);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
