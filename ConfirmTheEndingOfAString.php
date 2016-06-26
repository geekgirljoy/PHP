<?php
/*
Confirm the Ending of a String

This function will Check if a string (first argument) ends 
with the given target string (second argument).
*/
function MyEnd($str, $target){	
    if (substr($str, -strlen($target), strlen($target)) == $target){
        return 1;
    }else{
        return 0;
    }
}

// Use Tests
echo MyEnd('ZZZZZZZ', 'y');   // 0
echo MyEnd('ZZZZZZZ', 'z');   // 0
echo MyEnd('ZZZZZZZ', 'Z');   // 1
echo MyEnd('BastiAn', 'ian'); // 0
echo MyEnd('BastiAn', 'iAn'); // 1
?>