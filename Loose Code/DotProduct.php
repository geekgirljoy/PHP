<?php
// https://en.wikipedia.org/wiki/Dot_product

function DotProduct($array_1, $array_2){

    if ($array_1 == null){
        throw new Exception('DotProduct($array_1, $array_2) $array_1 is empty or null');
    }
 
    if ($array_2 == null){
        throw new Exception('DotProduct($array_1, $array_2) $array_2 is empty or null');
    }
    
    if (count($array_1) != count($array_2)){
        throw new Exception('DotProduct($array_1, $array_2) $array_1 & $array_2 are not the same length');
    }

    $product = array();
    $length = count($array_1);
    for ($i = 0; $i < $length; $i++){
        $product[] = $array_1[$i] * $array_2[$i];
    }
 
    return array_sum($product);
}
  
$a = array(1,2,3,4,5);
$b = array(6,7,8,9,10);
$c = array(3,1,4,5,9);
$d = array(0.2, 0.15, 0.45, 0.8, 0.63);

echo DotProduct($a, $b); // 130
echo DotProduct($c, $d); // 12.22
echo DotProduct($b, $d); // 19.35
