<?php

class PrivateScalar {
  public int $value;
  public VirtualMachine $owner;

  public function __construct(int $value, VirtualMachine $owner)
  {
    $owner->objects[] = $this;
    $this->value = $value;
    $this->owner = $owner;
  }

  public function share(array $machines): SharedScalar
  {
    $shares = n_to_shares($this->value, $machines);
    return new SharedScalar($shares);
  }
}