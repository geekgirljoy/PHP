<?php

// Confirm the Ending of a String

/*

Check if a string (first argument) ends 
with the given target string (second argument).

*/

function myend($str, $target) 
{
  if ( $str[strlen($str) - strlen($target)] === $target){return true; }
  else{ return false; }
}


// Use
// myend("Bastian", "n");
echo myend("Bastian", "n");
?>