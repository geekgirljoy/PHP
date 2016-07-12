<?php
function Palindrome($str){
  $str = strtolower($str); // convert to lower
  $str = preg_replace("/[^a-zA-Z0-9]/", '', $str);
  $strRev = join(array_reverse(str_split($str)));

  if($str != $strRev){ return "false"; }
  else{ return "true"; }
}

// Tests
$test_arr = [
'eye',//should return true.
'race car',//should return true.
'not a Palindrome',//should return false.
'A man, a plan, a canal. Panama',//should return true.
'never odd or even',//should return true.
'nope',//should return false.
'almostomla',//should return false.
'My age is 0, 0 si ega ym.',//should return true.
'1 eye for of 1 eye.',//should return false.
'0_0 (: /-\ :) 0-0'//should return true.
];


foreach($test_arr as $str){
	echo "$str - <b> " . Palindrome($str) . "</b><br/><br/>" . PHP_EOL;
}
?>