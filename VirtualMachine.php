<?php

class VirtualMachine {
  public string $name;
  public array $objects;

  public function __construct(string $name)
  {
    $this->name = $name;
    $this->objects = [];
  }
}