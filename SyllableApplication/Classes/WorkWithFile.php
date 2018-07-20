<?php

namespace SyllableApplication\Classes;

use SplFileObject;
use Log\FileLogger;
use SyllableApplication;


class WorkWithFile
{
    private $patterns;

    public function __construct()
    {
        $file = new SplFileObject(FILENAME);
        while (!$file->eof()) {
            $this->patterns[] = $file->fgets();
        }
    }

    public function executeFileMode()
    {
        ConsoleMsgOutput::workFileMsg();
        $input = $this->getInput();
        $finalInput = $this->modifyInput($input);
        $this->resultDisplay($finalInput['result']);
        $executionTime = $finalInput['time'];
        echo "\nProcessing word took " . $executionTime . "sec";
        FileLogger::debug("Algorithm took $executionTime seconds to exe.");
    }

    public function getInput()
    {

        $action = trim(fgets(STDIN));
        switch ($action) {
            case 1:
                $inputFile = new InputFile();
                $input = $inputFile->inputConsole();
                return $input;
                break;
            case 2:
                $inputHand = new InputHand();
                $input = $inputHand->inputConsole();
                return $input;
                break;
            default:
                echo "Wrong input.";
                return null;
        }
    }

    public function modifyInput($wordList)
    {
        $objTimer = new Timer();
        $objTimer->start();
        $finalResult = '';
        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/", $word) != null) {
                    $objWord = new Word($word);
                    $wordSyllable = $objWord->modifyWord($this->patterns);
                    $word = $wordSyllable;
                }
                $finalResult .= $word;
            }
        }
        $objTimer->stop();
        $timeDuration = $objTimer->duration();
        return [
            'time' => $timeDuration,
            'result' => $finalResult,
        ];
    }

    public function resultDisplay($formatedWord)
    {
        echo "\nHow would you want to get result?\n";
        echo "[1] - File\n";
        echo "[2] - Console\n";

        $end = false;
        while ($end == false) {
            $action = trim(fgets(STDIN));
            switch ($action) {
                case 1:
                    $inputFile = new InputFile();
                    $inputFile->outputConsole($formatedWord);
                    $end = true;
                    break;
                case 2:
                    $inputHand = new InputHand();
                    $inputHand->outputConsole($formatedWord);
                    $end = true;
                    break;
                default:
                    echo "Wrong input. Try again.";
            }
        }
    }
}
