<?php
function palindrome($str) 
{
  $str = strtolower($str); // convert to lower
  $str = preg_replace("/[^a-zA-Z0-9]/", '', $str);
  $strRev = join(array_reverse(str_split($str)));

  if($str != $strRev){ return "false"; }
  else{ return "true"; }
}

echo palindrome("eye") . "<br/>"; //should return true.
echo palindrome("race car") . "<br/>"; //should return true.
echo palindrome("not a palindrome") . "<br/>"; //should return false.
echo palindrome("A man, a plan, a canal. Panama") . "<br/>"; //should return true.
echo palindrome("never odd or even") . "<br/>"; //should return true.
echo palindrome("nope") . "<br/>"; //should return false.
echo palindrome("almostomla") . "<br/>"; //should return false.
echo palindrome("My age is 0, 0 si ega ym.") . "<br/>"; //should return true.
echo palindrome("1 eye for of 1 eye.") . "<br/>"; //should return false.
echo palindrome("0_0 (: /-\ :) 0-0") . "<br/>"; //should return true.

?>