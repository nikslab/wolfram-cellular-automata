#!/usr/bin/php
<?php

require_once("include/functions.php");

$gens = 1000;
$times = 100;
$bigHistory = [];

for ($rule=0; $rule<256; $rule++) {
    $bigHistory = [];
    $rule_count = 0;
    for ($c=1; $c <= $times; $c++) { // run each one 100 times
        print "Rule $rule, #$c\r";
        $array = randomInitial(100);
        $stop = false;
        $g = 0;
        $cycle = 0;
        $history = [];
        while (!$stop) {
            $last = $array;
            $line = printState($array);
            //print "$line\n";
            $history[] = $line;
            $array = nextGen($array, $rule);
            $g++;
            $rule_count++;
            $cycle = detectCycle($history);
            if (($g >= $gens) || ($last == $array) || ($cycle > 1)) {
                $stop = true;
            }
            if ($cycle > 1) {
                $history[] = "cycle $cycle";
            }
        }
        $bigHistory[$rule][$c] = $history;
    }
    $json = json_encode($bigHistory);
    file_put_contents("dat/all/$rule.json", $json);
    print "Rule $rule, #100\t";
    $percent = round(($rule_count / ($times*$gens)) * 100, 0);
    for ($k=1; $k<=$percent; $k++) {
        print ".";
    }
    if ($cycle > 1) {
        print " (c)";
    }
    print "\n";
}

