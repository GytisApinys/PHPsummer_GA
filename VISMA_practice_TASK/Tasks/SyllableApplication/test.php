<?php


$tableName = 'Info';
$atributeName = array('ID','Name','Surname');
$value = array('1','Gytis','Apinys');
$s = count($value);

$query = "SELECT * FROM ". $tableName ." WHERE ";
for ($i = 0; $i < count($atributeName); $i++) {
    $query .= $atributeName[$i] . " = :" . $atributeName[$i] ." AND ";
}
$query = substr($query, 0, -5);







echo $query;

