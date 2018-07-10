<?php 
namespace SyllableAplication\Classes;

use SplFileObject;

class File
{
        public function startingMessage()
        {
            $this->welcomeMessage();
            $task = $this->getInput();
            // var_dump($task);
            // die;
            return $task;
        }
        public function welcomeMessage()
        {
            echo "\n|---------Word syllabizer---------|\n";
            echo "|                                 |\n";
            echo "| Input word by: file or by hand? |\n";
            echo "|                                 |\n";
            echo "|[1] - File                       |\n";
            echo "|[2] - Input                      |\n";
            echo "|---------------------------------|\n";
            echo "Enter choise: ";
        }
        public static function readData($filename)
        {
            $file = new SplFileObject($filename);
            while (!$file->eof()) {
            $patterns[] = $file->fgets();
            }
            return $patterns;
        }
        public function resultDisplay($formated_word)
        {
            echo "\nHow would you want to get result?\n";
            echo "[1] - File\n";
            echo "[2] - Console\n";
            $action = trim(fgets(STDIN));
            $End = FALSE;
            while ($End == false) {
                switch ($action) {
                case 1:
                    $InputFile = new InputFile;
                    $input = $InputFile->outputConsole($formated_word);
                    $End = true;
                    break;
                case 2:
                    $InputHand = new InputHand;
                    $input = $InputHand->outputConsole($formated_word);
                    $End = true;
                    break;
                default:
                    echo "Wrong input. Try again.";
                }
            }
        }
        public function getInput()
        {

            $action = trim(fgets(STDIN));
            switch ($action) {
                case 1:
                    $InputFile = new InputFile;
                    $input = $InputFile->inputConsole();
                    return $input;
                    break;
                case 2:
                    $InputHand = new InputHand;
                    $input = $InputHand->inputConsole();
                    return $input;
                    break;    
                default:
                    echo "Wrong input.";    
                    die;  //  error expection handler
             }
            $word = trim(fgets(STDIN));
            return $word;
        }
}


