<?php
namespace SyllableAplication\Classes;

use SplFileObject;

class InputFile implements WriteConsole
    {
        public function inputConsole()
        {
            echo "Enter file name of words\n";
            $filename = trim(fgets(STDIN));
            $filename =__DIR__."\\..\\Data\\" .$filename . ".txt";

            //  echo "*****".$filename."******\n";
            //  echo "*****".__DIR__."******\n";
            if (file_exists($filename)) {
                // $file = new SplFileObject($filename);
                $words = file_get_contents($filename);
                $wordlistDivided = preg_split('/\b/',$words);
                return $wordlistDivided;
            } else {
                echo "File does not exist.";
                die;//  error expection handler
            }
        }
        public function outputConsole($message)
        {
            $file = 'result_' . date('His'). '.txt';
            $fileName = "C:\Users\Gytis.Apinys\Documents\GitHub\PHPsummer_GA\VISMA_practice_TASK\Tasks\SyllableApplication\Results\\".$file;
            if(file_put_contents($fileName,$message)){
                echo "Results were succesfully placed in file: $file\n";
            } else {
                // error handler
            }
        }
    }