<?php

namespace SyllableApplication;

require_once __DIR__ . "./Loader/Psr4Autoloader.php";

use Api\APIRouter;
use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableApplication\Classes\File;

define("FILENAME", __DIR__ . "\Data\Patterns.txt");

$autoloader = new Psr4Autoloader();
$autoloader->register();
//$autoloader->addAllNamespaces();
$autoloader->addNamespace('SyllableApplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');
$autoloader->addNamespace('Database', __DIR__ . '/Database/');
$autoloader->addNamespace('Api', __DIR__ . '/Api/');
$autoloader->addNamespace('Controller', __DIR__ . '/Controller/');
$autoloader->addNamespace('Model', __DIR__ . '/Model/');

FileLogger::info('Program starting.');
if (isset($_SERVER['REQUEST_METHOD'])) {
    $router = new APIRouter($_GET['q']);
    $router->execute($_SERVER['REQUEST_METHOD']);

} elseif (empty($_SERVER['REQUEST_METHOD'])) {
    $objFile = new File();
    $objFile->execute();
}



