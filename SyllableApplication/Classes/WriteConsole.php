<?php
namespace SyllableAplication\Classes;

interface WriteConsole
    {
        public function inputConsole();
        public function outputConsole($message);
    }