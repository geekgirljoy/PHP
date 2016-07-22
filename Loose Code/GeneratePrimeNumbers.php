<?php
set_time_limit ( 3600 ); // max run time 1 hour (adjust as needed)

// No Limit to memory, unless computing a huge number
// of primes this won't be an issue as this is mainly
// a CPU intensive process but to be safe I am giving
// the code an "unlimited" work space.
ini_set('memory_limit', '-1');


function isprime($num){
    if($num == 1){return false;}     // 1 is not prime.
    if($num == 2){return true;}      // 2 is prime (the only even number that is prime)
    if($num % 2 == 0){return false;} // If the number is divisible by two (therefore an even number) it's not prime

    //  Checks odd numbers for primality.
    for($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2){
        if($num % $i == 0){return false;}
    }
    return true; // I found a prime number! :-)
}

// Is $num equal to $expected) test and report
function test($num, $expected){
    $output = PHP_EOL ."<br>Recieved: $num." . PHP_EOL . "<br>Expected: $expected". PHP_EOL . "<br>Result: ";
    $output .= ($num == $expected) ? "Passed Test" : "Failed Test";
    return $output;
}

$min = 0;               // Number to start with
$max = 100;             // Number of primes to generate (should end on the 1 millionth prime 15,485,863)
$curr_num = $min;       // The current number to check if prime
$prime_stack = array(); // Found primes are stored here

echo "Generating $max Prime Numbers Beginning at: $min <br>" . PHP_EOL;


while (count($prime_stack) < $max){
    if (isprime($curr_num)){
    	array_push($prime_stack, $curr_num); // Place the prime in the $prime_stack array
        echo $curr_num; // all hail the new found prime!
	if (count($prime_stack) < $max-1){echo ", ";} // not last number so echo comma because it's prettier to look at
    }
    $curr_num++; // Increment the $curr_num variable so we can check the next number for primality
}

// All done! Do test to make sure the computed output matches our expected KGV (Known Good Value)
echo test($prime_stack[$max-1], 15485863); // The  1,000,000 prime number is 15,485,863
?>
