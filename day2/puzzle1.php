<?php
$input_file = 'rock_scissor_paper.csv';
$fh = fopen($input_file, 'r');
$my_total_points = 0;
$rock_points = 1;
$paper_points = 2;
$scissor_points = 3;

$lost_points = 0;
$even_points = 3;
$win_points = 6;

while (($line = fgetcsv($fh)) !== FALSE) {
    
    $line = explode(" ", $line[0]);

    switch($line[0]) {
        case 'A':
            //l'avversario gioca rock
            switch ($line[1]) {
                case 'X':
                    //devo perdere:
                    $my_total_points += $rock_points;
                    $my_total_points += $even_points;
                    break;
                case 'Y':
                    //io ho giocato paper quindi prendo 2 di default e vinco
                    $my_total_points += $paper_points;
                    $my_total_points += $win_points;
                    break;
                case 'Z':
                    //io ho giocato scissors quindi prendo 3 di default e perdo
                    $my_total_points += $scissor_points;
                    $my_total_points += $lost_points;
                    break;
            }
            break;
        case 'B':
            //l'avversario gioca paper
            switch ($line[1]) {
                case 'X':
                    //io ho giocato rocks quindi prendo 1 di default e perdo
                    $my_total_points += $rock_points;
                    $my_total_points += $lost_points;
                    break;
                case 'Y':
                    //io ho giocato paper quindi prendo 2 di default ed è even
                    $my_total_points += $paper_points;
                    $my_total_points += $even_points;
                    break;
                case 'Z':
                    //io ho giocato scissors quindi prendo 3 di default e vinco
                    $my_total_points += $scissor_points;
                    $my_total_points += $win_points;
                    break;
            }
            break;
        case 'C':
            //l'avversario gioca scissor
            switch ($line[1]) {
                case 'X':
                    //io ho giocato rocks quindi prendo 1 di default e vinco
                    $my_total_points += $rock_points;
                    $my_total_points += $win_points;
                    break;
                case 'Y':
                    //io ho giocato paper quindi prendo 2 di default e perdo
                    $my_total_points += $paper_points;
                    $my_total_points += $lost_points;
                    break;
                case 'Z':
                    //io ho giocato scissors quindi prendo 3 di default ed è even
                    $my_total_points += $scissor_points;
                    $my_total_points += $even_points;
                    break;
            }
            break;
    }

}

echo $my_total_points;
