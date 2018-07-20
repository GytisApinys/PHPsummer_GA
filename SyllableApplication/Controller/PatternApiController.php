<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 4:14 PM
 */

namespace Controller;


use Model\PatternModel;

class PatternApiController implements ApiControllerInterface
{
    private $urlActionString;
    private $patternModel;

    public function __construct(array $urlString, PatternModel $patternModel)
    {
        $this->urlActionString = $urlString;
        $this->patternModel = $patternModel;
    }

    public function get(): void
    {
        if (count($this->urlActionString) == 1) {
            $output = $this->patternModel->getAllPatterns();
            echo json_encode($output);

        } elseif (count($this->urlActionString) == 2) {
            $output = $this->patternModel->getPatternByID($this->urlActionString[1]);
            echo json_encode($output);
        }
    }

    public function post(array $phpInput): void
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->postPattern($phpInput);
            echo "Pattern has been added.\n";

        } elseif (count($this->urlActionString) == 2) {
            echo "Wrong input.\n";
        }
    }

    public function delete(): void
    {
        if (count($this->urlActionString) == 1) {
            $this->patternModel->deleteAllPatterns();
            echo "All patterns have been deleted.\n";

        } elseif (count($this->urlActionString) == 2) {
            $this->patternModel->deletePatternsByID($this->urlActionString[1]);
            echo "Pattern has been deleted.\n";
        }
    }

    public function put(array $phpInput): void
    {
        if (count($this->urlActionString) == 2) {
            $this->patternModel->updatePatternsByID($this->urlActionString[1], $phpInput);
            echo "Entry has been updated.\n";
        } elseif (count($this->urlActionString) != 2) {
            echo "Wrong input.\n";
        }
    }
}