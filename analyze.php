#!/usr/bin/php
<?php

require_once("include/functions.php");

$dir = "dat/all/";

for ($rule=0; $rule < 256; $rule++) {
    $atractors = [];
    $cycler = "";
    // load data
    $json = file_get_contents($dir.$rule.".json");
    $decoded = json_decode($json, true);
    foreach ($decoded as $ignore=>$data) {
        foreach ($data as $c=>$ev) {
            $last = count($ev)-1;
            if ($last > 0) {
                if (strpos($last_value, 'cycle') !==false) {
                    $last--;
                    $cycler = "(c)";
                }
                $last_value = $ev[$last];                
                $atractors[$last_value] = true;
            }
        }
    }
    $num = count($atractors);
    print "$rule: $num $cycler\n";
}