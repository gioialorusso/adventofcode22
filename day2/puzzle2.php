<?php
$input_file = 'rock_scissor_paper.csv';
$fh = fopen($input_file, 'r');
$my_total_points = 0;

$points = [
    'A X' => 3,
    'A Y' => 4,
    'A Z' => 8,
    'B X' => 1,
    'B Y' => 5,
    'B Z' => 9,
    'C X' => 2,
    'C Y' => 6,
    'C Z' => 7
];

while (($line = fgetcsv($fh)) !== FALSE) {
    $my_total_points += $points[$line[0]];
}

echo $my_total_points;
