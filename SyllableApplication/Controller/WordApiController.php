<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:13 PM
 */

namespace Controller;


use Model\WordModel;

class WordApiController implements ApiControllerInterface
{
    private $urlActionString;
    private $wordModel;

    public function __construct(array $urlString, WordModel $wordModel)
    {
        $this->urlActionString = $urlString;
        $this->wordModel = $wordModel;
    }

    public function get(): void
    {
        if (count($this->urlActionString) == 1) {
            $output = $this->wordModel->getAllWords();
            echo json_encode($output);

        } elseif (count($this->urlActionString) == 2) {
            $output = $this->wordModel->getWordByID($this->urlActionString[1]);
            echo json_encode($output);
        }
    }

    public function post(array $phpInput): void
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->postWord($phpInput);
            echo "Word has been added.\n";

        } elseif (count($this->urlActionString) != 1) {
            echo "Wrong input.\n";
        }
    }

    public function delete(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->wordModel->deleteAllWords();
            echo "All words have been deleted.\n";

        } elseif (count($this->urlActionString) == 2) {
            $this->wordModel->deleteWordByID($this->urlActionString[1]);
            echo "Word has been deleted.\n";
        }
    }

    public function put(array $phpInput): void
    {
        if (count($this->urlActionString) == 2) {
            $this->wordModel->updateWordByID($this->urlActionString[1], $phpInput);
            echo "Entry has been updated.\n";
        } elseif (count($this->urlActionString) != 2) {
            echo "Wrong input\n";
        }
    }
 // count metodas and get specific
}