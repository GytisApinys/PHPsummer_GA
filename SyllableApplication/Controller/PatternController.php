<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:14 PM
 */

namespace Controller;


use Model\PatternsModel;

class PatternController implements ControllerInterface
{
    private $urlActionString;
    private $patternModel;

    public function __construct(array $urlString)
    {
        $this->patternModel = new PatternsModel();
        $this->urlActionString = $urlString;
        $this->urlActionString = $urlString;
        $this->urlActionString = $urlString;
        $this->urlActionString = $urlString;
        $this->urlActionString = $urlString;
    }

    public function get(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->getAllPatterns();

        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->getPatternByID($this->urlActionString[1]);
        }
    }

    public function post(array $phpInput): void
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->postPattern();

        } elseif (count($this->urlActionString) == 2) {
            echo "Wrong input";
        }
    }

    public function delete(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->deleteAllPatterns();

        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->deletePatternsByID($this->urlActionString[1]);
        }
    }

    public function put(array $phpInput): void
    {
        if (count($this->urlActionString) == 1) {
            echo "Wrong input";
        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->updatePatternsByID($this->urlActionString[1]);
        }
    }
}