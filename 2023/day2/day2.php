<?php

$filename = 'day2input.txt';
$contents = file($filename);

$answer = 0;
const DEBUG = true;
$game = 1;

$redLimit = 12;
$greenLimit = 13;
$blueLimit = 14;

foreach($contents as $line) {
    $line = trim(preg_replace('/\t\n\r+/', ' ', $line));
    // We don't care about which sub game it's from since any invalid pull invalidates the entire game. No need to do
    // extra handling for semicolons, commas, or newlines. Check each color count against the limit.
    preg_match_all('/((\d+) (green|blue|red))/', $line, $matches);

    $colorCount = sizeof($matches[0]);
    $gamePossible = true;

    for ($c = 0; $c < $colorCount; $c++) {
        switch ($matches[3][$c]) {
            case 'red':
                if ($matches[2][$c] > $redLimit) {
                    $gamePossible = false;
                }
            case 'green':
                if ($matches[2][$c] > $greenLimit) {
                    $gamePossible = false;
                }
            case 'blue':
                if ($matches[2][$c] > $blueLimit) {
                    $gamePossible = false;
                }
        }
    }

    if ($gamePossible) {
        $answer += $game;
    }

    $game++;
}

echo "Sum of IDs for valid games: " . $answer;