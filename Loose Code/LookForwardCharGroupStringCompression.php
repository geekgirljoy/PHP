<?php

/*

With a $group_threshold of 3 or more process these strings to output the example results:

Given this (case sensitive) string: AAaaBaCGGGGSTDSSSDDGCMM
Return this result: AAaaBaC4GSTD3SDDGCMM

Given this (case insensitive) string: AAaaBaCGGGGSTDSSSDDGCMM
Return this result: 4ABAC4GSTD3SDDGCMM

Given this (case sensitive) string: wzzzZZZZZWXXXXyYyW
Return this result: w3z5ZW4XyYyW

Given this (case insensitive) string: wzzzZZZZZWXXXXyYyW
Return this result: W8ZW4X3YW



Actual (case sensitive) output:

Original: wzzzZZZZZWXXXXyYyW
Compressed: w3z5ZW4XyYyW
Uncompressed (from group data): wzzzZZZZZWXXXXyYyW
Uncompressed (from compressed string): wzzzZZZZZWXXXXyYyW

String compressed and decompressed successfully.



*/


//String Test examples:
$chars = 'AAaaBaCGGGGSTDSSSDDGCMM'; // chars is a string
$chars = 'wzzzZZZZZWXXXXyYyW';

$group_threshold = 3; // Less than 3 is unwise
                      // 2 i.e. AA would be encoded as 2A so you save nothing
                      // and a threshold of 1 is going to grow rather than
                      // compress the string i.e. A would be encoded as 1A 
                      // So a string of ABCDEFG would result in a string
                      // that is 100% longer (double length) : 1A1B1C1D1E1F1G

// String Case Sensitivity Options
define("NO_SENSITIVITY_UPPERCASE", 0); // No Case Sensitivity Convert to Upper Case
define("NO_SENSITIVITY_LOWERCASE", 1); // No Case Sensitivity Convert to Lower Case
define("CASE_SENSITIVE", 2); // Preserve Case as it exists in the string

// Pick a string processing case sensitivity
$case_sensitivity = CASE_SENSITIVE;

if($case_sensitivity === NO_SENSITIVITY_UPPERCASE){
    $chars = strtoupper($chars); // Convert to Upper Case
}
elseif($case_sensitivity === NO_SENSITIVITY_LOWERCASE){
    $chars = strtolower($chars); // Convert to Lower Case
}
elseif($case_sensitivity === CASE_SENSITIVE){
    // Do any case sensitive pre-processing here
}
else{
    die('You selected an invalid string case sensitivity.' . PHP_EOL);
}

echo 'Original: ' . $chars . PHP_EOL;
$chars_original = $chars;

// Split the $chars string
$chars = str_split($chars); // $chars is now an array containing 
                            // each char as an element

$groups = array(); // Combined chars go here as an array of arrays of chars
$group = 0; // The index position of the current char group

// Count how long the $chars array is
$number_of_chars = count($chars);

// Group the chars
foreach($chars as $key=>$char){ // For all the Chars
    
    // Add this char to the current group
    $groups[$group][] = $char; 
    
    // If this is not the last char
    if($key < $number_of_chars){
        
        // Check if the current char 
        // Is not same as the next char
        if($char != @$chars[$key+1]){
            // The char to the right of this char
            // is not the same as this char
            // so when the foreach proceeds
            // we want the next char to be added
            // to a different group
            $group++; // next group
        }
    }
}

// Count and echo the "compressed" char groups
echo 'Compressed: ';
$compressed_chars = '';
foreach($groups as $key=>$group){
    
    $number_of_times_repeated = count($group);
    
    // If the number of times this char group repeated 
    // is greater or equal to the $group_threshold value
    if($number_of_times_repeated >= $group_threshold){
        // Example ($group_threshold < 4) AAAA = 4A
		$compressed_chars .= $number_of_times_repeated . $group[0];
    }
    else{
        // Example ($group_threshold > 2) AA = AA
        $compressed_chars .= str_repeat($group[0], $number_of_times_repeated); 
    }
}
echo $compressed_chars . PHP_EOL;


// Rebuild "uncompress" the "compressed" char groups
// back to the original string
echo 'Uncompressed (from group data): '; 
$uncompressed_chars_from_groups = '';
foreach($groups as $key=>$group){
	$uncompressed_chars_from_groups .= str_repeat($group[0], count($group)); 
}
echo $uncompressed_chars_from_groups . PHP_EOL;


// Rebuild "uncompress" the "compressed" char string
// back to the original string
echo 'Uncompressed (from compressed string): ';
$compressed_chars = str_split($compressed_chars);
$compressed_chars_length = count($compressed_chars);
$uncompressed_chars_from_string = '';
foreach($compressed_chars as $key=>$char){
    
    // If the char to the left is not a number
    if(!is_numeric(@$compressed_chars[$key-1])){
        // If this char is a number
        if(is_numeric($char)){
			
			// keep checking to the right in case number is > 9
			$i = 0;
			$number = '';
			
			while(is_numeric(@$compressed_chars[$key+$i]) && ($key+$i) <= $compressed_chars_length){
				$number .= $compressed_chars[$key+$i]; // Concatenate the char onto a number string
				$i++;
			}
			$uncompressed_chars_from_string .= str_repeat($compressed_chars[$key+$i], (int) $number);
			
        }
        else{ 
            // This char is a symbol or letter representing itself only
            $uncompressed_chars_from_string .= $char;
        }
    }
}
echo $uncompressed_chars_from_string . PHP_EOL;

// If the backup of the original string matches the
// string generated by decompressing the group data held in memory
// and the string generated decompressing the compressed string
if($chars_original === $uncompressed_chars_from_string
    && $chars_original === $uncompressed_chars_from_groups){
	// Everything is working correctly
	echo PHP_EOL . "String compressed and decompressed successfully.". PHP_EOL;
}
else{
	// Something isn't working
	echo "You broke it you fix it! :-P". PHP_EOL; 
}
