<?php
/**
 * Created by PhpStorm.
 * User: Gytis.Apinys
 * Date: 7/17/2018
 * Time: 3:22 PM
 */

namespace Database;


class QueryBuilder
{
    private $action = "";
    private $values = "";
    private $from = "";
    private $where = "";

    public function __construct()
    {
    }

    public function select(array $attributes = []): QueryBuilder // collums rename
    {
        if ($attributes == []) {
            $this->action = "SELECT * ";
        } else {
            $this->action = "SELECT " . implode(", ", $attributes);
        }
        return $this;
    }

    public function insert(string $tableName): QueryBuilder
    {
        $this->action = "INSERT INTO " . $tableName;
        return $this;
    }

    public function delete(string $tableName): QueryBuilder
    {
        $this->action = "DELETE FROM " . $tableName;
        return $this;
    }

    public function update(string $tableName): QueryBuilder
    {
        $this->action = "UPDATE " . $tableName;

        return $this;
    }

    public function from(string $tables): QueryBuilder // can be array
    {
        if (is_array($tables)) {
            $this->from = "FROM " . implode(", ", $tables);
        } else {
            $this->from = "FROM $tables";
        }
        return $this;
    }

    public function where(array $conditions): QueryBuilder
    {
        $this->where = "WHERE " . implode(" AND ", $conditions);
        return $this;
    }

    public function value(array $valuesByKey): QueryBuilder
    {
        $this->values = "(" . implode(", ", array_keys($valuesByKey[0])) . ") VALUES ";
        foreach ($valuesByKey as $key => $value) {
            $this->values .= "('" . implode("', '", $value) . "')";
            if ($key != (count($valuesByKey) - 1)) {
                $this->values .= ", ";
            }
        }
        return $this;
    }

    public function set(array $valuesByKey): QueryBuilder
    {
        $temp = []; // rename temp
        foreach ($valuesByKey[0] as $key => $value) {
            $temp[] = "$key='$value'";
        }
        $this->values = " SET " . implode(", ", $temp);

        return $this;
    }

    public function __toString(): string
    {
        return $this->action . " " . $this->from . " " . $this->values . " " . $this->where;
    }
}
