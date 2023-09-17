<?php

// TODO: add Q prime size
function mod (string $n): string
{
  // return bcsub(bcmod(bcadd((string) $n, (string) (PHP_INT_MIN + 1), 10), bcpow(2, 64)), bcadd(PHP_INT_MAX, 1));
  return $n;
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

function n_to_shares(string $n, array $owners)
{
  $values = [];
  for ($i = 0; $i < count($owners) - 1; $i++) {
    $values[] = (string) rand(PHP_INT_MIN, PHP_INT_MAX);
  }

  $sum = '0';
  foreach ($values as $value) {
    $sum = bcadd($sum, $value, 10);
  }
  $values[] = mod(bcsub($n, $sum, 10));

  $shares = [];

  foreach ($owners as $i => $owner) {
    $shares[] = new Share($values[$i], $owner);
  }
  return $shares;
}