<?php 

class File
{
    public $welcome_msg = "\nEnter word you wanna split by syllables:";

        public function __construct()
            {

            }
        public function start_display()
            {
                echo $this->welcome_msg;
                $task = $this->getInput();
                return $task;
            }
        public static function read_from_file($filename)
        {
            $file = new SplFileObject($filename);
            while (!$file->eof()) {
            $patterns[] = $file->fgets();
            }
            return $patterns;
        }
        public function end_display($formated_word)
        {
            echo "Your changed word is:\n\n";
            echo "$formated_word\n\n";
        }
        public function getInput()
        {
            $word = trim(fgets(STDIN));
            return $word;
        }

}


