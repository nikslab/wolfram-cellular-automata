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
        $output = substr($rule_bin, $a, 1);
    }
    return $output;   
}

function nextGen($array, $rule) {
    $result = '';
    for ($i=0; $i <= (strlen($array)-3); $i++) {
        $result .= cellNext($rule, substr($array, $i, 3));
    }
    // handle the edge
    $edge = substr($array, strlen($array)-2, 2) . substr($array, 0, 1);
    $result .= cellNext($rule, substr($array, $i, 3));
    $edge = substr($array, strlen($array)-1, 1) . substr($array, 0, 2);
    $result .= cellNext($rule, substr($array, $i, 3));
    return $result;
}

function printState($array, $chars=[' ', 'x']) {
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

