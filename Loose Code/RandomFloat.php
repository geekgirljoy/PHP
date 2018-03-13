<?php

// return random float between -1.0 & 1.0
function RandomFloat($length = 1){
   $value = 1 . str_repeat ('0' , $length);
   $value = mt_rand( -$value, $value ) / $value;
   
   if(mt_rand(1,2) == 1){ // flip coin to see if should invert value
     $value = ($value * 1) * (1 * -1);
   }
   return $value;
}

echo RandomFloat() . PHP_EOL; // could be positive or negitive between -1.0 & 1.0
echo RandomFloat(2) . PHP_EOL; // could be positive or negitive between -1.00 & 1.00
echo RandomFloat(5) . PHP_EOL; // could be positive or negitive between -1.00000 & 1.00000
echo abs(RandomFloat()) . PHP_EOL; // will always be positive between 0.0 & 1.0
