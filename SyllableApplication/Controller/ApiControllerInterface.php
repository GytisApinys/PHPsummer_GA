<?php

namespace Controller;


interface ApiControllerInterface
{
    public function get(): void;
    public function post(array $phpInput): void;
    public function delete(): void;
    public function put(array $phpInput): void;
}
