<?php
/*
Sum all the numbers of the array except the highest and the lowest element (the value, not the index!).
(Only one element at each edge, even if there are more than one with the same value!)

If array is empty, null or None, or if only 1 Element exists, return 0.

*/
function sumArray($array) {
    $return = 0;                     // set default return to 0
    if(count($array) > 1 && $array != null){
        sort($array);                // sort low to high
        array_shift($array);         // remove first element in $array
        array_pop($array);           // remove last element in $array
        $return = array_sum($array); // sum the remaining array values
    }
    return $return;                  // return $return
}



echo sumArray(array(6, 2, 1, 8, 10));  // 16

echo '<br>';

echo sumArray(array(1, 1, 11, 2, 3 ));  // 6

?>
