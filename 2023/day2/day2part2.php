<?php

$filename = 'day2input.txt';
$contents = file($filename);
//$contents = [
//'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
//'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
//'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
//'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
//'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
//];

$answer = 0;
const DEBUG = true;
$game = 1;

foreach($contents as $line) {
    $line = trim(preg_replace('/\t\n\r+/', ' ', $line));
    // We don't care about which sub game it's from since we just need minimum of each color per line. No need to do
    // extra handling for semicolons, commas, or newlines.
    preg_match_all('/((\d+) (green|blue|red))/', $line, $matches);

    $colorCount = sizeof($matches[0]);

    $redMinimum = 0;
    $greenMinimum = 0;
    $blueMinimum = 0;

    if (DEBUG) {
        echo "Game #$game: \n";
    }

    for ($c = 0; $c < $colorCount; $c++) {
        $color = $matches[3][$c];
        $count = $matches[2][$c];

        if (DEBUG) {
            echo "$count $color, ";
        }

        switch ($color) {
            case 'red':
                if ($count > $redMinimum) {
                    $redMinimum = $count;
                }
                break;
            case 'green':
                if ($count > $greenMinimum) {
                    $greenMinimum = $count;
                }
                break;
            case 'blue':
                if ($count > $blueMinimum) {
                    $blueMinimum = $count;
                }
                break;
        }
    }

    if (DEBUG) {
        echo "\nredMinimum: $redMinimum, greenMinimum: $greenMinimum, blueMinimum: $blueMinimum";
    }

    $power = ($redMinimum * $greenMinimum * $blueMinimum);
    $answer += $power;
    $game++;

    if (DEBUG) {
        echo "\nPower: $power";
    }
    if (DEBUG) {
        echo "\n\n";
    }
}

echo "The sum of all game's power is: " . $answer;