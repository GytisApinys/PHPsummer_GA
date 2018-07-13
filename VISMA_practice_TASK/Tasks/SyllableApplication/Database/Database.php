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
    public function beginTransaction()
    {
        $this->database->beginTransaction();
    }
    public function endTransaction()
    {
        $this->database->commit();
    }
    public function rollbackTransaction()
    {
        $this->database->rollback();
    }
    //////
    # $db = new Database();
    # $db->insert("try",$one = [
    #  "name" => "Gytis",
    #  "surname" => "Apinys"]);
    /////

    public function insert(string $tableName, array $values) //??
    {
        $atributes = implode(", ", array_keys($values));
        $valueString = implode(", :", array_keys($values));
        
        $query = "INSERT INTO ". $tableName ."(".$atributes.") VALUES(:".$valueString.")";
        
        $keysArray = array_keys($values);
        $valuesArray = array_values($values);
        $command = $this->database->prepare($query);
        for ($i = 0; $i < count($values); $i++) {
            $command->bindParam(":".$keysArray[$i], $valuesArray[$i]);
        }
        $command->execute();
    }

    public function delete(string $tableName, array $values = [])
    {
        $query = "DELETE FROM ". $tableName; 
        if (!empty($values)) {
            $query .= " WHERE ";

            $keysArray = array_keys($values);
            $valuesArray = array_values($values);

            for ($i = 0; $i < count($values); $i++) {
                $query .= $keysArray[$i] . " = :" . $keysArray[$i] ." AND ";
            }
            $query = substr($query, 0, -5);

            $command = $this->database->prepare($query);
            
            for ($i = 0; $i < count($values); $i++)
            {
                $command->bindParam(":".$keysArray[$i], $valuesArray[$i]);
            }
            
        }else {
            $command = $this->database->prepare($query);
        }
        $command->execute();
    }
    public function select(string $tableName, array $values = []) // if array is empty no need of table
    {
        // SELECT * FROM `try` WHERE www = "test" and id = "1"
        $query = "SELECT * FROM ". $tableName;
        if (!empty($values)) {
            $query .= " WHERE ";

            $keysArray = array_keys($values);
            $valuesArray = array_values($values);

            for ($i = 0; $i < count($values); $i++) {
                $query .= $keysArray[$i] . " = :" . $keysArray[$i] ." AND ";
            }
            $query = substr($query, 0, -5);
           
            $command = $this->database->prepare($query);
            for ($i = 0; $i < count($values); $i++)
            {
                $command->bindParam(":".$keysArray[$i], $valuesArray[$i]);
            }
        }else {
            $command = $this->database->prepare($query);
        }
        $command->execute();

        //$dbArray = $command->fetchAll(PDO::FETCH_COLUMN, 1);  in code


        return $command;
    }
    public function update()
    {
        //
    }

}