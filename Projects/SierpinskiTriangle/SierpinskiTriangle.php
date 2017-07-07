<?php
set_time_limit(300); // Adjust as needed

include('GIFEncoder.class.php'); // GIFEncoder class


// Buffer Images
// http://php.net/manual/en/function.ob-start.php
// http://php.net/manual/en/function.imagegif.php
// http://php.net/manual/en/function.ob-get-contents.php
// http://php.net/manual/en/function.ob-end-clean.php
function EncodeImage($image, $delay){
	
	global $images, $buffered;

	ob_start(); // Start the buffer
	imagegif($image); // Output image buffer as a gif encoded still
	$images[]=ob_get_contents(); // add the gif still to the images array
	$buffered[]=$delay; // Delay in the animation.
	ob_end_clean(); // Stop the buffer
}


// Build the triangle fractal
// https://en.wikipedia.org/wiki/Sierpinski_triangle
// http://php.net/manual/en/function.imagecolorallocate.php
// http://php.net/manual/en/function.mt-rand.php
// http://php.net/manual/en/function.imagesetpixel.php
function ChaosGame($image, $points){
	global $density,$x, $y;
	
	for ($i = 1; $i < $density; $i++) { // Higher density will plot more points
	  $COL = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)); // Random Color
	  imagesetpixel($image, round($x),round($y), $COL); // Plot the current position
	  $a = mt_rand(0, 2); // Randomly select any one of the 3 vertex points for next the iteration
	  
	  // Move half the distance from your current position 
	  // to the selected vertex for next the iteration
	  $x = ($x + $points[$a]['x']) / 2;
	  $y = ($y + $points[$a]['y']) / 2;
	}
	
}


$images;
$buffered;

$density = 100000;
$frame_increment = 7; // Set to 1 for 360 still images.
                      // At 7 we get 52.

// Create the still images
for ($k = 1; $k < 360; $k+=$frame_increment) {
	$x = 600; // Reset $x
	$y = 600; // Reset $y
	$points[0] = array('x' => $x / 2, 'y' =>  0); // Top
	$points[1] = array('x' =>   10, 'y' => $y - 0); // Left
	$points[2] = array('x' => $x - 10, 'y' => $y - 0); // Right
	$image = imagecreatetruecolor($x, $y); // Create the image resource 
	ChaosGame($image, $points); // This triangle will rotate
    $image = imagerotate($image, $k, 0); // Perform rotation
	ChaosGame($image, $points); // This triangle will not
	imagepng($image , "$k.png"); // Save the image 
	EncodeImage($image, 1); // Buffer image
	imagedestroy($image); // Free memory
}


// Generate the animation
$gif = new GIFEncoder($images,$buffered,0,0,0,0,0,'bin');

// Save the gif
$animation_file = fopen('Sierpinski_triangle.gif', 'w');
fwrite($animation_file, $gif->GetAnimation());
fclose($animation_file);

?>
