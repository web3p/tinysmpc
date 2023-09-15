<?php

class SharedScalar {
  public array $shares;
  public array $share_of;
  public array $owners;

  public function __construct(array $shares)
  {
    $this->shares = $shares;
    foreach ($shares as $share) {
      $this->owners[] = $share->owner;
      $this->share_of[$share->owner->name] = $share;
    }
  }

  public function add(SharedScalar $scalar): SharedScalar
  {
    if ($this->owners !== $scalar->owners) {
      throw new Error("should have the same owners");
    }
    $sum_shares = [];
    foreach ($this->owners as $owner) {
      $sum_shares[] = $this->share_of[$owner->name]->add($scalar->share_of[$owner->name]);
    }
    return new SharedScalar($sum_shares);
  }

  public function reconstruct (VirtualMachine $owner): PrivateScalar
  {
    $value = n_from_shares($this->shares, $owner);
    return new PrivateScalar($value, $owner);
  }
}