<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/16/2018
 * Time: 1:54 PM
 */

namespace Api;

use Database\Database;
use PDO;


class SyllableAPI
{
    private $entrylist;
    private $database;

    public function __construct(string $apiURL, Database $db)
    {
//        var_dump($apiURL);

        $this->entrylist = explode('/', $apiURL);
        $this->database = $db;
        echo "he";
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

    public function get()
    {
        if (count($this->entrylist) == 1) {
            switch ($this->entrylist[0]) {
                case "word":
                    $list = $this->database->select("words");
                    echo json_encode($list);

            }
        } elseif (count($this->entrylist) == 2) {
            switch ($this->entrylist[0]) {
                case "word":
                    $list = $this->database->select("words", $value = [
                        "id" => $this->entrylist[1]
                    ]);
                    echo json_encode($list);
            }
        }

    }

    public function post()
    {
        echo "he\n";
        var_dump($_POST['word_finished']);
        $content = file_get_contents("php://input");
        $hi = json_decode($content);
//        echo $hi[1];
    }

    public function delete()
    {

    }

    public function update()
    {

    }
}
//
//$message = [
//    "Name" => "Gytis",
//    "Age" => "23"
//];
//echo json_encode($message);
//
//if (isset($_SERVER['REQUEST_METHOD']))
//{
//    switch($_SERVER['REQUEST_METHOD']){
//        case "GET":
//            $a = $_SERVER['REQUEST_URI'];
//            echo "GET method --> $a";
//            break;
//        case "PUT":
//            $a = $_SERVER['REQUEST_URL'];
//            echo "PUT method --> $a";
//            break;
//    }
//
//
//
//
//}