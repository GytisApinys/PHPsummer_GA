<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 3:51 PM
 */

namespace Api;


class APIRouter //
{
    private $entryList;
    private $forbiddenMethods = ['OPTIONS'];

    public function __construct(string $apiURL)
    {
        if (substr($apiURL, -1) == '/') {
            $apiURL = substr($apiURL, 0, -1);
        }
        $this->entryList = explode('/', $apiURL);
    }

    public function directions()
    {
        switch ($this->entryList[0]) {
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
        return null;
    }

    public function execute(string $apiMethod)
    {
        if ($this->isForbiddenMethod($apiMethod)) {
            return;
        }
        $phpInput = json_decode(file_get_contents("php://input"), true);
        $controllerName = $this->directions();
        $modelName = 'Model\\' . $controllerName . "Model";
        $controllerName = 'Controller\\' . $controllerName . "ApiController";// %%change to fully qual
        $methodName = strtolower($apiMethod);
        try {
            $modelObj = new $modelName();
            $controllerExecute = new $controllerName($this->entryList, $modelObj);
            if ($apiMethod == 'POST' && $apiMethod == 'PUT') {
                $controllerExecute->$methodName($phpInput);  // whitelistar  // case
            } else {
                $controllerExecute->$methodName($phpInput);
            }
        } catch (\Exception  $e) {
            echo "Error" . $e->getMessage();
        }
    }

    private function isForbiddenMethod($apiMethod)
    {
        return in_array($apiMethod, $this->forbiddenMethods);
    }
}
