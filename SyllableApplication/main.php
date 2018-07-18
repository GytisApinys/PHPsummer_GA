<?php

namespace SyllableApplication;

require_once 'Loader/Psr4Autoloader.php';

use Api\APIRouter;
use Database\Database;
use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableApplication\Classes\File;
use SyllableApplication\Classes\Word;
use Api\SyllableAPI;

define("FILENAME", __DIR__ . "\Data\Patterns.txt");

$autoloader = new Psr4Autoloader();
$autoloader->register();
$autoloader->addNamespace('SyllableApplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');
$autoloader->addNamespace('Database', __DIR__ . '/Database/');
$autoloader->addNamespace('Api', __DIR__ . '/Api/');
$autoloader->addNamespace('Controller', __DIR__ . '/Controller/');
$autoloader->addNamespace('Model', __DIR__ . '/Model/');

FileLogger::info('Program starting.');
if (isset($_SERVER['REQUEST_METHOD'])) {
    $apiPath = $_GET['q']; // get entered
//    $rest = new SyllableAPI($apiPath, $db);
    $router = new APIRouter($apiPath);

} elseif(empty($_SERVER['REQUEST_METHOD'])) {
    $objFile = new File();
    $objFile->execute();
}



