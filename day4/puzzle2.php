$input_file = 'cleaning.csv';
$fh = fopen($input_file, 'r');
$overlaps = 0;
while (($line = fgetcsv($fh)) !== FALSE) {
    $range_first_elf = range(explode("-", $line[0])[0], explode("-", $line[0])[1]);
    $range_second_elf = range(explode("-", $line[1])[0], explode("-", $line[1])[1]);
    if(array_intersect($range_first_elf, $range_second_elf) || array_intersect($range_second_elf, $range_first_elf)){
        $overlaps ++;
    }
}

echo $overlaps;
