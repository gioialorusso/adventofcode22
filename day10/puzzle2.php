<?php

function drawPixel( $sprite_position, $pixel_num ){
    $newline = "";
    if((($pixel_num + 1) % 40) === 0){
        $newline = "<br/>";
    }
    $pixel_num = $pixel_num % 40;
    if( in_array($pixel_num, [$sprite_position - 1, $sprite_position, $sprite_position + 1])){
        return "#".$newline;
    }else{
        return ". ".$newline;
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
            echo drawPixel($x, $cycle - 1);
            $cycle ++;
            $add_cycle ++;
        }

        $add_cycle = 0;
        $x += $arg;
    }else {
        echo drawPixel($x, $cycle - 1);
        $cycle++;
    }
}



