<?php
// Truncate a string

/*

Truncate a string (first argument) if it is
 longer than the given maximum string
 length (second argument). Return the 
 truncated string with a "..." ending.

Note that the three dots at the end add
to the string length.

If the num is less than or equal to 3,
then the length of the three dots is not
added to the string length.

*/
function truncate($str, $num) 
{
	if( strlen($str) > $num )
	{ 
		if($num > 3){$str = array_slice(str_split($str), 0, $num-3);} 
		else{ $str = array_slice(str_split($str), 0, $num); }
		array_push($str, "...");
	}
  return join($str);
}


// Use
// truncate("A-tisket a-tasket A green and yellow basket", 28);
echo truncate("A-tisket a-tasket A green and yellow basket", 28);
?>