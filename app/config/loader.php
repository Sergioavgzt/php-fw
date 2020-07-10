<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Micro\Models'      => $config->application->modelsDir,
    'Micro\Controllers' => $config->application->controllersDir,
    'Micro\Forms'       => $config->application->formsDir,
    'Micro'             => $config->application->libraryDir
]);

$loader->register();
