# tinysmpc
tinysmpc in php, source: https://github.com/kennysong/tinysmpc

# usage

```
<?php

require(__DIR__ . '/utils.php');
require(__DIR__ . '/PrivateScalar.php');
require(__DIR__ . '/Share.php');
require(__DIR__ . '/SharedScalar.php');
require(__DIR__ . '/VirtualMachine.php');

$vm_a = new VirtualMachine("alice");
$vm_b = new VirtualMachine("bob");
$vm_c = new VirtualMachine("charlie");

$a = new PrivateScalar("25", $vm_a);
$b = new PrivateScalar("50", $vm_b);
$c = new PrivateScalar("10", $vm_c);

$shared_a = $a->share([$vm_a, $vm_b, $vm_c]);
$shared_b = $b->share([$vm_a, $vm_b, $vm_c]);
$shared_c = $c->share([$vm_a, $vm_b, $vm_c]);

$output = $shared_a->add($shared_b)->sub($shared_c);

var_dump($shared_a->reconstruct($vm_a)->value, $shared_b->reconstruct($vm_b)->value, $shared_c->reconstruct($vm_c)->value);
var_dump($output->reconstruct($vm_a)->value, $output->reconstruct($vm_b)->value, $output->reconstruct($vm_c)->value);
```

# todo

- [ ] prime size Q
- [ ] multiplication
- [ ] comparason
- [ ] divide
- [ ] orhers...
