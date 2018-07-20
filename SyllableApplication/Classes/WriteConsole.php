<?php

namespace SyllableApplication\Classes;

interface WriteConsole
{
    public function inputConsole(): array;

    public function outputConsole($message): void;
}