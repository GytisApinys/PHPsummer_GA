<?php
namespace SyllableApplication\Classes;

class InputHand implements WriteConsole
    {
        public function inputConsole()
        {
            echo "Enter word to work with:\n";
            $word = trim(fgets(STDIN));
            $wordlist = preg_split('/\b/',$word);
            return $wordlist;            
        }
            
        public function outputConsole($message)
        {
            echo "\nYour changed input:\n";
            echo "$message\n";
        }
    }