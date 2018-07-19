<?php

namespace SyllableApplication\Classes;

class InputFile implements WriteConsole
{
    public function inputConsole(): array
    {
        echo "Enter file name of words\n";
        $filename = trim(fgets(STDIN));
        $filename = __DIR__ . "\\..\\Data\\" . $filename . ".txt";

        if (file_exists($filename)) {
            $words = file_get_contents($filename);
            $wordListDivided = preg_split('/\b/', $words);
            return $wordListDivided;
        } else {
            echo "File does not exist.";
            die;//  error exception handler
        }
    }

    public function outputConsole($message): void
    {
        $file = 'result_' . date('His') . '.txt';
        $fileName = __DIR__ . "\..\Results\\" . $file;
        if (file_put_contents($fileName, $message)) {
            echo "Results were successfully placed in file: $file\n";
        }
    }
}