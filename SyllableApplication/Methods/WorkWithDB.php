<?php

namespace SyllableApplication\Methods;

use SplFileObject;
use Database\Database;

class WorkWithDB
{
    private $patterns;
    /**
     * @var Database
     */
    private $dataBase;

    public function executeDBMode(): void
    {
        $this->dbInit();
        ConsoleMsgOutput::workBbMsg();
        $this->optionInput();
    }

    public function dbInit()
    {
        $this->dataBase = new Database();
    }

    public function optionInput(): void
    {
        $action = trim(fgets(STDIN));
        switch ($action) {
            case 1:
                $this->resetDB();
                break;
            case 2:
                $this->modifyAndAddWord();
                break;
            case 3:
                $this->checkSyllableUsed();
                break;
            default:
                echo "Wrong input.";
        }
    }

    public function resetDB(): void
    {
        $file = new SplFileObject(FILENAME);
        while (!$file->eof()) {
            $this->patterns[] = trim($file->fgets());
        }
        $this->dataBase->beginTransaction();

        $this->dataBase->delete("patterns");
        $this->dataBase->delete("word_patterns");
        $this->dataBase->delete("words");

        foreach ($this->patterns as $pattern) {
            $pattern = trim($pattern);
            $this->dataBase->insert("patterns", [
                "pattern" => $pattern
            ]);
        }

        $this->dataBase->endTransaction();
    }

    public function modifyAndAddWord(): void
    {
        $patterns = [];
        $patternsID = [];
        $inputHand = new InputHand();
        $wordList = $inputHand->inputConsole();
        $this->dataBase->beginTransaction();
        $patternsDB = $this->dataBase->select("patterns"); //patternsList/Rows
        foreach ($patternsDB as $entry) {
            $patterns[] = $entry["pattern"];
            $patternsID[] = $entry["id"];
        }

        foreach ($wordList as $word) {
            if (preg_match("/[\w]/", $word) != null) {
                $objWord = new Word($word);
                $wordSyllable = $objWord->modifyWord($patterns);
                $usedPatterns = $objWord->findMatch($patterns);
                $usedPatterns = array_keys($usedPatterns);
                $this->dataBase->insert("words", [
                    "word" => $word,
                    "word_finished" => $wordSyllable
                ]);
                $insertedWordID = $this->dataBase->lastInsertId();
                foreach ($usedPatterns as $entry) {
                    $key = array_search($entry, $patterns);
                    $key = $patternsID[$key];
                    $this->dataBase->insert("word_patterns", [
                        "word_id" => $insertedWordID,
                        "syllable_id" => $key
                    ]);
                }
            }
        }
        $this->dataBase->endTransaction();
    }

    public function checkSyllableUsed(): void
    {
        //
    }
}
