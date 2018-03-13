<?php 

function Invert($value){
   return $value = ($value * 1) * (1 * -1);
}

echo Invert(22) . PHP_EOL; // -22
echo Invert(-22.5) . PHP_EOL; // 22.5
echo Invert(3.14159) . PHP_EOL; // -3.14159
