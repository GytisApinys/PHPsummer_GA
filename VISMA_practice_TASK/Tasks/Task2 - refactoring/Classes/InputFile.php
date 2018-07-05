<?php
namespace task\two;

use SplFileObject;

class InputFile implements WriteConsole
    {
        public function inputConsole()
        {
            echo "Enter file name of words\n";
            $filename = trim(fgets(STDIN));
            $filename =__DIR__."\\..\\Data\\" .$filename . ".txt";

             echo "*****".$filename."******\n";
             echo "*****".__DIR__."******\n";
            if (file_exists($filename))
                {
                    $file = new SplFileObject($filename);
                    while (!$file->eof()) {
                    $wordlist[] = trim($file->fgets());
                }
                return $wordlist;
            }else 
            {
                echo "File does not exist.";
                die;//  error expection handler
            }
        }
        public function outputConsole($message)
        {
            // put display responsability here
        }
    }