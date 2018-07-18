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
                $controllerName = "WordController";
                return $controllerName;
                break;
            case "patterns":
                $controllerName = "PatternController";
                return $controllerName;
                break;
            default:
                echo "Wrong input.";
        }

    }

    public function execute()
    {
        $controllerName = $this->directions();
        $controllerName= 'Controller\\'.$controllerName;  //
        $methodName = strtolower($_SERVER['REQUEST_METHOD']);
        try {
            $controllerExecute = new $controllerName($this->entrylist);
            $controllerExecute->$methodName();
        } catch (\Exception  $e) {
            echo "Error". $e->getMessage();
        }
    }
}