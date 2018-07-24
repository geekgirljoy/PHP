<?php
set_time_limit(0); // Disable the time limit on script execution

// Create Breaker Class 
//
// This tool is a demonstration of a "brute force" password breaker.
// This prototype is provided AS IS and for informational & educational
// purposes only! 
//
// Modern Password Hashing should have little fear of this code though
// for a minimum level of rationality I have excluded the parts that 
// would handle hashing the passwords to slow down the "Script Kiddies" 
// however any reasonably skilled PHP developer would have little trouble 
// adding their own hashing function to complete this prototype.
// 
// DO NOT USE THIS SOFTWARE TO VIOLATE THE LAW! COMPLY WITH ALL DIRECTION
// GIVEN TO YOU BY LAW ENFORCEMENT! ANY ILLEGAL OR MALICIOUS ACTIONS YOU 
// CHOOSE TO ENGAGE IN OUTSIDE OF AN EDUCATIONAL SETTING ARE YOUR OWN! 
class Breaker{

	function GetSymbols($values, &$symbols){
		foreach($values as $key=>&$value){
			if(isset($symbols[$value])){
				$value = $symbols[$value];
			}
		}
		return $values;
	}

	function IncrementValues($values, $number_of_valid_symbols){
		foreach($values as $key=>&$value){
			// If this value is maxed
			if($values[$key] >= $number_of_valid_symbols){
				// Reset it to 0 and increment the next value
				$values[$key] = 0; // Reset this value
				if(!isset($values[$key+1])){
					$values[$key+1] = '0';
				}else{
					$values[$key+1]++; // Reset this value
				}
			}
			else{
				// If key greater than 0
				if($key > 0){
					if($values[$key-1]>$number_of_valid_symbols){
						// Increment this value
						$values[$key]++;
					}
				}
				else{
					// Always Increment this value
					$values[$key]++;
				}
			}			
		}
		return $values;
	}

	function Match($hash, $test_password){
		
		$test_hash = $test_password; // HASH $test_password here 
		
		if($test_hash == $hash){
		  return true;
		}
		return false;
	}

}



include('AppTimer.Class.php');     // Include AppTimer class file

$Timer = new AppTimer();           // Create Timer
$Timer->Start();                   // Start() Timer


$password_to_break = 'Cat'; // Change this to the password hash 
                            // you want to break once you add hashing

// Concatenate all symbols explicitly
//$valid_symbols = "!\"#$%&'()*+,-./0123456789:;<=>?@"; // note the escaped double quote
//$valid_symbols .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`";
//$valid_symbols .= "abcdefghijklmnopqrstuvwxyz{|}~";
//$valid_symbols = str_split($valid_symbols); // split string into array

// Cleaner way to Create array of ASCII char 33 - 126
$valid_symbols = range(chr(33), chr(126)); // Shorter version of above
$number_of_valid_symbols = count($valid_symbols); // 94 chars

$length = 1; // Start at 1 digit length to try all possible combinations
             // This assumes the password length is unknown.
// If the length of the password is known then use the correct length i.e:
// $length = strlen($password_to_break); 
                                       
// Generate first plain text password to try
$values = str_split(strrev(str_repeat('0', $length)));
$PlainTextPasswordBreaker = new Breaker();
$test_password = $PlainTextPasswordBreaker->GetSymbols($values, $valid_symbols);

while(!$PlainTextPasswordBreaker->Match($password_to_break, $test_password)){
	// We have not found the correct password so keep trying to generate it
	$values = $temp = $PlainTextPasswordBreaker->IncrementValues($values, $number_of_valid_symbols);
	$temp = $PlainTextPasswordBreaker->GetSymbols($values, $valid_symbols);
	$test_password = strrev(implode('', $temp));
	
	//echo $test_password . PHP_EOL; // Uncomment to watch breaker
	                               // Will make Breaker much slower
}


$Timer->Stop();             // Stop() Timer
$time = $Timer->Report();   // Report()


echo "Password: $test_password \nFound in: $time" . PHP_EOL;


