$input_file = 'marker.txt';
$fh = fopen($input_file, 'r');
$marker_length = 14;

while (($line = fgets($fh)) !== FALSE) {
    $marker = [];
    for ($i = 0; $i < strlen($line); $i++){
        for ($j = 0; $j < $marker_length; $j++){
            $marker[] = $line[$i + $j];
        }
        if(count(array_unique($marker)) === $marker_length){
            echo $i + $marker_length;
            break;
        }
        $marker = [];
    }
}
