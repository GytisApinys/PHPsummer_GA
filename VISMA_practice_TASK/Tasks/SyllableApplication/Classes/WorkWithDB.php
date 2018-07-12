<?php
namespace SyllableAplication\Classes;

use SplFileObject;
use Database\Database;

class WorkWithDB
{
    private $patterns;
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
                die;  //  error expection handler
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

        foreach($this->patterns as $pattern) {
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
        $db = new Database();
        $db->beginTransaction();


        if (is_array($wordList)) {
            foreach ($wordList as $word) {
                if (preg_match("/[\w]/",$word) != NULL) {
                    $objWord = new Word($word);
                $word_syllabled = $objWord->modifyWord(/*$this->patterns need to supply from DB*/);
                    $db->insert("words", $values = [
                        "word" => $word,
                        "word_finished" => $word_syllabled
                    ]);

                }
            }
        } else {
            // error handler
        }
    }
    public function checkDoneWords()
    {

    }
}