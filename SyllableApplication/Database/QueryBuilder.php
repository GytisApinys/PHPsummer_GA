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
    private $fields = [];
    private $from = [];
    private $where = [];

    public function select(array $fields): QueryBuilder
    {
        $this->fields = $fields;
        return $this;
    }

//    public function insert(array $fields): QueryBuilder
//    {
//        $this->fields = $fields;
//        return $this;
//    }
//
//    public function delete(array $fields): QueryBuilder
//    {
//        $this->fields = $fields;
//        return $this;
//    }
//
//    public function update(array $fields): QueryBuilder
//    {
//        $this->fields = $fields;
//        return $this;
//    }

    public function from(string $table, string $alias): QueryBuilder
    {
        $this->from[] = $table . ' AS ' . $alias;

        return $this;
    }

    public function where(string $condition): QueryBuilder
    {
        $this->where[] = $condition;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            join(', ', $this->fields),
            join(', ', $this->from),
            join(' AND ', $this->where)
        );
    }

}