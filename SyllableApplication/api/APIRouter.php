<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 3:51 PM
 */

namespace Api;

//use Controller\WordController;
use Controller\PatternController;
use Controller;
use Controller\WordController;

class APIRouter //
{
    private $entrylist;

    public function __construct(string $apiURL)
    {
        $this->entrylist = explode('/', $apiURL);

    }

    public function directions()
    {
        switch ($this->entrylist[0]) {
            case "word":
                $controllerName = "Word";
                return $controllerName;
                break;
            case "patterns":
                $controllerName = "Pattern";
                return $controllerName;
                break;
            default:
                echo "Wrong input.";
        }
    }

    public function execute(string $apiMethod)
    {
        $phpInput = json_decode(file_get_contents("php://input"), true);
        if ($phpInput == null) {
            $phpInput = [];
        }
        $controllerName = $this->directions();
        $modelName = 'Model\\' . $controllerName . "Model";
        $controllerName = 'Controller\\' . $controllerName . "Controller";
        $methodName = strtolower($apiMethod);
        try {
            $modelObj = new $modelName();
            $controllerExecute = new $controllerName($this->entrylist, $modelObj);
            if ($apiMethod == 'POST' && $apiMethod == 'PUT') {
                $controllerExecute->$methodName($phpInput);
            } else {
                $controllerExecute->$methodName($phpInput);
            }
        } catch (\Exception  $e) {
            echo "Error" . $e->getMessage();
        }
    }
}