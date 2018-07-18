<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 5:05 PM
 */

namespace Model;


use Database\Database;

class PatternsModel
{
    private $db;

    /**
     * WordModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPatterns(): void
    {

    }

    public function getPatternByID(string $id): void
    {

    }

    public function postPattern(): void
    {

    }

    public function deleteAllPatterns(): void
    {

    }

    public function deletePatternsByID(string $id): void
    {

    }

    public function updatePatternsByID(string $id)
    {

    }
}