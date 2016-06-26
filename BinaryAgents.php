<?php
/*
BinaryAgent()

Function returns an english translated sentence of 
the passed binary string.

The binary string will be space separated.
*/
function BinaryAgent($str){
	$arr = explode(" ", $str);
    $arr2 = [];

	for($i = 0; $i < count($arr); $i++){
		array_push($arr2,chr(bindec($arr[$i])));
	}
	
	return join("",$arr2);
}

// Use
// BinaryAgent("01000001 01110010 01100101 01101110 00100111 01110100 00100000 01100010 01101111 01101110 01100110 01101001 01110010 01100101 01110011 00100000 01100110 01110101 01101110 00100001 00111111");
 echo BinaryAgent("01000001 01110010 01100101 01101110 00100111 01110100 00100000 01100010 01101111 01101110 01100110 01101001 01110010 01100101 01110011 00100000 01100110 01110101 01101110 00100001 00111111");

?>