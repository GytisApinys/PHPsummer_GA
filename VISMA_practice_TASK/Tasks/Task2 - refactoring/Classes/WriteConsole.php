<?php
namespace task\two;

interface WriteConsole
    {
        public function inputConsole();
        public function outputConsole($message);
    }