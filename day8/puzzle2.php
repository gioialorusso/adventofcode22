<?php

$input_file = 'tree_matrix.txt';
$fh = fopen($input_file, 'r');
$i = 0;
$lines = count(file($input_file));
$tree_matrix = [];

while (($line = fgets($fh)) !== FALSE) {
    $line = rtrim($line);
    for( $j = 0; $j < (strlen($line)); $j++ ){
        $tree_matrix[$i][$j] = (int)$line[$j];
    }
    $i++;
}

$top_scenic_score = 0;

foreach($tree_matrix as $row_index => $row ){


    foreach ($row as $column_index => $cell) {
        $scenic_score = 0;

        if($row_index === 0){
            continue;
        }
        if($column_index === 0 || $column_index === (count($row) - 1)){
            continue;
        }
        //first I check left
        $scenic_score_left = 0;
        for($left = $column_index - 1; $left >= 0; $left --){
            $scenic_score_left ++;
            if($row[$left] >= $cell){
                break;
            }
        }
        //then I check up
        $scenic_score_up = 0;
        for($up = $row_index - 1; $up >= 0; $up --){
            $scenic_score_up ++;
            if($tree_matrix[$up][$column_index] >= $cell){
                break;
            }
        }

        //then I check down
        $scenic_score_down = 0;
        for($down = $row_index + 1; $down < count($tree_matrix); $down ++){
            $scenic_score_down ++;
            if($tree_matrix[$down][$column_index] >= $cell){
                break;
            }
        }

        //then I check right
        $scenic_score_right = 0;
        for($right = $column_index + 1; $right < count($row); $right ++){
            $scenic_score_right ++;
            if($row[$right] >= $cell){
                break;
            }
        }

        $scenic_score = $scenic_score_left*$scenic_score_up*$scenic_score_down*$scenic_score_right;
        if($scenic_score > $top_scenic_score){
            $top_scenic_score = $scenic_score;
        }

    }

}
echo $top_scenic_score;

