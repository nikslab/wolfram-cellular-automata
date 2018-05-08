#!/usr/bin/php
<?php

require_once("include/functions.php");

$rule = $argv[1];
print "Rule #$rule:\n\n";
$gens = 50;
if (isset($argv[2])) {
    $gens = $argv[2];
}

// Initial
$array = randomInitial(100);

$stop = false;
$g = 0;
$cycle = 0;
$history = [];
while (!$stop) {
    $last = $array;
    $line = printState($array);
    $history[] = $line;
    print "$line\n";
    $array = nextGen($array, $rule);
    $g++;
    $cycle = detectCycle($history);
    if (($g >= $gens) || ($last == $array) || ($cycle > 1)) {
        $stop = true;
    }
}

if ($g < $gens) {
    $g--;
    if ($cycle) {
        print "Cycle of length $cycle detected, stopping\n";
    } else {
        print "Stuck in attractor after $g iterations, no point in going forward\n";
    }
} else {
    print "Reached max $g iterations\n";
}
