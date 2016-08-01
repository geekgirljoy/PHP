<?php
/*
    An implementation of BogoSort on an array of integers.
	
	https://en.wikipedia.org/wiki/Bogosort
	
	This "sort" is basiclly the worst sort possible and ammounts to random reordering
	
	DO NOT USE THIS SORTING FUNCTION - IT IS A DEOMNSTRATION OF WHAT >>>NOT<<< TO DO
	
	
	
*/
function BogoSort($array) {
	/* If $array is set */
	if(isset($array)) { 
	    $array_length = count($array); /* get array length */
		$num_of_shuffles = 0;
		/* while $array is NOT in order */
		while(!isInOrder($array, $array_length)) {
			/* shuffle $array */
			shuffle($array);
			$num_of_shuffles++;
			echo "Shuffle: " . $num_of_shuffles . '<br>' . PHP_EOL;
		}
		return $array;
	}else {/* $array not set issue message and end program */
		die("No Array! Use: BogoSort(ARRAY)");
	}
}

function isInOrder($array, $array_length) {
	for($i = 1; $i < $array_length; $i++) {
		/* If the value to the left of this value is greator */
		if($array[$i -1] > $array[$i]) {
			return false;/* than return false because the list is not in order*/
		}
	}
	return true; /* $array is in order */
}


set_time_limit ( 3600 ); // max run time 1 hour (adjust as needed)

$sorted = BogoSort(array(5,1,4,3,2,0));

var_dump($sorted);

echo '<br>' . PHP_EOL;
// Test proofs for provided array 0 - 5
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
?>