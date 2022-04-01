<?php
/*
    An implementation of Bubble Sort on an array of integers.
*/
function BubbleSort($array){
    if(isset($array) && is_array($array)) {/* If $array is set */
        $array_length = count($array);
        do{
            $swapped = false;
            for($i = 1; $i < $array_length; $i++) {
                /* Is the number to the left of this number larger?...  */
                if ($array[$i-1] > $array[$i]) {
                    /* Yes - so swap them */
                    $larger=$array[$i-1];
                    $array[$i-1]=$array[$i];
                    $array[$i]=$larger;
                    $swapped = true;
                }
            }

        }while($swapped == true);
        
		return $array;
		
    }
	
	// $array not set issue message and end program
    die("No Array! Use: BubbleSort(ARRAY)");
}
$sorted = BubbleSort(array(9,8,7,6,5,1,4,3,2,0));
var_dump($sorted);

echo '<br>' . PHP_EOL;

for($i = 0; $i <= 9; $i++){
    if ($sorted[$i] == $i) {
    echo "$i is correct<br>" . PHP_EOL;
    }
}
?>
