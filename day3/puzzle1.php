$input_file = 'rucksack.csv';
$fh = fopen($input_file, 'r');
$total_priority = 0;
$letter_priority_lowercase = range('a', 'z');
$letter_priority_uppercase = range('A', 'Z');

while (($line = fgetcsv($fh)) !== FALSE) {
    $items = str_split($line[0], strlen($line[0])/2);
    $single_items_compartment_1 = str_split($items[0]);
    $single_items_compartment_2 = str_split($items[1]);
    $common = implode(array_unique(array_intersect($single_items_compartment_1, $single_items_compartment_2)));
    $total_priority += ctype_lower($common) ? array_search($common, $letter_priority_lowercase) + 1 : array_search($common, $letter_priority_uppercase) + 27;
}

echo $total_priority;
