<?php
namespace SyllableAplication;

require_once 'Loader/Psr4Autoloader.php';

// include 'Log/FileLogger';
// include 'Log/LoggerInterface';
// include 'Log/LogLevel';

use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableAplication\Classes\File;
use SyllableAplication\Classes\Word;


const FILENAME = "https://gist.githubusercontent.com/cosmologicon/1e7291714094d71a0e25678316141586/raw/006f7e9093dc7ad72b12ff9f1da649822e56d39d/tex-hyphenation-patterns.txt";


$autoloader = new Psr4Autoloader();
$autoloader->register();
$autoloader->addNamespace('SyllableAplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');

// echo "Time". date('Y M d');
FileLogger::info('Program starting.');

$patterns = File::readData(FILENAME);
$objFile = new File();
$givenWord = $objFile->startingMessage();

if (is_array($givenWord)) {
    foreach ($givenWord as $word) {
        $objWord = new Word($word);
        $word_syllabled = $objWord->modifyWord($patterns);
        $objFile->resultDisplay($word_syllabled);
    }
} else {
    $objWord = new Word($givenWord);
    $word_syllabled = $objWord->modifyWord($patterns);
    $objFile->resultDisplay($word_syllabled);
}
