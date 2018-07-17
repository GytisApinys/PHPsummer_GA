<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 3:51 PM
 */

namespace Api;
use Controller\WordController;
use Controller\PatternController;

class APIrouter
{
    private $entrylist;
    public function __construct(string $apiURL)
    {
        $this->entrylist = explode('/', $apiURL);
//        echo "helllooooooo###";
        $this->execute();
    }
//    public function action()
//    {
//        if (isset($_SERVER['REQUEST_METHOD'])) {
//            switch ($_SERVER['REQUEST_METHOD']) {
//                case "GET":
//                    $this->get();
//                    break;
//                case "POST":
//                    $this->post();
//                    break;
//                case "DELETE":
//                    $this->delete();
//                    break;
//                case "UPDATE":
//                    $this->update();
//                    break;
//            }
//        }
//    }
    public function directions()
    {
        switch ($this->entrylist[0]) {
            case "word":
//                $wordControler = new WordController($urlentry);
                $controllerName = "WordController";
                return $controllerName;
                break;
            case "patters":
//                $patterController = new PatternController($urlentry);
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
        $methodName = strtolower($_SERVER['REQUEST_METHOD']);

        echo $methodName;
        echo $controllerName;  // problem here can't call

        $controllerExecute = new $controllerName($this->entrylist);
        $controllerExecute->$methodName();


    }
}