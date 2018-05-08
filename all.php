#!/usr/bin/php
<?php

require_once("include/functions.php");

$gens = 1000;
$bigHistory = [];

for ($rule=0; $rule <20; $rule++) {
    $bigHistory = [];
    for ($c=1; $c <= 100; $c++) { // run each one 100 times
        print "Rule $rule, #$c\r";
        $array = randomInitial(100);
        $stop = false;
        $g = 0;
        $history = [];
        while (!$stop) {
            $last = $array;
            $line = printState($array);
            //print "$line\n";
            $history[] = $line;
            $array = nextGen($array, $rule);
            $g++;
            if (($g >= $gens) || ($last == $array)) {
                $stop = true;
            }
        }
        $bigHistory[$rule][$c] = $history;
    }
    $json = json_encode($bigHistory);
    file_put_contents("dat/all/$rule.json", $json);
    print "\n";
}

