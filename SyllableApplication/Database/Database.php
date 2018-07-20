<?php

namespace Database;

use PDO;

class Database
{
    private $db;


    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost', 'root', 'Gytukas123');
        if (!$this->db) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->db->exec('USE syllable_application');
    }

    public function beginTransaction(): void
    {
        $this->db->beginTransaction();
    }

    public function endTransaction(): void
    {
        $this->db->commit();
    }

    public function rollbackTransaction(): void
    {
        $this->db->rollback();
    }

    public function insert(string $tableName, array $values): void
    {
        $attributes = implode(", ", array_keys($values));
        $valueString = implode(", :", array_keys($values));

        $query = "INSERT INTO " . $tableName . "(" . $attributes . ") VALUES(:" . $valueString . ")";

        $keysArray = array_keys($values);
        $valuesArray = array_values($values);
        $command = $this->db->prepare($query);
        for ($i = 0; $i < count($values); $i++) {
            $command->bindParam(":" . $keysArray[$i], $valuesArray[$i]);
        }
        $command->execute();
    }

    public function delete(string $tableName, array $values = [])
    {
        $query = "DELETE FROM " . $tableName;
        if (!empty($values)) {
            $query .= " WHERE ";

            $keysArray = array_keys($values);
            $valuesArray = array_values($values);

            for ($i = 0; $i < count($values); $i++) {
                $query .= $keysArray[$i] . " = :" . $keysArray[$i] . " AND ";
            }
            $query = substr($query, 0, -5);

            $command = $this->db->prepare($query);

            for ($i = 0; $i < count($values); $i++) {
                $command->bindParam(":" . $keysArray[$i], $valuesArray[$i]);
            }

        } else {
            $command = $this->db->prepare($query);
        }
        $command->execute();
    }

    public function select(string $tableName, array $values = []): array
    {
        $query = "SELECT * FROM " . $tableName;
        if (!empty($values)) {
            $query .= " WHERE ";

            $keysArray = array_keys($values);
            $valuesArray = array_values($values);

            for ($i = 0; $i < count($values); $i++) {
                $query .= $keysArray[$i] . " = :" . $keysArray[$i] . " AND ";
            }
            $query = substr($query, 0, -5);

            $command = $this->db->prepare($query);
            for ($i = 0; $i < count($values); $i++) {
                $command->bindParam(":" . $keysArray[$i], $valuesArray[$i]);
            }
        } else {
            $command = $this->db->prepare($query);
        }
        $command->execute();

        $dbArray = $command->fetchAll(PDO::FETCH_ASSOC);


        return $dbArray;
    }

    public function lastInsertId(): int
    {
        $lastUsedID = $this->db->lastInsertId();
        return $lastUsedID;
    }

    public function executeWithResult(string $query): array
    {
        $command = $this->db->prepare($query);
        $command->execute();
        $dbArray = $command->fetchAll(PDO::FETCH_ASSOC);
        return $dbArray;
    }

    public function executeWithoutResult(string $query): void
    {
        $command = $this->db->prepare($query);
        $command->execute();
    }
}
