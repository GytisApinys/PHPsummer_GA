<?php 
namespace task\two;

use SplFileObject;

class File
{
    public $welcome_msg = "\nEnter word you wanna split by syllables:";

        public function startingMessage()
            {
                echo $this->welcome_msg;
                $task = $this->getInput();
                return $task;
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
           // echo "Your changed word is:\n\n";
            echo "$formated_word\n";
        }
        public function getInput()
        {
            echo "Input word by: file or by hand?\n";
            echo "1 - file\n";
            echo "2 - input\n";
            $action = trim(fgets(STDIN));
            switch($action)
            {
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


