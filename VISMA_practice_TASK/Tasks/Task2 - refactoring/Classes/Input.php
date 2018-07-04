<?php
namespace task\two;

class Input implements data_interface
    {
        public $msg = "\nEnter word you wanna split by syllables:";

        public function outputConsole($message)
        {
                echo $this->msg;
                $task = $this->getInput();
                return $task;
        }
    }