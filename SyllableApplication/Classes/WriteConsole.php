<?php
namespace SyllableApplication\Classes;

interface WriteConsole
    {
        public function inputConsole();
        public function outputConsole($message);
    }