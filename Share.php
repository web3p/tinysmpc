<?php

class Share {
  public string $value;
  public VirtualMachine $owner;

  public function __construct(string $value, VirtualMachine $owner)
  {
    $owner->objects[] = $this;
    $this->value = $value;
    $this->owner = $owner;
  }

  public function add(Share $scalar): Share
  {
    if ($this->owner !== $scalar->owner) {
      throw new Error("should have the same owner");
    }
    $sum = mod(bcadd($this->value, $scalar->value));
    return new Share($sum, $this->owner);
  }

  public function sub(Share $scalar): Share
  {
    if ($this->owner !== $scalar->owner) {
      throw new Error("should have the same owner");
    }
    $sum = mod(bcsub($this->value, $scalar->value));
    return new Share($sum, $this->owner);
  }

  public function send_to(VirtualMachine $owner): Share
  {
    return new Share($this->value, $owner);
  }
}