<?php
// Mutations

/*

Return true if the string in the first element 
of the array contains all of the letters of the 
string in the second element of the array.

For example, ["hello", "Hello"], should return 
true because all of the letters in the second 
string are present in the first, ignoring case.

The arguments ["hello", "hey"] should return 
false because the string "hello" does not 
contain a "y".

Lastly, ["Alien", "line"], should return true 
because all of the letters in "line" are present 
in "Alien".

*/
function mutation($arr) 
{
    $A = strtolower($arr[0]);
    $B = strtolower($arr[1]);
 
    for ( $i = 0; $i < strlen($B); $i++ ) 
    {
      if (!strrpos($A, $B[$i])){ return false; }
    }
  return true;
}

// Use
// mutation(["zyxwvutsrqponmlkjihgfedcba", "qrstu"]);
echo mutation(["zyxwvutsrqponmlkjihgfedcba", "qrstu"]); //true
echo mutation(["Alien", "line"]); // true
echo mutation(["hello", "hey"]); // false
?>