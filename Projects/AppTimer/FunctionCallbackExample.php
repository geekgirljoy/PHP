<?php
 
include('AppTimer.Class.php');   // Include AppTimer class file

// Example Function to Time
function ExampleCountFunction($count_to = 1000000, $message = 'No Message Was Specified.'){
	$report_at = round($count_to / 2);
	// iterate $i from 0 to $count_to and echo $message at 1/2 way
	for($i=0;$i<$count_to;$i++){
		if($i == $report_at){
			echo $message . PHP_EOL;
		}
	}
}


$Timer = new AppTimer(); // New Timer Object


// No need to Start, Auto Start, or Report() with CallbackTimer()
echo $Timer->CallbackTimer('ExampleCountFunction') . PHP_EOL; // No Arguments
echo $Timer->CallbackTimer('ExampleCountFunction', array(6543210, 'Geek Girl Joy')) . PHP_EOL; // Has Arguments



// Destroy $Timer Object
$Timer = NULL; // Reclaim memory immediately by overwriting NULL on Timer object's memory space                  
unset($Timer); // Let Garbage Collection know it can eat the variable


