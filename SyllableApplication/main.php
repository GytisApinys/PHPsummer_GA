<?php

namespace SyllableAplication;

require_once 'Loader/Psr4Autoloader.php';

use Api\APIrouter;
use Database\Database;
use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableAplication\Classes\File;
//use SyllableAplication\Classes\Word;
use Api\SyllableAPI;

define("FILENAME", __DIR__ . "\Data\Patterns.txt");

$autoloader = new Psr4Autoloader();
$autoloader->register();
$autoloader->addNamespace('SyllableAplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');
$autoloader->addNamespace('Database', __DIR__ . '/Database/');
$autoloader->addNamespace('Api', __DIR__ . '/Api/');
$autoloader->addNamespace('Controllers', __DIR__ . '/Controllers/');
$autoloader->addNamespace('Model', __DIR__ . '/Model/');

FileLogger::info('Program starting.');
$apiPath = $_GET['q']; // get entered
if (isset($_SERVER['REQUEST_METHOD'])) {
    $db = new Database();
//    $rest = new SyllableAPI($apiPath, $db);
    $router = new APIrouter($apiPath);

} else {
    $objFile = new File();
    $objFile->execute();
}



