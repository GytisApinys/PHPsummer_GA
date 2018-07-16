<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/16/2018
 * Time: 1:54 PM
 */

namespace Api;


class SyllableAPI
{

    public function __construct($apiURL)
    {
        var_dump($apiURL);
        $wordlist = explode('/',$apiURL);
        var_dump($wordlist);
        if (isset($_SERVER['REQUEST_METHOD'])) {
            switch($_SERVER['REQUEST_METHOD']){
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

    }
    public function post()
    {

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