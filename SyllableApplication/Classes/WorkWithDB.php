<?php

namespace SyllableApplication\Classes;

use SplFileObject;
use Database\Database;
use PDO;

class WorkWithDB
{
    private $patterns;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function message()
    {
        echo "\n";
        echo "|------------------------|\n";
        echo "|     Work with DB       |\n";
        echo "|     What to do?        |\n";
        echo "|   [1] Update DB        |\n";
        echo "|   [2] Write in         |\n";
        echo "|       Console          |\n";
        echo "|   [3] Check done words |\n";
        echo "|________________________|\n";
        echo "Enter choice:............\n";
    }

    public function executeDBMode()
    {
        $this->message();
        $optionInput = $this->getOptionInput();

    }

    public function getOptionInput()
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
                die;  //  error exception handler
        }
    }

    public function updateDB()
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
            $pattern = trim(pattern);
            $db->insert("patterns", $values = [
                "pattern" => $pattern
            ]);
        }

        $db->endTransaction();
    }

    public function addWord()
    {
        $InputHand = new InputHand;
        $wordList = $InputHand->inputConsole();
        $this->db->beginTransaction();
        $patternsDB = $this->db->select("patterns");
//        $patternsDB = $patternsObjFromDB->fetchAll(PDO::FETCH_ASSOC);
        foreach ($patternsDB as $entry) {
            $patterns[] = $entry["pattern"];
            $patternsID[] = $entry["id"];
        }
//        $key = array_search(".ant4", $patterns);
//        $key = $patternsID[$key];
//        var_dump($key);
        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/", $word) != NULL) {
                    $objWord = new Word($word);
                    $wordSyllabled = $objWord->modifyWord($patterns);
                    $usedPatterns = $objWord->findMatch($patterns);
                    // add insert into connections

                    $this->db->insert("words", $values = [
                        "word" => $word,
                        "word_finished" => $wordSyllabled
                    ]);
                    $insertedWordID = $this->db->lastInsertId();
                    var_dump($usedPatterns); // fix this later
                    foreach ($usedPatterns as $entry) {
                        $key = array_search($entry, $patterns);
                        $key = $patternsID[$key];
                        $this->db->insert("word_patterns", $values = [
                            "word_id" => $insertedWordID,
                            "syllable_id" => $key
                        ]);
                    }
                }
            }
        } else {
            // error handler
        }
        $this->db->endTransaction();
    }

    public function checkDoneWords()
    {

    }
}