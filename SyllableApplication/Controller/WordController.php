<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:13 PM
 */

namespace Controller;


use Model\WordModel;

class WordController implements ControllerInterface
{
    private $urlActionString;
    private $wordModel;

    public function __construct(array $urlString)
    {
        $this->wordModel = new WordModel();
        $this->urlActionString = $urlString;
    }

    public function get(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->getAllWords();
        } elseif (count($this->urlActionString) == 2) {
            $this->wordModel->getWordByID($this->urlActionString[1]);
        }
    }

    public function post(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->postWord();

        } elseif (count($this->urlActionString) != 1) {
            echo "Wrong input";
        }
    }

    public function delete(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->deleteAllWords();

        } elseif (count($this->urlActionString) == 2) {
            $this->wordModel->deleteWordByID($this->urlActionString[1]);
        }
    }

    public function update(): void
    {
        if (count($this->urlActionString) == 2) {
            echo "Wrong input";
        } elseif (count($this->urlActionString) != 2) {
            $this->wordModel->updateWordByID($this->urlActionString[1]);
        }
    }

}