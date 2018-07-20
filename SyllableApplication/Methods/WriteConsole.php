<?php

namespace SyllableApplication\Methods;

interface WriteConsole
{
    public function inputConsole(): array;

    public function outputConsole($message): void;
}