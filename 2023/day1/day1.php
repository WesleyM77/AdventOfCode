<?php

$filename = 'day1input.txt';
$contents = file($filename);

$calibration = 0;
const DEBUG = false;

foreach($contents as $line) {
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    $chars = str_split($line);
    $firstDigit = NULL;
    $lastDigit = NULL;
    if (DEBUG) {
        echo '"' . $line . '": ';
    }
    foreach ($chars as $char) {
        if (DEBUG) {
            echo $char . ' ';
        }
        $int = intval($char);
        if ($int == 0) {
            continue;
        }
        if ($firstDigit == NULL) {
            $firstDigit = $char;
            $lastDigit = $char;
        }
        $lastDigit = $char;
    }
    $lineValue = $firstDigit . $lastDigit;
    if (DEBUG) {
        echo " fd: $firstDigit - ld: $lastDigit - value: $lineValue";
    }
    $calibration += (int) $lineValue;
    if (DEBUG) {
        echo "\n";
    }
}

echo 'Puzzle Solution: ' . $calibration;
