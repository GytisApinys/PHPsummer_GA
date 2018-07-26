<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 5:05 PM
 */

namespace Model;


use Database\Database;
use Database\QueryBuilder;
use SyllableApplication\Methods\Word;

class WordModel
{
    private $db;
    private $tableName = "words";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllWords(): array
    {
        $query = (new QueryBuilder())
            ->select()
            ->from($this->tableName);
        $output = $this->db->executeWithResult($query);
        return $output;
    }

    public function getWordByID(string $id): array
    {
        $query = (new QueryBuilder())
            ->select()
            ->from($this->tableName)
            ->where(["id = $id"]);
        $output = $this->db->executeWithResult($query);
        return $output;
    }

    public function postWord(array $phpInput)
    {

        for ($i = 0; $i < count($phpInput); $i++) {
            $word = $phpInput[$i]['word'];
            $wordObj = new Word($word);
            $phpInput[$i]['word_finished'] = $wordObj->modifyWord($wordObj->getPatterns());
        }

        $query = (new QueryBuilder())
            ->insert($this->tableName)
            ->value($phpInput);
        $this->db->executeWithoutResult($query);
    }

    public function deleteAllWords()
    {
        $query = (new QueryBuilder())
            ->delete($this->tableName);
        $this->db->executeWithoutResult($query);
    }

    public function deleteWordByID(string $id)
    {
        $query = (new QueryBuilder())
            ->delete($this->tableName)
            ->where(["id = $id"]);
        $this->db->executeWithoutResult($query);
    }

    public function updateWordByID(string $id, array $phpInput)
    {
        $query = (new QueryBuilder())
            ->update($this->tableName)
            ->set($phpInput)
            ->where(["id = $id"]);
        echo $query;
        $this->db->executeWithoutResult($query);
    }
}