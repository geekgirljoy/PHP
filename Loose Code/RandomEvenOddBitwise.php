<?php
    // http://php.net/manual/en/language.operators.bitwise.php
    // https://en.wikipedia.org/wiki/Bitwise_operation
    
    echo $even = mt_rand(2,80) & ~1; // generate random number then set the lest significant bit to 0 so that we have an even number
    echo $odd = mt_rand(2,80) | 1;   // generate random number then set the lest significant bit to 1 so that we have an odd number
?>
