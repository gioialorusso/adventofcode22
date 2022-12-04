$input_file = 'cleaning.csv';
$fh = fopen($input_file, 'r');
$range_contained = 0;
while (($line = fgetcsv($fh)) !== FALSE) {
    $range_first_elf = range(explode("-", $line[0])[0], explode("-", $line[0])[1]);
    $range_second_elf = range(explode("-", $line[1])[0], explode("-", $line[1])[1]);
    if(!array_diff($range_first_elf, $range_second_elf) || !array_diff($range_second_elf, $range_first_elf)){
        $range_contained ++;
    }
}

echo $range_contained;
