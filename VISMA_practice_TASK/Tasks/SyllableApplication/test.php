<?php


$tablename = 'Info';
$atributeName = array('ID','Name','Surname');
$value = array('1','Gytis','Apinys');
$s = count($value);
echo $s;
die;
$query = "INSERT INTO $tablename (";
$atributes = implode(", ",$atributeName);
$query .= $atributes.") VALUES(:";
$values = implode(", :", $atributeName);
$query .= $values . ")";







echo $query;

