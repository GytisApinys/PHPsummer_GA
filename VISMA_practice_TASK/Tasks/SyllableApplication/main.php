<?php
namespace SyllableAplication;

require_once 'Loader/Psr4Autoloader.php';

use Database\Database;
use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableAplication\Classes\File;
use SyllableAplication\Classes\Word;

define("FILENAME", __DIR__."\Data\Patterns.txt");

$autoloader = new Psr4Autoloader();
$autoloader->register();
$autoloader->addNamespace('SyllableAplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');
$autoloader->addNamespace('Database', __DIR__ . '/Database/');

FileLogger::info('Program starting.');

$objFile = new File();
$objFile->execute();


