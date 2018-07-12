<?php
namespace SyllableAplication\Classes;

use SplFileObject;
use Log\FileLogger;

class WorkWithFile
{
    private $patterns;
    public function __construct()
    {
        
        $file = new SplFileObject("C:\Users\Gytis.Apinys\Documents\GitHub\PHPsummer_GA\VISMA_practice_TASK\Tasks\SyllableApplication\Data\Patterns.txt");
        while (!$file->eof()) {
        $this->patterns[] = $file->fgets();
        }
        // var_dump($this->patterns);
        // die;
    }
    public function executeFileMode()
    {
        $this->message();
        $input = $this->getInput();
        // var_dump($this->patterns);
        // die;
        $finalInput = $this->modifyInput($input);
        $this->resultDisplay($finalInput['result']); 
        $executionTime = $finalInput['time'];
        echo "\nProcessing word took ". $executionTime . "sec";
        FileLogger::info("Program took $executionTime seconds.");



    }
    public function message()
    {
        echo "\n";
        echo "|------------------------|\n";
        echo "|-----Work with File-----|\n";
        echo "|------------------------|\n";
        echo "|-----Get words from :---|\n";
        echo "|-----[1] File-----------|\n";
        echo "|-----[1] Console--------|\n";
        echo "|________________________|\n";
        echo "Enter choice:............\n";

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
    public function modifyInput($wordList)
    {
        $objTimer = new Timer();
        $objTimer->start();
        $FinalResult = '';
        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/",$word) != NULL) {
                    $objWord = new Word($word);
                    $word_syllabled = $objWord->modifyWord($this->patterns);
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
    public function resultDisplay($formated_word)
    {
        echo "\nHow would you want to get result?\n";
        echo "[1] - File\n";
        echo "[2] - Console\n";
        
        $End = FALSE;
        while ($End == false) {
            $action = trim(fgets(STDIN));
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
}