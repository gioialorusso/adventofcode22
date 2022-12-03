$input_file = 'rucksack.csv';
$fh = fopen($input_file, 'r');
$total_priority = 0;
$letter_priority_lowercase = range('a', 'z');
$letter_priority_uppercase = range('A', 'Z');
$elves_items = [];
$i = 1;

while (($line = fgetcsv($fh)) !== FALSE) {
    $elves_items[] = str_split($line[0]);
    if($i%3 === 0){
        $common = implode(array_unique(array_intersect(...$elves_items)));
        $total_priority += ctype_lower($common) ? array_search($common, $letter_priority_lowercase) + 1 : array_search($common, $letter_priority_uppercase) + 27;
        $elves_items = [];
    }
    $i++;

}

echo $total_priority;
