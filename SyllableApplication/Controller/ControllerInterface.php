<?php

namespace Controller;


interface ControllerInterface
{
    public function __construct(array $urlString);
    public function get(): void;
    public function post(): void;
    public function delete(): void;
    public function update(): void;
}
