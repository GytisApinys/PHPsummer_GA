<?php

namespace Controller;


interface ControllerInterface
{
    public function get(array $phpInput): void;
    public function post(array $phpInput): void;
    public function delete(array $phpInput): void;
    public function put(array $phpInput): void;
}
