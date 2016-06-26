<?php
header("Content-Type:text/plain"); 

$myDec = 1;			// Decimal
$myFloat = 1.0;		// Floating Point
$myOct = 001;	    // Octal
$myHex = 0x01;		// Hexadecimal
$myBin = 0b00000001;// Binary


echo <<<output

Decimal: $myDec
Floating Point: $myFloat
Octal: $myOct
Hexadecimal: $myHex
Binary: $myBin

output;

?>
