// return random float between -1.0 & 1.0
function RandomFloat(){
   $value = mt_rand( -100, 100 ) / 100;
   if(mt_rand(1,2) == 1){ // flip coin to see if should invert value
     $value = ($value * 1) * (1 * -1);
   }
   return $value;
}

echo RandomFloat() . PHP_EOL; // could be positive or negitive between -1.0 & 1.0
echo RandomFloat() . PHP_EOL; // could be positive or negitive between -1.0 & 1.0
echo RandomFloat() . PHP_EOL; // could be positive or negitive between -1.0 & 1.0
echo abs(RandomFloat()) . PHP_EOL; // will always be positive between 0.0 & 1.0
