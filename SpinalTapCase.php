<?php
// Spinal Tap Case

/*

Convert a string to spinal case. 
Spinal case is:
all-lowercase-words-joined-by-dashes.

*/
function spinalCase($str) 
{
  return preg_replace('/\s/', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower( $str ) ));
}

// Use
// spinalCase('This Is Spinal Tap');
echo spinalCase('This Is Spinal Tap');
?>