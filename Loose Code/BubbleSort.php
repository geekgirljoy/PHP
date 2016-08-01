<?php
/*
    An implementation of Bubble Sort on an array of integers.
*/
function BubbleSort($array){
	if(isset($array)) {/* If $array is set */
		$array_length = count($array);
		$sorted = false;
		while(!$sorted){
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
			if($swapped == false) {
				$sorted = true;
			}
		}
		return $array;
	}else {/* $array not set issue message and end program */
		die("No Array! Use: BubbleSort(ARRAY)");
	}
}
$sorted = BubbleSort(array(9,8,7,6,5,1,4,3,2,0));

var_dump($sorted);

echo '<br>' . PHP_EOL;
// Test proofs for provided array 0 - 9
if ($sorted[0] == 0) {
	echo '0 is correct<br>' . PHP_EOL;
}
if ($sorted[1] == 1) {
	echo '1 is correct<br>' . PHP_EOL;
}
if ($sorted[2] == 2) {
	echo '2 is correct<br>' . PHP_EOL;
}
if ($sorted[3] == 3) {
	echo '3 is correct<br>' . PHP_EOL;
}
if ($sorted[4] == 4) {
	echo '4 is correct<br>' . PHP_EOL;
}
if ($sorted[5] == 5) {
	echo '5 is correct<br>' . PHP_EOL;
}
if ($sorted[6] == 6) {
	echo '6 is correct<br>' . PHP_EOL;
}
if ($sorted[7] == 7) {
	echo '7 is correct<br>' . PHP_EOL;
}
if ($sorted[8] == 8) {
	echo '8 is correct<br>' . PHP_EOL;
}
if ($sorted[9] == 9) {
	echo '9 is correct<br>' . PHP_EOL;
}


?>