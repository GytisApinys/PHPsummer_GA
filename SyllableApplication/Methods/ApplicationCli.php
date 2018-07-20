<?php

namespace SyllableApplication\Methods;

use SplFileObject;

class ApplicationCli // CLIapplication
{
    public function execute(): void
    {
        ConsoleMsgOutput::workTypeMsg();
        $this->sourceOption();
    }

    public function sourceOption(): void
    {
        $action = trim(fgets(STDIN));  // move to method
        switch ($action) {
            case 1:
                $usingDB = new WorkWithDB();
                $usingDB->executeDBMode();
                break;
            case 2:
                $usingFile = new WorkWithFile();
                $usingFile->executeFileMode();
                break;
            default:
                echo "Wrong input.";// change die
                die();
        }
    }

    public static function readData($filename): array
    {
        $patterns = [];
        $file = new SplFileObject($filename);
        while (!$file->eof()) {
            $patterns[] = $file->fgets();
        }
        return $patterns;
    }

    public function resultDisplay($formattedWord): void
    {
        echo "\nHow would you want to get result?\n";
        echo "[1] - File\n";
        echo "[2] - Console\n";
        $action = trim(fgets(STDIN));
        $end = false;
        while ($end === false) {
            switch ($action) {
                case 1:  // conf iskelt
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
                    break;
            }
        }
    }

    public function getInput(): array
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

    public function modifyInput($wordList, $patterns): array
    {
        $objTimer = new Timer();
        $objTimer->start();
        $finalResult = '';
        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/", $word) != null) {
                    $objWord = new Word($word);
                    $wordSyllable = $objWord->modifyWord($patterns);
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
}