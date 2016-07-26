<?php
header("Content-Type: image/png");

// Rename this file to index.php to generate images without specifying a name
//
// Example Use <img src="http://localhost/?500x500">
//
// Otherwise you will have to link to it like this: <img src="http://localhost/PlaceholderImageGenerator.php?500x500">
//
// Additionally, because I am not useing named variables in the string
// we cannot use $_GET[] or $_REQUEST[] to obtain the size variables
//
// The reason is, it is cleaner to do this: ?500x500
//
// Rather than this: ?height=500&width=500
//


// Domain name lenght varies - find where the variables begin
$variables_start_at = stripos($_SERVER['QUERY_STRING'],"?"); 
$raw_variables = substr($_SERVER['QUERY_STRING'],$variables_start_at); // contains the variables
$x_pos = stripos($raw_variables,"x"); // find the delimiter
$width = substr($raw_variables,0, $x_pos); // get the width
$height= substr($raw_variables,$x_pos+1, strlen($raw_variables)); // get the height

// No width or if it's too small set to 100px
if(!isset($width) || $width <= 0){
	$width = 100;
}
// No height or if it's too small set to 100px
if(!isset($height) || $height <= 0){
	$height = 100;
}

// Draw
$im = @imagecreate($width, $height) or die("Unable to Initialize Image Stream");
$background_color = imagecolorallocate($im, 200, 200, 200);
$text_color = imagecolorallocate($im, 100, 100, 100);
imagestring($im, 5, $width/2, $height/2,  $width . "x" . $height, $text_color);
imagepng($im);
imagedestroy($im);
?>
