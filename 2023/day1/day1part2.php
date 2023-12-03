<?php

$filename = '../day1/day1input.txt';
$contents = file($filename);

$digitsAsStrings = [
    'zero so I can do some magic with indexes ;)',
    'one',
    'two',
    'three',
    'four',
    'five',
    'six',
    'seven',
    'eight',
    'nine',
];

$calibration = 0;
const DEBUG = false;

foreach($contents as $line) {
    $ogMatches = [];
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    // Gotta use the positive lookahead feature of regex. This is why we do Advent of Code: to learn things!
    preg_match_all("/(?=(\d|one|two|three|four|five|six|seven|eight|nine))/", $line, $ogMatches);
    // Get the text that matched the second group, not the first.
    $matches = $ogMatches[1];
    if (DEBUG) {
        echo 'line: "' . $line . '" - matches: ' . implode(',', $matches);
    }
    $firstDigit = NULL;
    $lastDigit = NULL;
    foreach ($matches as $match) {
        $int = intval($match);
        if ($int == 0) {
            $int = array_search($match, $digitsAsStrings);
        }
        if ($firstDigit == NULL) {
            $firstDigit = $int;
            $lastDigit = $int;
        }
        $lastDigit = $int;
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