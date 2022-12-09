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

$visible_trees = 0;
foreach($tree_matrix as $row_index => $row ){

    foreach ($row as $column_index => $cell) {
        if($row_index === 0){
            $visible_trees ++;
            continue;
        }
        if($column_index === 0 || $column_index === (count($row) - 1)){
            $visible_trees ++;
            continue;
        }
        //first I check left
        $left_visibility = 1;
        for($left = $column_index - 1; $left >= 0; $left --){
            if($row[$left] >= $cell){
                $left_visibility = 0;
                break;
            }
        }

        if($left_visibility){
            $visible_trees ++;
            continue;
        }

        //then I check up
        $upper_visibility = 1;
        for($up = $row_index - 1; $up >= 0; $up --){
            if($tree_matrix[$up][$column_index] >= $cell){
                $upper_visibility = 0;
                break;
            }
        }

        if($upper_visibility){
            $visible_trees ++;
            continue;
        }
        //then I check down
        $down_visibility = 1;
        for($down = $row_index + 1; $down < count($tree_matrix); $down ++){
            if($tree_matrix[$down][$column_index] >= $cell){
                $down_visibility = 0;
                break;
            }
        }

        if($down_visibility){
            $visible_trees ++;
            continue;
        }

        //then I check right
        $right_visibility = 1;
        for($right = $column_index + 1; $right < count($row); $right ++){
            if($row[$right] >= $cell){
                $right_visibility = 0;
                break;
            }
        }

        if($right_visibility){
            $visible_trees ++;
        }

    }

}
echo $visible_trees;

