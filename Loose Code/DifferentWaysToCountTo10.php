<?php

/*

Demonstrate several different ways to count to 10

Results:

Count to 10 using an incrementing for loop:
0 1 2 3 4 5 6 7 8 9 10

Count to 10 using a constant value and a decrementing for loop:
0 1 2 3 4 5 6 7 8 9 10

Count to 10 using a foreach and a range array:
0 1 2 3 4 5 6 7 8 9 10

Count to 10 using a while loop:
0 1 2 3 4 5 6 7 8 9 10

Count to 10 using a do while loop:
0 1 2 3 4 5 6 7 8 9 10

Count to 10 using a class and a recursive method and a referenced variable:
0 1 2 3 4 5 6 7 8 9 10


*/



$output = 'Count to 10 using an incrementing for loop: ' . PHP_EOL;
for($i = 0; $i <= 10; $i++){
    $output .= "$i ";
}
echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10

$output = 'Count to 10 using a constant value and a decrementing for loop: '. PHP_EOL;
const n = 10;
for($i = 10; $i >= 0; $i--){
    $output .= n - $i . ' ';
}
echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10


$output = 'Count to 10 using a foreach and a range array: ' . PHP_EOL;
foreach(range(0, 10, 1) as $i){
    $output .= "$i ";
}
echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10


$output = 'Count to 10 using a while loop: ' . PHP_EOL;
$i = 0;
while($i <= 10){
    $output .= $i++ . ' ';
}
echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10


$output = 'Count to 10 using a do while loop: ' . PHP_EOL;
$i = 0;
do{
    $output .= $i++ . ' ';
}while($i <= 10);

echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10


// unset and garbage collect output
$output = NULL;
unset($output);


class RecursiveCounter{
    private $current_count = 0;
    private $start = 0;
    private $stop = 0;
    
    private $result = '';
    
    function __construct($start = 0, $stop = 0, &$results){
        
        if(!is_numeric($this->start) || !is_numeric($this->stop)){
            die('Invalid count range' . PHP_EOL);
        }

        $this->start = $start;
        $this->current_count = $this->start;
        $this->stop = $stop;
        $this->RecursiveCount();    
                
        $results = $this->result;
    }
    

    private function RecursiveCount(){
        $this->result .= $this->current_count . ' ';
        
        $recurse = false; 
        
        if($this->start < $this->stop &&
           $this->current_count <= $this->stop){
            $this->current_count++;
            
            if($this->start < $this->stop &&
               $this->current_count <= $this->stop){
               $recurse = true; 
           }
            
            
        }elseif($this->start > $this->stop &&
           $this->current_count >= $this->stop){
            $this->current_count--;
            
            if($this->start > $this->stop &&
               $this->current_count >= $this->stop){
               $recurse = true; 
           }
        }
        
        if($recurse){
            // Recurse
            $this->RecursiveCount();
        }
    }
}

echo 'Count to 10 using a class and a recursive method and a referenced variable: ' . PHP_EOL;
$counter = new RecursiveCounter(0, 10, $output); // $output is empty and is the referenced variable
echo $output . PHP_EOL . PHP_EOL; // 0 1 2 3 4 5 6 7 8 9 10
