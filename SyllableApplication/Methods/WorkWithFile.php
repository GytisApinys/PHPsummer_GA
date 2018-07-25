<?php

namespace SyllableApplication\Methods;

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
            $this->patterns[] = trim($file->fgets());
        }
    }

    public function executeFileMode()
    {
        ConsoleMsgOutput::workFileMsg();
        $input = $this->getInput();
        $objTimer = new Timer();
        $objTimer->start();
        $finalInput = $this->modifyInput($input);
        $objTimer->stop();
        $timeDuration = $objTimer->duration();
        $this->resultDisplay($finalInput);
        echo "\nProcessing word took " . $timeDuration . "sec";
        FileLogger::debug("Algorithm took $timeDuration seconds to exe.");
    }

    public function modifyInput($wordList)
    {

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
        return $finalResult;
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

    public function resultDisplay($formattedWord): void
    {
        ConsoleMsgOutput::outputResultMsg();
        $end = false;
        while ($end == false) {
            $action = trim(fgets(STDIN));
            switch ($action) {
                case 1:
                    $inputFile = new InputFile();
                    $inputFile->outputConsole($formattedWord);
                    $end = true;
                    break;
                case 2:
                    $inputHand = new InputHand();
                    $inputHand->outputConsole($formattedWord);
                    $end = true;
                    break;
                default:
                    echo "Wrong input. Try again.";
            }
        }
    }
}
