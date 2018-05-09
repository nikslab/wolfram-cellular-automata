<?php

function cellNext($rule, $input) {
    $output = false;
    if (($rule >= 0) && ($rule <= 255) && (strlen($input) == 3)) {
        // fix input just in case
        $input = substr($input, 0, 3);
        // input to decimal
        $a = bindec($input); // a number 0-7
        // rule to binary
        $rule_bin = decbin($rule);
        // left pad to 8 bits and reverse
        $rule_bin = strrev(str_pad($rule_bin, 8, "0", STR_PAD_LEFT));
        // output will be the $a-th bit of $rule_bin
        $output = substr($rule_bin, $a, 1);
        //print "$input=>$a=>$rule_bin=>$output/";
    }
    if ($output === false) { print "Error! $rule|$input|$a|$rule_bin\n"; }
    return $output;   
}

function nextGen($array, $rule) {
    $result = '';
    $edge = substr($array, -1) . substr($array, 0, 2);
    $result .= cellNext($rule, $edge);
    for ($i=1; $i <= (strlen($array)-3); $i++) {
        $result .= cellNext($rule, substr($array, $i-1, 3));
    }
    // handle the edge
    $edge = substr($array, -2) . substr($array, 0, 1);
    $result .= cellNext($rule, $edge);
    $edge = substr($array, -1) . substr($array, 0, 2);
    $result .= cellNext($rule, $edge);
    return $result;
}

function printState($array, $chars=['.', 'X']) {
    $zero = $chars[0];
    $one = $chars[1];
    $result = "";
    for ($i=0; $i <= (strlen($array)-1); $i++) {
        $bit = substr($array, $i, 1);
        if ($bit == '0') { $result .= $zero; }
        if ($bit == '1') { $result .= $one;  }
    }
    return $result;
}

function randomInitial($len) {
    $prob = rand(0, 100);
    $array = '';
    for ($i=1; $i<=$len; $i++) {
        $die = rand(0, 100);
        $r = '0';
        if ($die < $prob) {
            $r = '1';
        }
        $array .= $r;
    }
    return $array;
}

function detectCycle($history) {
    $result = 0;
    $last = count($history)-1;
    $search = $history[$last];
    $i = 0;
    $stop = false;
    while (!$stop) {
        if ($search === $history[$i]) {
            $stop = true;
            $result = true;
        } else {
            $i++;
            if ($i >= count($history)-1) {
                $stop = true;
            }
        }
    }
    return ($last-$i);
}