<?php
namespace Database;

use PDO;

class Database 
{
    private $database;
    

    public function __construct()
    {
        $this->database = new PDO('mysql:host=localhost', 'root','Gytukas123');
        if (!$this->database) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->database->exec('USE syllable_application');
    }
    //////
    # $db = new Database();
    # $db->add("try",$one = array( "www"), $two = array( "test"));
    /////
    public function add(string $tableName, array $atributeName, array $values)
    {
        $this->database->beginTransaction();

        $query = "INSERT INTO ". $tableName ."(";
        $atributes = implode(", ",$atributeName);
        $query .= $atributes.") VALUES(:";
        $valueString = implode(", :", $atributeName);
        $query .= $valueString . ")";
        
        $command = $this->database->prepare($query);
        for ($i = 0; $i < count($atributeName); $i++)
        {
            $command->bindParam(":".$atributeName[$i], $values[$i]);
        }
        $command->execute();
        $this->database->commit();
    }

    public function delete()
    {
        $this->database->beginTransaction();

        $query = "INSERT INTO ". $tableName ."(";
        $atributes = implode(", ",$atributeName);
        $query .= $atributes.") VALUES(:";
        $valueString = implode(", :", $atributeName);
        $query .= $valueString . ")";
        
        $command = $this->database->prepare($query);
        for ($i = 0; $i < count($atributeName); $i++)
        {
            $command->bindParam(":".$atributeName[$i], $values[$i]);
        }
        $command->execute();
        $this->database->commit();

    }
    public function search(string $tableName, array $atritubeName, array $values ) // not working yet
    {
        $this->database->beginTransaction();
        // SELECT * FROM `try` WHERE www = "test" and id = "1"
        $query = "SELECT * FROM ". $tableName ." WHERE ";
        for ($i = 0; $i < count($atributeName); $i++) {
            $query .= $atributeName[$i] . " = :" . $atributeName[$i] ." AND ";
        }
        $query = substr($querty, 0, -5);
       
        $command = $this->database->prepare($query);
        for ($i = 0; $i < count($atributeName); $i++)
        {
            $command->bindParam(":".$atributeName[$i], $values[$i]);
        }
        $command->execute();

        $this->database->commit();
    }


}