<?php
// Reverse a String

function reverseString($str) 
{
  return join(array_reverse(str_split($str)));
}

// Use
// reverseString("hello");
echo reverseString("hello");
?>