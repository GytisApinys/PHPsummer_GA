<?php


//use Database\QueryBuilder;
//
//include 'Database/QueryBuilder.php';
//$hello = new QueryBuilder();
//
////$hello->select(['foo', 'bar']);
////$hello->from('foobar', 'f');
//$i = 5;
//$query = (new QueryBuilder())
//    ->delete("words")
//    ->where(['ID = 43424234423434234234234234']);
//
//echo (string)$query;

$wordsFromDB[] = [
    "word" => "w-ord"
];

$wordsFromDB[] = [
    "word2" => "w-ord2"
];
$keys = array_keys($wordsFromDB);
$values = array_values($wordsFromDB);
//var_dump($wordsFromDB);
