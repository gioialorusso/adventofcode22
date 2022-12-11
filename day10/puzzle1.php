<?php

function checkAndEventuallyAccumulateSignalStrenght( $cycle, $x, &$signal_strenght ){
    if(in_array($cycle, [20, 60, 100, 140, 180, 220])){
        $signal_strenght += $cycle * $x;
    }
}

$input_file = 'tree_matrix.txt';
$fh = fopen($input_file, 'r');
$i = 0;

$cycle = 1;
$x = 1;
$add_cycle = 0;
$signal_strenght = 0;


while (($line = fgets($fh)) !== FALSE) {
    $line = explode(" ", $line);
    $cmd = $line[0];
    $arg = rtrim($line[1]);


    if($cmd === 'addx'){
        while ($add_cycle < 2){
            checkAndEventuallyAccumulateSignalStrenght($cycle, $x, $signal_strenght);
            $cycle ++;
            $add_cycle ++;
        }

        $add_cycle = 0;
        $x += $arg;
    }else {
        checkAndEventuallyAccumulateSignalStrenght($cycle, $x, $signal_strenght);
        $cycle++;
    }
}

echo $signal_strenght;


