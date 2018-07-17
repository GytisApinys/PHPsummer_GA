<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:13 PM
 */

namespace Controller;


use Model\WordModel;

class WordController
{
    private $urlActionString;
    private $wordModel;

    public function __construct(array $urlString)
    {
        $this->wordModel = new WordModel();
        $this->urlActionString = $urlString;
        echo "hello3";
//        $this->action();
    }



    private function get()
    {
        echo "helloooo";
        die;
        if (count($this->urlActionString) == 1) {
            $this->wordModel->getAllWords();

        } elseif (count($this->urlActionString) == 2) {
            $this->wordModel->getWordByID($this->urlActionString[1]);
        }
    }

    private function post()
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->postWord();

        } elseif (count($this->urlActionString) != 1) {
            echo "Wrong input";
        }
    }

    private function delete()
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->deleteAllWords();

        } elseif (count($this->urlActionString) == 2) {
            $this->wordModel->deleteWordByID($this->urlActionString[1]);
        }
    }

    private function update()
    {
        if (count($this->urlActionString) == 2) {
            echo "Wrong input";
        } elseif (count($this->urlActionString) != 2) {
            $this->wordModel->updateWordByID($this->urlActionString[1]);
        }
    }
}