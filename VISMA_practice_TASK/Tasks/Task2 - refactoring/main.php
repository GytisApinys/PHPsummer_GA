<?php 
namespace task\two;

include 'Classes/File.php';
include 'Classes/Word.php';

    $filename = "https://gist.githubusercontent.com/cosmologicon/1e7291714094d71a0e25678316141586/raw/006f7e9093dc7ad72b12ff9f1da649822e56d39d/tex-hyphenation-patterns.txt";
    $patterns = File::read_from_file($filename);


    $objFile = new File();
    $givenWord = $objFile->start_display();
    $objWord = new Word($givenWord);
    $word_syllabled = $objWord->modifyWord($patterns);
    $objFile->end_display($word_syllabled);
    


