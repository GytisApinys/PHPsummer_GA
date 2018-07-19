<?php

namespace SyllableApplication\Classes;

class Timer
{
    private $startingTime;
    private $endingTime;

    public function start(): void
    {
        $this->startingTime = microtime(true);
    }

    public function stop(): void
    {
        $this->endingTime = microtime(true);
    }

    public function duration(): int
    {
        $duration = $this->endingTime - $this->startingTime;

        return $duration;
    }
}