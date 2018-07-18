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
        $this->execute();
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

    public function execute()
    {
        $phpInput = json_decode(file_get_contents("php://input"), true);
        if ($phpInput == NULL) $phpInput = [];
        $controllerName = $this->directions();
        $modelName = 'Model\\' . $controllerName . "Model";
        $controllerName = 'Controller\\' . $controllerName . "Controller";
        $methodName = strtolower($_SERVER['REQUEST_METHOD']);
        try {
            $modelObj = new $modelName();
            $controllerExecute = new $controllerName($this->entrylist, $modelObj);
            $controllerExecute->$methodName($phpInput);
        } catch (\Exception  $e) {
            echo "Error" . $e->getMessage();
        }
    }
}