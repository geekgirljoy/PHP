<?php
function WebColorToRGBA($color){
	$color = ltrim($color, '#'); // remove hash if there is one
	
	// Split Triplet 
	$red = substr($color, 0, 2);
	$green = substr($color, 2, 2);
	$blue = substr($color, 4, 2);
	
	// Convert webcolor hex to RGB dec
	$red = hexdec($red);
	$green = hexdec($green);
	$blue = hexdec($blue);
	
	// is this RGB = 6 or RGBA = 8?
	if(strlen($color) == 8){
	    $alpha = substr($color, 6, 2); // get alpha 
		$alpha = hexdec($alpha); // Convert to RGB
		
		// return RGBA
	    return array('red'=>$red, 'green'=>$green, 'blue'=>$blue, 'alpha'=>$alpha);
	}
	// return RGB
	return array('red'=>$red, 'green'=>$green, 'blue'=>$blue);
}
// Examples
// Note the # is optional
$white = WebColorToRGBA('#FFFFFF');
$black = WebColorToRGBA('#000000');
$red = WebColorToRGBA('#FF0000');
$green = WebColorToRGBA('#00FF00');
$blue = WebColorToRGBA('#0000FF');
$yellow = WebColorToRGBA('#FFFF00');
$cyan = WebColorToRGBA('#00FFFF');
$magenta = WebColorToRGBA('#FF00FF');
$RGBcolors = array('white'=>$white, 'black'=>$black, 'red'=>$red, 'green'=>$green, 'blue'=>$blue, 'yellow'=>$yellow, 'cyan'=>$cyan, 'magenta'=>$magenta);
var_dump($RGBcolors);
/*
Output:
array(8) {
  ["white"]=>
  array(3) {
    ["red"]=>
    int(255)
    ["green"]=>
    int(255)
    ["blue"]=>
    int(255)
  }
  ["black"]=>
  array(3) {
    ["red"]=>
    int(0)
    ["green"]=>
    int(0)
    ["blue"]=>
    int(0)
  }
  ["red"]=>
  array(3) {
    ["red"]=>
    int(255)
    ["green"]=>
    int(0)
    ["blue"]=>
    int(0)
  }
  ["green"]=>
  array(3) {
    ["red"]=>
    int(0)
    ["green"]=>
    int(255)
    ["blue"]=>
    int(0)
  }
  ["blue"]=>
  array(3) {
    ["red"]=>
    int(0)
    ["green"]=>
    int(0)
    ["blue"]=>
    int(255)
  }
  ["yellow"]=>
  array(3) {
    ["red"]=>
    int(255)
    ["green"]=>
    int(255)
    ["blue"]=>
    int(0)
  }
  ["cyan"]=>
  array(3) {
    ["red"]=>
    int(0)
    ["green"]=>
    int(255)
    ["blue"]=>
    int(255)
  }
  ["magenta"]=>
  array(3) {
    ["red"]=>
    int(255)
    ["green"]=>
    int(0)
    ["blue"]=>
    int(255)
  }
}
*/
