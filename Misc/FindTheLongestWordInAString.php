<?php
// Find the Longest Word in a String

/*
Return the length of the longest word in the provided sentence.

Your response should be a number.

*/

function findLongestWord($str) 
{
  
  $arr = explode(" ", $str);
  $len = 0;
  for( $i = 0; $i < sizeof($arr); $i++ ) { if( strlen($arr[$i]) > $len ) { $len = strlen($arr[$i]); } }
  
  return $len;
}

// Use
// findLongestWord("The quick brown fox jumped over the lazy dog");
echo findLongestWord("The quick brown fox jumped over the lazy dog");
?>
