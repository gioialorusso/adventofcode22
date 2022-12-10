<?php

class EuclideanDistance{

    public static function calc(Knot $head, Knot $tail){
        return sqrt( pow($tail->getX() - $head->getX(), 2) + pow($tail->getY() - $head->getY(), 2));

    }
}

class Knot{
    protected $x;
    protected $y;

    public function getX(): int{
        return $this->x;
    }

    public function getY(): int{
        return $this->y;
    }

    public function __construct( int $x, int $y ){
        $this->x = $x;
        $this->y = $y;
    }

    public function move( string $direction ){
        switch( $direction ){
            case 'R':
                $this->x ++;
                break;
            case 'L':
                $this->x --;
                break;
            case 'U':
                $this->y ++;
                break;
            case 'D':
                $this->y --;
                break;
        }
    }
}

class PositionTrackingKnot extends Knot{
    private $visited_positions = [];

    public function __construct(int $x, int $y)
    {
        parent::__construct($x, $y);
        $this->visited_positions[0][0] = 1;
    }

    public function move(string $direction)
    {
        parent::move($direction);
        $this->addVisitedPosition($this->getX(), $this->getY());
    }

    public function addVisitedPosition( int $x, int $y ){
        if(!isset($this->visited_positions[$x][$y])){
            $this->visited_positions[$x][$y] = 1;
        }
    }

    public function countVisitedPositions(){
        return array_sum(array_map("count", $this->visited_positions));

    }

    private function moveDiagonally( Knot $head ){
        if($head->getY() > $this->getY()){
            $this->y ++;
        }elseif($head->getY() < $this->getY()){
            $this->y --;
        }

        if($head->getX() > $this->getX()){
            $this->x ++;
        }elseif($head->getX() < $this->getX()){
            $this->x --;
        }
        $this->addVisitedPosition($this->getX(), $this->getY());
    }

    public function follow( Knot $head, string $direction ){
        $distance = EuclideanDistance::calc($head, $this);
        if($distance > 1.5){
            $this->moveDiagonally($head);
        }

    }
}

$input_file = 'tree_matrix.txt';
$fh = fopen($input_file, 'r');
$i = 0;

$head = new Knot(0, 0);
for($i = 0; $i < 9; $i ++) {
    $tails[$i] = new PositionTrackingKnot(0, 0);
}

while (($line = fgets($fh)) !== FALSE) {
    $line = explode(" ", $line);
    $direction = $line[0];
    $distance = rtrim($line[1]);


    for($i = 0; $i < $distance; $i++){
        $head->move($direction);
        $head_to_follow = $head;

        foreach($tails as $t => $tail) {
            $tail->follow($head_to_follow, $direction);
            $head_to_follow = $tail;
        }
    }

}

$last_tail = array_pop($tails);
echo $last_tail->countVisitedPositions();


