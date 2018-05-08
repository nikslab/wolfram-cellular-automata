<?php

function cellNext($rule, $input) {
    
    $output = false;
    if (($rule >= 0) && ($rule <= 255) && (strlen($input) == 3)) {
        // fix input just in case
        $input = substr($input, 0, 3);
        // input to decimal
        $a = bindec($input); // a number 0-7
        // rule to binary
        $rule_bin = decbin($rule); // 8 bits
        // output will be the $a-th bit of $rule_bin
        $output = substr($rule_bin, $a);
    }
    return $output;
    
}

function printState($array, $chars=[' ', 'x']) {
    $zero = $chars[0];
    $one = $chars[1];
    foreach ($array as $bit) {
        if ($bit == 0) { print $zero; }
        if ($bit == 1) { print $one;  }
    }
    print "\n";
}

