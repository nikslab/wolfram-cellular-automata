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
$array = '';
for ($i=0; $i<40; $i++) {
    $array .= '0';
}
$array .= '1';
for ($i=0; $i<40; $i++) {
    $array .= '0';
}

$stop = false;
$g = 0;
while (!$stop) {
    $last = $array;
    $line = printState($array);
    print "$line\n";
    $array = nextGen($array, $rule);
    $g++;
    if (($g >= $gens) || ($last == $array)) {
        $stop = true;
    }
}

if ($g < $gens) {
    $g--;
    print "Stuck after $g iterations, no point in going forward\n";
} else {
    print "Reached max $g iterations\n";
}