<?php
namespace task\two;

class InputHand implements WriteConsole
    {
        public function inputConsole()
        {
            $word = trim(fgets(STDIN));
            return $word;            
        }
            
        public function outputConsole($message)
        {
            // put display responsability here
        }
    }