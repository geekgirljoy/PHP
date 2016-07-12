<?php
/*
Counting in Dec, Float, Oct, Hex, Bin

Below I demonstrate counting the first base set of the following numeral systems Decimal, Floating Point, Octal, Hexadecimal, Binary manually and programmatically.

Manual counting is output with a HereDoc to improve readability.
*/
header("Content-Type:text/plain"); // output results as plain text

// Single Variable Examples
$my_dec = 1;         // Decimal
$my_float = 1.0;     // Floating Point
$my_oct = 001;       // Octal
$my_hex = 0x01;      // Hexadecimal
$my_bin = 0b00000001;// Binary

// Manual Array Examples
$my_dec_arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$my_float_arr = [0.0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0];
$my_oct_arr = [000, 001, 002, 003, 004, 005, 006, 007, 010, 011, 012];
$my_hex_arr = [0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a];
$my_bin_arr = [0b000000, 0b000001, 0b000010, 0b000011, 0b000100, 0b000101, 0b000110, 0b000111, 0b001000, 0b001001, 0b001010];

// Output
echo 'Counting in Decimal, Floating Point, Octal, Hexadecimal, Binary manually and programmatically.';

echo 'Single Variable Examples' . PHP_EOL;
echo <<<sve
Decimal: $my_dec
Floating Point: $my_float
Octal: $my_oct
Hexadecimal: $my_hex
Binary: $my_bin
sve;


echo 'Manual Array Examples' . PHP_EOL;
echo <<<mae
Manually Counting in Decimal
Decimal [0]: $my_dec_arr[0];
Decimal [1]: $my_dec_arr[1];
Decimal [2]: $my_dec_arr[2];
Decimal [3]: $my_dec_arr[3];
Decimal [4]: $my_dec_arr[4];
Decimal [5]: $my_dec_arr[5];
Decimal [6]: $my_dec_arr[6];
Decimal [7]: $my_dec_arr[7];
Decimal [8]: $my_dec_arr[8];
Decimal [9]: $my_dec_arr[9];
Decimal [10]: $my_dec_arr[10];

Manually Counting with Floating Point Numbers
Floating Point [0]: $my_float_arr[0];
Floating Point [1]: $my_float_arr[1];
Floating Point [2]: $my_float_arr[2];
Floating Point [3]: $my_float_arr[3];
Floating Point [4]: $my_float_arr[4];
Floating Point [5]: $my_float_arr[5];
Floating Point [6]: $my_float_arr[6];
Floating Point [7]: $my_float_arr[7];
Floating Point [8]: $my_float_arr[8];
Floating Point [9]: $my_float_arr[9];
Floating Point [10]: $my_float_arr[10];

Manually Counting in Octal
Octal [0]: $my_oct_arr[0];
Octal [1]: $my_oct_arr[1];
Octal [2]: $my_oct_arr[2];
Octal [3]: $my_oct_arr[3];
Octal [4]: $my_oct_arr[4];
Octal [5]: $my_oct_arr[5];
Octal [6]: $my_oct_arr[6];
Octal [7]: $my_oct_arr[7];
Octal [8]: $my_oct_arr[8];
Octal [9]: $my_oct_arr[9];
Octal [10]: $my_oct_arr[10];

Manually Counting in Hexadecimal
Hexadecimal [0]: $my_hex_arr[0];
Hexadecimal [1]: $my_hex_arr[1];
Hexadecimal [2]: $my_hex_arr[2];
Hexadecimal [3]: $my_hex_arr[3];
Hexadecimal [4]: $my_hex_arr[4];
Hexadecimal [5]: $my_hex_arr[5];
Hexadecimal [6]: $my_hex_arr[6];
Hexadecimal [7]: $my_hex_arr[7];
Hexadecimal [8]: $my_hex_arr[8];
Hexadecimal [9]: $my_hex_arr[9];
Hexadecimal [10]: $my_hex_arr[10];

Manually Counting in Binary
Binary [0]: $my_bin_arr[0];
Binary [1]: $my_bin_arr[1];
Binary [2]: $my_bin_arr[2];
Binary [3]: $my_bin_arr[3];
Binary [4]: $my_bin_arr[4];
Binary [5]: $my_bin_arr[5];
Binary [6]: $my_bin_arr[6];
Binary [7]: $my_bin_arr[7];
Binary [8]: $my_bin_arr[8];
Binary [9]: $my_bin_arr[9];
Binary [10]: $my_bin_arr[10];
mae;



?>