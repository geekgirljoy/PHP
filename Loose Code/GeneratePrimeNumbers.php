<?php
set_time_limit ( 3600 ); // max run time 1 hour (adjust as needed)

// No Limit to memory, unless computing a huge number
// of primes this won't be an issue as this is mainly
// a CPU intensive process but to be safe I am giving
// the code an "unlimited" work space.
ini_set('memory_limit', '-1');


function isprime($num)
{
    if($num == 1){return false;}     //1 is not prime.
    if($num == 2){return true;}      //2 is prime (the only even number that is prime)
    if($num % 2 == 0){return false;} // If the number is divisible by two it's not prime

    //  Checks odd numbers for primality.
    for($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2)
    {
        if($num % $i == 0){return false;}
    }
    return true;
}

function test($num, $expected){
    // test
	echo "<br>Recieved $num.<br>Expected $expected". PHP_EOL;
    if($num == $expected){return "<br>Passed Test" . PHP_EOL;}
    else{return "<br>Failed Test" . PHP_EOL;}
}

$min = 0;               // Number to start with
$max = 1000000;         // Number of primes to generate (should end on the 1 millionth prime 15,485,863)
$curr_num = $min;       // The current number to check if prime
$prime_stack = array(); // Found primes are stored here

echo "Generating $max Prime Numbers Beginning at: $min <br>" . PHP_EOL;


while (count($prime_stack) < $max)
{
    if (isprime($curr_num))
    {
        echo $curr_num;
		if (count($prime_stack) < $max-1){echo ", ";} // not last so add comma to output
        array_push($prime_stack, $curr_num);
    }
    $curr_num++;
}


echo test($prime_stack[$max-1], 15485863);
   
   
?>