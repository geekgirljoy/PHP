<?php
    // http://php.net/manual/en/language.operators.bitwise.php
    // https://en.wikipedia.org/wiki/Bitwise_operation
    
    echo $even = mt_rand(2,80) & ~1; // generate a random number between 2 & 80 
                                     // then set the least significant bit to 0 
                                     // so that we have an even number.

    echo $odd = mt_rand(1,80) | 1;   // generate a random number between 1 & 80 
                                     // then set the least significant bit to 1 
                                     // so that we have an odd number.
?>
