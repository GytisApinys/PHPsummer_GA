<?php

namespace SyllableApplication\Methods;

use Database\QueryBuilder;
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
                // use check if already in DB
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
                        "syllable_id" => $key,
                        "syllable" => $entry
                    ]);
                }
            }
        }
        $this->dataBase->endTransaction();
    }

    public function checkSyllableUsed(): void
    {
        echo "Enter word you want to see syllables from before?\n";
        $word = trim(fgets(STDIN));
        $query = (new QueryBuilder())
            ->select()
            ->where(["word = '$word'"])
            ->from("words");

        $output = $this->dataBase->executeWithResult($query);
        if (empty($output)) {
            echo "Word $word was not found in DB\n";
        } else {
            $wordID = $output[0]['id'];
            $query->cleanQuery();
            $query->select()->from('word_patterns')->where(["word_id = $wordID"]);

            $patternOutputs = $this->dataBase->executeWithResult($query);
            echo "Patterns used for word $word are:\n";
            for ($i = 0; $i < count($patternOutputs); $i++) {
                echo $patternOutputs[$i]['syllable'] . "\n";
            }
        }
    }

    public function checkIfWordAlreadyInDB(string $word): ?string
    {
        $query = (new QueryBuilder())
            ->select()
            ->where(["word = '$word'"])
            ->from("words");

        $output = $this->dataBase->executeWithResult($query);
        if (!empty($output)) {
            return $output[0]['word_finished'];
        } else {
            ;
            return "FALSE";
        }
    }
}
