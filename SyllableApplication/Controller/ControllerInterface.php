<?php

namespace Controller;


interface ControllerInterface
{
    public function get(): void;
    public function post(array $phpInput): void;
    public function delete(): void;
    public function put(array $phpInput): void;
}
