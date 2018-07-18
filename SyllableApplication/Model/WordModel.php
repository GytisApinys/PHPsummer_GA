<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 5:05 PM
 */

namespace Model;


use Database\Database;

class WordModel
{
    private $db;

    /**
     * WordModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllWords()
    {
    }

    public function getWordByID(string $id)
    {
    }

    public function postWord()
    {

    }

    public function deleteAllWords()
    {

    }

    public function deleteWordByID(string $id)
    {

    }

    public function updateWordByID(string $id)
    {

    }
}