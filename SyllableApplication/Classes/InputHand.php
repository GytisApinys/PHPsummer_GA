<?php

namespace SyllableApplication\Classes;

class InputHand implements WriteConsole
{
    public function inputConsole(): array
    {
        echo "Enter word to work with:\n";
        $word = trim(fgets(STDIN));
        $wordList = preg_split('/\b/', $word);
        return $wordList;
    }

    public function outputConsole($message): void
    {
        echo "\nYour changed input:\n";
        echo "$message\n";
    }
}
