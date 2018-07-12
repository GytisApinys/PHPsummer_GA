<?php
namespace SyllableAplication;

require_once 'Loader/Psr4Autoloader.php';

// include 'Log/FileLogger';
// include 'Log/LoggerInterface';
// include 'Log/LogLevel';

use Database\Database;
use Log\FileLogger;
use AutoLoader\Psr4Autoloader;
use SyllableAplication\Classes\File;
use SyllableAplication\Classes\Word;


const FILENAME = "C:\Users\Gytis.Apinys\Documents\GitHub\PHPsummer_GA\VISMA_practice_TASK\Tasks\SyllableApplication\Data\Patterns.txt";

$autoloader = new Psr4Autoloader();
$autoloader->register();
$autoloader->addNamespace('SyllableAplication\Classes', __DIR__ . '/Classes/');
$autoloader->addNamespace('Log', __DIR__ . '/Log/');
$autoloader->addNamespace('Database', __DIR__ . '/Database/');

// echo "Time". date('Y M d');
FileLogger::info('Program starting.');

// $patterns = File::readData(FILENAME);

// $db = new Database();
// $db->beginTransaction();
// // foreach($patterns as $pattern) {
// //          $pattern = trim($pattern);
// //          $db->insert("patterns", $values = [
// //         "pattern" => $pattern
// //     ]);
   
// // }
// $aa = $db->select("patterns",true);
// var_dump($aa[20]);
// $db->endTransaction();

// $db->insert("try",$one = array( "www"), $two = array( "test"));
// public function add($tableName, $atributeName, $values)

// echo "hi";
// die(); 
//////////////


$objFile = new File();
$FinalResult = $objFile->execute();
// $objFile->resultDisplay($FinalResult['result']);
// echo "\nProcessing word took ". $FinalResult['time'] . "sec";


