<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:14 PM
 */

namespace Controller;


use Model\PatternsModel;

class PatternController
{
    private $urlActionString;
    private $patternModel;

    public function __construct(array $urlString)
    {
        $this->patternModel = new PatternsModel();
        $this->urlActionString = $urlString;
        $this->action();
    }

    public function action()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case "GET":
                    $this->get();
                    break;
                case "POST":
                    $this->post();
                    break;
                case "DELETE":
                    $this->delete();
                    break;
                case "UPDATE":
                    $this->update();
                    break;
            }
        }
    }

    private function get()
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->getAllPatterns();

        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->getPatternByID($this->urlActionString[1]);
        }
    }

    private function post()
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->postPattern();

        } elseif (count($this->urlActionString) == 2) {
            echo "Wrong input";
        }
    }

    private function delete()
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->deleteAllPatterns();

        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->deletePatternsByID($this->urlActionString[1]);
        }
    }

    private function update()
    {

        if (count($this->urlActionString) == 1) {
            echo "Wrong input";
        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->updatePatternsByID($this->urlActionString[1]);
        }
    }
}