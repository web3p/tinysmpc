<?php

function mod (int $n): int
{
  // return (int) ($n + PHP_INT_MIN + 1) % 2**64 - (PHP_INT_MAX + 1);
  return ($n + 1025) % 2**10 - (1025);
}

function n_from_shares (array $shares, VirtualMachine $owner)
{
  $sum;
  foreach ($shares as $share) {
    $share = $share->send_to($owner);
    if (isset($sum)) {
      $sum = $sum->add($share);
    } else {
      $sum = $share;
    }
  }
  return $sum->value;
}

function n_to_shares(int $n, array $owners)
{
  if (PHP_INT_MIN > $n || $n > PHP_INT_MAX) {
    throw new Error("n is too large");
  }

  $values = [];
  for ($i = 0; $i < count($owners) - 1; $i++) {
    // $values[] = rand(PHP_INT_MIN, PHP_INT_MAX);
    $values[] = rand(-1024, 1024);
  }

  $sum = 0;
  foreach ($values as $value) {
    $sum += $value;
  }
  $values[] = mod($n - $sum);

  $shares = [];

  foreach ($owners as $i => $owner) {
    $shares[] = new Share($values[$i], $owner);
  }
  return $shares;
}