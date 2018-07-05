<?php 
namespace task\two;

include 'Classes/File.php';
include 'Classes/Word.php';
include 'Classes/WriteConsole.php';
include 'Classes/InputFile.php';
include 'Classes/InputHand.php';

const FILENAME = "https://gist.githubusercontent.com/cosmologicon/1e7291714094d71a0e25678316141586/raw/006f7e9093dc7ad72b12ff9f1da649822e56d39d/tex-hyphenation-patterns.txt";


// echo __DIR__;
// die();
$patterns = File::readData(FILENAME);
$objFile = new File();
$givenWord = $objFile->startingMessage();

 
    if(is_array($givenWord))
    {
        foreach($givenWord as $word)
        {
            $objWord = new Word($word);
            $word_syllabled = $objWord->modifyWord($patterns);
            $objFile->resultDisplay($word_syllabled);
        }
    }else 
        {
             $objWord = new Word($givenWord);
            $word_syllabled = $objWord->modifyWord($patterns);
            $objFile->resultDisplay($word_syllabled);
        }
    
    


