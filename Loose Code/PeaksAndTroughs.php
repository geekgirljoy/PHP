<?php

// Our task is: "Step Detection" in "Time Series" data.
// Given a set of values, detect the peaks and troughs

// A time series dataset
$dataset = array(10, 16, 12, 18, 22, 21, 26, 23, 19, 22, 19, 21, 23, 24, 25, 30, 29, 31, 28, 26, 25, 24, 21, 19, 17);

$peaks_and_troughs = array('begin'); // Tag the starting index at with/as the beginning value/state

// Start at the beginning of $dataset, consider the data point at start+1 and increment until we consider the last data point
for($i = array_key_first($dataset) + 1; $i <= array_key_last($dataset); $i++){
   
   $peaks_and_troughs[$i] = ''; // Transitional value/state - no label
   
   // Determine if $dataset[$i] is a peak
   if($dataset[$i] >= $dataset[$i-1]){
      $peaks_and_troughs[$i] = 'peak';
      
      // Eliminate false positives if the previous index was labeled a peak 
      // but $i is also considered a peak (higher then $i-1), then the previous index
      // was mislabeled.
      if($peaks_and_troughs[$i-1] == 'peak'){
         $peaks_and_troughs[$i-1] = '';
      }
   }
    
   // Determine if $dataset[$i] is a trough
   elseif($dataset[$i] <= $dataset[$i-1]){
      $peaks_and_troughs[$i] = 'trough';
      
      // Eliminate false positives - if the previous index was labeled a trough 
      // but $i is also considered a trough (lower then $i-1), then the previous index
      // was mislabeled.      
      if($peaks_and_troughs[$i-1] == 'trough'){
         $peaks_and_troughs[$i-1] = '';
      }
   }
   
}

var_dump($peaks_and_troughs);



/*
// Results:
array(25) {
  [0]=>
  string(5) "begin"
  [1]=>
  string(4) "peak"
  [2]=>
  string(6) "trough"
  [3]=>
  string(0) ""
  [4]=>
  string(4) "peak"
  [5]=>
  string(6) "trough"
  [6]=>
  string(4) "peak"
  [7]=>
  string(0) ""
  [8]=>
  string(6) "trough"
  [9]=>
  string(4) "peak"
  [10]=>
  string(6) "trough"
  [11]=>
  string(0) ""
  [12]=>
  string(0) ""
  [13]=>
  string(0) ""
  [14]=>
  string(0) ""
  [15]=>
  string(4) "peak"
  [16]=>
  string(6) "trough"
  [17]=>
  string(4) "peak"
  [18]=>
  string(0) ""
  [19]=>
  string(0) ""
  [20]=>
  string(0) ""
  [21]=>
  string(0) ""
  [22]=>
  string(0) ""
  [23]=>
  string(0) ""
  [24]=>
  string(6) "trough"
}
*/

?>
