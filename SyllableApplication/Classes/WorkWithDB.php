<?php

namespace SyllableApplication\Classes;

use SplFileObject;
use Database\Database;

class WorkWithDB
{
    private $patterns;
    private $dataBase;

    public function __construct()
    {
        $this->dataBase = new Database();
    }

    public function executeDBMode(): void
    {
        ConsoleMsgOutput::workBbMsg();
        $this->optionInput();
    }

    public function optionInput(): void
    {
        $action = trim(fgets(STDIN));
        switch ($action) {
            case 1:
                $this->updateDB();
                break;
            case 2:
                $this->addWord();
                break;
            case 3:
                $this->checkDoneWords();
                break;
            default:
                echo "Wrong input.";
        }
    }

    public function updateDB(): void
    {
        $file = new SplFileObject(FILENAME);
        while (!$file->eof()) {
            $this->patterns[] = $file->fgets();
        }
        $db = new Database();
        $db->beginTransaction();

        $db->delete("patterns");
        $db->delete("word_patterns");
        $db->delete("words");

        foreach ($this->patterns as $pattern) {
            $pattern = trim($pattern);
            $db->insert("patterns", [
                "pattern" => $pattern
            ]);
        }

        $db->endTransaction();
    }

    public function addWord(): void
    {
        $patterns = [];
        $patternsID = [];
//        $wordsFromDB = [];
//        $wordsFinishedFromDB = [];
        $inputHand = new InputHand();
        $wordList = $inputHand->inputConsole();
        $this->dataBase->beginTransaction();
        $patternsDB = $this->dataBase->select("patterns");
        foreach ($patternsDB as $entry) {
            $patterns[] = $entry["pattern"];
            $patternsID[] = $entry["id"];
        }
//
//
//        $wordsDB = $this->dataBase->select("words");
//        foreach ($wordsDB as $entry) {
//            $wordsFromDB[] = [
//                $entry["word"] => $entry["word_finished"]
//            ];
//            $wordsFromDB[] = ;
//            $wordsFinishedFromDB[] = ;
//        }
//
//

        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/", $word) != null) {
//                    if()
                    $objWord = new Word($word);
                    $wordSyllable = $objWord->modifyWord($patterns);
                    $usedPatterns = $objWord->findMatch($patterns);

                    $this->dataBase->insert("words", $values = [
                        "word" => $word,
                        "word_finished" => $wordSyllable
                    ]);
                    $insertedWordID = $this->dataBase->lastInsertId();
                    var_dump($usedPatterns); // fix this later
                    foreach ($usedPatterns as $entry) {
                        $key = array_search($entry, $patterns);
                        $key = $patternsID[$key];
                        $this->dataBase->insert("word_patterns", $values = [
                            "word_id" => $insertedWordID,
                            "syllable_id" => $key
                        ]);
                    }
                }
            }
        }
        $this->dataBase->endTransaction();
    }

    public function checkDoneWords(): void
    {
        //
    }
}
