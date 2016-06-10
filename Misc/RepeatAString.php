<?php
// Repeat a string repeat a string

/*

Repeat a given string (first argument) 
n times (second argument). 

Return an empty string if n is a 
negative number

*/
function repeat($str, $num) 
{
  if($num > 0){return str_repeat($str, $num);}
  else{return "";}
}


// Use
// repeat("abc", 2);
echo repeat("abc", 2);
?>