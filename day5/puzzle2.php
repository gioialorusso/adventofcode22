$input_file = 'crates.txt';
$fh = fopen($input_file, 'r');

$crates = [
    1 => ['S', 'C', 'V', 'N'],
    2 => ['Z', 'M', 'J', 'H', 'N', 'S'],
    3 => ['M', 'C', 'T', 'G', 'J', 'N', 'D'],
    4 => ['T', 'D', 'F', 'J', 'W', 'R', 'M'],
    5 => ['P', 'F', 'H'],
    6 => ['C', 'T', 'Z', 'H', 'J'],
    7 => ['D', 'P', 'R', 'Q', 'F', 'S', 'L', 'Z'],
    8 => ['C', 'S', 'L', 'H', 'D', 'F', 'P', 'W'],
    9 => ['D', 'S', 'M', 'P', 'F', 'N', 'G', 'Z']
];
while (($line = fgets($fh)) !== FALSE) {
    $instructions = explode(" ", $line);
    $to_be_moved = (int)$instructions[1];
    $from = (int)$instructions[3];
    $to = (int)$instructions[5];
    $crate_pile = [];
    while( $to_be_moved > 0 ){
        $crate_pile[] = array_pop($crates[$from]);
        $to_be_moved --;
    }
    $crate_pile = array_reverse($crate_pile);
    array_push($crates[$to], ...$crate_pile);

}

foreach($crates as $crate){
    echo array_pop($crate);
}
