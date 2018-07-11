<?php
namespace SyllableAplication\Classes;

class Timer 
{
    private $startingTime;
    private $endingTime;

    public function start()
    {
        $this->startingTime = microtime(true);
    }
    public function stop()
    {
        $this->endingTime = microtime(true);
    }
    public function duration()
    {
        $duration = $this->endingTime - $this->startingTime;
        
        return $duration;
    }
}