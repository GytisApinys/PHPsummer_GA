<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 5:05 PM
 */

namespace Model;


use Database\Database;
use Database\QueryBuilder;

class PatternModel
{
    private $db;
    private $tableName = "patterns";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPatterns(): array
    {
        $query = (new QueryBuilder())
            ->select()
            ->from($this->tableName);
        $output = $this->db->executeWithResult($query);
        return $output;
    }

    public function getPatternByID(string $id): array
    {
        $query = (new QueryBuilder())
            ->select()
            ->from($this->tableName)
            ->where(["id = $id"]);
        $output = $this->db->executeWithResult($query);
        return $output;
    }

    public function postPattern(array $phpInput): void
    {
        $query = (new QueryBuilder())
            ->insert($this->tableName)
            ->value($phpInput);
        $this->db->executeWithoutResult($query);
    }

    public function deleteAllPatterns(): void
    {
        $query = (new QueryBuilder())
            ->delete($this->tableName);
        $this->db->executeWithoutResult($query);
    }

    public function deletePatternsByID(string $id): void
    {
        $query = (new QueryBuilder())
            ->delete($this->tableName)
            ->where(["id = $id"]);
        $this->db->executeWithoutResult($query);
    }

    public function updatePatternsByID(string $id, array $phpInput)
    {
        {
            $query = (new QueryBuilder())
                ->update($this->tableName)
                ->set($phpInput)
                ->where(["id = $id"]);
            echo $query;
            $this->db->executeWithoutResult($query);
        }
    }
}