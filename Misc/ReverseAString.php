<?php
// Reverse a String

function reverseString($str) 
{
 // return join(array_reverse(str_split($str)));
 return strrev($str);
}

// Use
// reverseString("hello");
echo reverseString("hello");
?>
