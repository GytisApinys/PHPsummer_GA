<?php
namespace SyllableAplication\Classes;

class InputHand implements WriteConsole
    {
        public function inputConsole()
        {
            echo "Enter word to work with:\n";
            $word = trim(fgets(STDIN));
            return $word;            
        }
            
        public function outputConsole($message)
        {
            // put display responsability here
        }
    }