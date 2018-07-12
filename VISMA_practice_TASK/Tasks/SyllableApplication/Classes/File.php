<?php 
namespace SyllableAplication\Classes;

use SplFileObject;

class File
{
        public function execute()
        {

            $this->welcomeMessage();
            $task = $this->sourceOption();
            // $task = $this->getInput();
            // $finalInput = $this->modifyInput($task, $patterns);
            // // return $finalInput;
        }
        public function sourceOption()
        {
             $action = trim(fgets(STDIN));
            switch ($action) {
                case 1:
                    $usingDB = new WorkWithDB;
                    $input = $usingDB->executeDBMode();
                    return $input;
                    break;
                case 2:
                    $usingFile = new WorkWithFile;
                    $input = $usingFile->executeFileMode();
                    return $input;
                    break;    
                default:
                    echo "Wrong input.";    
                    die;  //  error expection handler
             }
            $word = trim(fgets(STDIN));
            return $word;
        }
        public function welcomeMessage()
        {
            echo "\n|---------Word Syllabizer---------|\n";
            echo "|                                 |\n";
            echo "|    Would you like to work       |\n";
            echo "|    with Database or file?       |\n";
            echo "|                                 |\n";
            echo "|   [1] - Database                |\n";
            echo "|   [2] - File                    |\n";
            echo "|---------------------------------|\n";
            echo "Enter choice: ";
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
        public function modifyInput($wordList, $patterns)
        {
            $objTimer = new Timer();
            $objTimer->start();
            $FinalResult = '';
            if (is_array($wordList)) {
                foreach ($wordList as $word) {
                    if (preg_match("/[\w]/",$word) != NULL) {
                        $objWord = new Word($word);
                        $word_syllabled = $objWord->modifyWord($patterns);
                        $word = $word_syllabled;
                    }
                    $FinalResult .= $word;
                }
            } else {
                // error handler
            }
            $objTimer->stop();
            $timeDuration = $objTimer->duration();
             return [
                'time' => $timeDuration,
                'result' => $FinalResult,
            ];
        }
}


