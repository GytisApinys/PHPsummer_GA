<?php

$string = 'If once you start down the dark path, forever will it dominate
your destiny, consume you it will, as it did Obi-Wan’s
apprentice.';

$word = "start";
$ChangedWord = "sta-rt";

$a = preg_split('/\b/',$string);
$c = '';
// var_dump($a);
foreach($a as $b){
    if (preg_match("/[\w]/",$b) != NULL){
        $b = 'hello';
    }
    $c .= $b;

}
echo $c;

