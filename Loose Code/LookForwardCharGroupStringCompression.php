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


*/


// String Test Examples:
$chars = 'AAaaBaCGGGGSTDSSSDDGCMM'; // chars is a string
//$chars = 'wzzzZZZZZWXXXXyYyW';

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
foreach($groups as $key=>$group){
    
    $number_of_times_repeated = count($group);
    
    // If the number of times this char group repeated 
    // is greater or equal to the $group_threshold value
    if($number_of_times_repeated >= $group_threshold){
        // Example ($group_threshold < 4) AAAA = 4A
        echo $number_of_times_repeated . $group[0]; 
    }
    else{
        // Example ($group_threshold > 2) AA = AA
        echo str_repeat($group[0], $number_of_times_repeated); 
    }
}
echo PHP_EOL;


// Rebuild "uncompress" the "compressed" char groups
// back to the original string
echo 'Uncompressed: '; 
foreach($groups as $key=>$group){
	echo str_repeat($group[0], count($group)); 
}
echo PHP_EOL;
