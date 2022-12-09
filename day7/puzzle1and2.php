function starts_with($haystack, $needles)
{
    foreach ((array) $needles as $needle) {
        if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
            return true;
        }
    }
    return false;
}

function calcSum( Node $root ){
    $sum = 0;
    foreach($root->getChildren() as $child){
        $sum += calcSum( $child );
    }

    if($root->getSize() <= 100000 ){
        $sum += $root->getSize();
    }
    return $sum;
}


function calcSmallestDirToDelete(Node $root, $space_needed, &$dirs = []){
    foreach($root->getChildren() as $child){
        calcSmallestDirToDelete( $child, $space_needed, $dirs );
    }
    if($root->getSize() >= $space_needed ){
        $dirs[] = $root->getSize();
    }
}

class Node{

    private $parent;
    private $children = [];
    private $node_name;
    private $size = 0;

    public function __construct(string $node_name){
        $this->node_name = $node_name;
    }
    public function getNodeName(): string{
        return $this->node_name;
    }
    public function setParent( Node $parent ){
        $this->parent = $parent;
    }
    public function getParent(): ?Node{
        return $this->parent;
    }
    public function addChild(Node $child, string $child_name){
        $this->children[$child_name] = $child;
    }
    public function getChild( $child_name ): Node{
        return $this->children[$child_name];
    }
    public function addSize( int $size ){
        $this->size += $size;
    }
    public function getSize(): int{
        return $this->size;
    }
    public function getChildren(): array{
        return $this->children;
    }
}

$input_file = 'cmd.txt';
$file = new SplFileObject($input_file);

$folders_structure = [];
$root = null;
$current_node_pointer = $root;

while ($file->valid()) {
    $line = rtrim($file->current());
    switch($line[0]){
        case '$':
            //it's a command
            switch($line[2].$line[3]) {
                //which kind of command?
                case 'cd':
                    $cd_folder = explode(" ", $line)[2];
                    if( $cd_folder === '/' ){
                        $root = new Node($cd_folder);
                        $current_node_pointer = $root;
                    }elseif( $cd_folder === '..' ){
                        $current_node_pointer = $current_node_pointer->getParent();
                    }else{
                        $current_node_pointer = $current_node_pointer->getChild($cd_folder);
                    }
                    $file->next();
                    break;
                case 'ls':
                    //read files until $
                    $file->next();
                    $ls_output = $file->current();
                    while (!starts_with($ls_output, '$') && $ls_output) {
                        if (starts_with($ls_output, 'dir')) {
                            $folder_name = rtrim(explode(" ", $ls_output)[1]);
                            $child = new Node($folder_name);
                            $child->setParent($current_node_pointer);
                            $current_node_pointer->addChild($child, $child->getNodeName());
                        } else {
                            $file_size = (int)explode(" ", $ls_output)[0];
                            $current_node_pointer->addSize($file_size);
                            $parent_iterator = $current_node_pointer->getParent();
                            while($parent_iterator){
                                $parent_iterator->addSize($file_size);
                                $parent_iterator = $parent_iterator->getParent();
                            }
                        }
                        $file->next();
                        $ls_output = $file->current();
                    }
                    break;
            }
        break;
    }
}



echo calcSum($root);


$space_free = 70000000 - $root->getSize();
$space_needed = 30000000 - $space_free;

$dirs = [];

calcSmallestDirToDelete($root, $space_needed, $dirs);

echo "<br/>" . min($dirs);
