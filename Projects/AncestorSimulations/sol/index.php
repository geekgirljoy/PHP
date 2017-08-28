<?php
set_time_limit(300); // Adjust as needed

if (php_sapi_name() != "cli") {
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ancestor Simulations The Sol System</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body style="background-color:black; color:white;">
<?php
}


//////////////////////////////////////////////
// Begin Functions
////

// Normalize data range
function MinMax($value, $min, $max, $size){
    return abs(($value - $min) / ($max - $min) * $size);
}


// Get the file extension 
function GetFileExtension($image){
	$path_data = pathinfo('images/' . $image);
	return strtolower($path_data['extension']);
}

// Load an image resource
function LoadImage($image){
	$ext = GetFileExtension($image);
	if($ext == 'jpg' || $ext == 'jpeg'){$image = imageCreateFromJpeg('images/' . $image);}
	elseif($ext == 'png'){$image = imageCreateFromPng('images/' . $image);}
	elseif($ext == 'bmp'){$image = imageCreateFromBmp('images/' . $image);}
	else{return null;}
	return $image;
}


// Buffer Images
function EncodeImage($image){
	
	global $images, $buffered;

	ob_start(); // Start the buffer
	imagegif($image); // Output image buffer as a gif encoded still
	$images[]=ob_get_contents(); // add the gif still to the images array
	//$buffered[]=$delay; // Delay in the animation.
	$buffered[]= (100 * $_SESSION['delay']); // Delay in the animation (ms * delay in seconds)
	ob_end_clean(); // Stop the buffer
}
 
// Create Gif
function CreateGif($num_images){
	global $images, $buffered;
	

	// Do something with each image
	for($i = 1; $i < $num_images; $i++)
	{
		$image = LoadImage("$i.png");
		EncodeImage($image); // Buffer image
		imagedestroy($image); // Free memory
	}

	// Generate the animation
	$gif = new GIFEncoder($images,$buffered,0,0,0,0,0,'bin');
	
	
	// Save the gif
	$animation_file = fopen('inner-sol-system-orbit.gif', 'w');
	fwrite($animation_file, $gif->GetAnimation());
	fclose($animation_file);
}
////
// End Functions
/////////////////////////////////////////



////
// Define Simulation
////
$delta_time = 0.03; // 0.1 // 0.03
$low = -3;
$high = 3;
$simulations = 210;// 120 // 210
$display_names = false;

if (php_sapi_name() == "cli") {
	$line_ending = PHP_EOL;
}else{
	$line_ending = '<br>' . PHP_EOL;
}



echo 'Simulation settings initialized.' . $line_ending;



////
// Create Solar System
////
$size = 1024;
$system = imagecreatetruecolor($size, $size);
$space_black = imagecolorallocate($system, 0, 0, 0);

echo 'Solar system initialized.' . $line_ending;

////
// Define Sun
////
$sun_size=40; // Size
$sun_x = $size/2; // center the sun on x
$sun_y = $size/2; // center the sun on y
$sun_yellow = imagecolorallocate($system, 255, 255, 0); // Color
// plot sun
@imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow);
if($display_names == true){
	@imagestring ( $system, 5, $sun_x-12 , $sun_y-7 , "Sun" , $space_black );
}

echo 'Sun initialized.' . $line_ending;

////
// Define Mercury
////
$mercury_au_from_sun=0.39; // AU from Sun
$mercury_size=1; // Size
$mercury_grey = imagecolorallocate($system, 100, 100, 100); // Color
$mercury_vy = 1.8; // Velocity
$mercury_vx = 0;   // Velocity
$mercury_x = $mercury_au_from_sun; // Initial x position
$mercury_y = 0; // Initial y position
$mercury_r = sqrt(pow($mercury_x,2) + pow($mercury_y,2)); // Orbital radius at this position
$mercury_a =  1.8 / pow($mercury_r, 2); // Acceleration / angle
$mercury_ax = -$mercury_a * $mercury_x / $mercury_r; // Divide the force for the angle between x & y
$mercury_ay = -$mercury_a * $mercury_y / $mercury_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$mercury_row = MinMax($mercury_y, $low, $high, $size);
$mercury_col = MinMax($mercury_x, $low, $high, $size);
// plot mercury
@imagefilledellipse ( $system, round($mercury_row), round($mercury_col), $mercury_size, $mercury_size, $mercury_grey);
if($display_names == true){
	@imagestring ( $system, 5, $mercury_row-$mercury_size+5, $mercury_col-$mercury_size+5, "Mercury", $mercury_grey);
}

echo 'Mercury initialized.' . $line_ending;

////
// Define Venus
////
$venus_au_from_sun=0.723; // AU from Sun
$venus_size=3; // Size
$venus_brown = imagecolorallocate($system, 150, 100, 0); // Color
$venus_vy = 1; // Velocity
$venus_vx = 0; // Velocity
$venus_x = $venus_au_from_sun; // Initial x position
$venus_y = 0; // Initial y position
$venus_r = sqrt(pow($venus_x,2) + pow($venus_y,2)); // Orbital radius at this position
$venus_a =  $venus_au_from_sun / pow($venus_r, 2); // Acceleration / angle
$venus_ax = -$venus_a * $venus_x / $venus_r; // Divide the force for the angle between x & y
$venus_ay = -$venus_a * $venus_y / $venus_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$venus_row = MinMax($venus_y, $low, $high, $size);
$venus_col = MinMax($venus_x, $low, $high, $size);
// plot venus
@imagefilledellipse ( $system, round($venus_row), round($venus_col), $venus_size+5, $venus_size, $venus_brown );
if($display_names == true){
    @imagestring ( $system, 5, $venus_row-$venus_size , $venus_col-$venus_size+5 , "Venus" , $venus_brown );
}

echo 'Venus initialized.' . $line_ending;


////
// Define Earth
////
$earth_au_from_sun=1;// AU from Sun
$earth_size=4; // Size
$earth_blue = imagecolorallocate($system, 0, 0, 255); // Color
$earth_vy = 1; // Velocity
$earth_vx = 0; // Velocity
$earth_x = $earth_au_from_sun; // Initial x position
$earth_y = 0; // Initial y position
$earth_r = sqrt(pow($earth_x,2) + pow($earth_y,2)); // Orbital radius at this position
$earth_a =  $earth_au_from_sun / pow($earth_r, 2); // Acceleration / angle
$earth_ax = -$earth_a * $earth_x / $earth_r; // Divide the force for the angle between x & y
$earth_ay = -$earth_a * $earth_y / $earth_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$earth_row = MinMax($earth_y, $low, $high, $size);
$earth_col = MinMax($earth_x, $low, $high, $size);
// plot earth
@imagefilledellipse ( $system, round($earth_row), round($earth_col), $earth_size, $earth_size, $earth_blue );
if($display_names == true){
    @imagestring ( $system, 5, $earth_row-$earth_size , $earth_col-$earth_size+5 , "Earth" , $earth_blue );
}

echo 'Earth initialized.' . $line_ending;


////
// Define Mars
////
$mars_au_from_sun = 1.524; // AU from Sun
$mars_size = 2; // Size
$mars_red = imagecolorallocate($system, 255, 0, 0); // Color
$mars_vy = 0.8; // Velocity
$mars_vx = 0; // Velocity
$mars_x = $mars_au_from_sun; // Initial x position
$mars_y = 0; // Initial y position
$mars_r = sqrt(pow($mars_x,2) + pow($mars_y,2)); // Orbital radius at this position
$mars_a =  $mars_au_from_sun / pow($mars_r, 2); // Acceleration / angle
$mars_ax = -$mars_a * $mars_x / $mars_r; // Divide the force for the angle between x & y
$mars_ay = -$mars_a * $mars_y / $mars_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$mars_row = MinMax($mars_y, $low, $high, $size);
$mars_col = MinMax($mars_x, $low, $high, $size);
// plot mars
@imagefilledellipse ( $system, round($mars_row), round($mars_col), $mars_size, $mars_size, $mars_red);
if($display_names == true){
    @imagestring ( $system, 5, $mars_row-$mars_size , $mars_col-$mars_size+5 , "Mars" , $mars_red );
}

echo 'Mars initialized.' . $line_ending;

// Output image
imagepng($system, "images/0.png");

// free memory
imagedestroy($system);

echo 'Simulation ready. Running...';

for($i = 0; $i < $simulations; $i++){
	
	////
	// Solar System
	////
    $system = imagecreatetruecolor($size, $size);
	
	
	////
	// Sun
	////
	// Plot Sun
	@imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow );
	if($display_names == true){
	    @imagestring ( $system, 5, $sun_x-12 , $sun_y-7 , "Sun" , $space_black );
    }

	////
	// Mercury
	////
    $mercury_vx = $mercury_vx + $mercury_ax * $delta_time; // New velocity
	$mercury_vy = $mercury_vy + $mercury_ay * $delta_time; // New velocity
	$mercury_x = $mercury_x + $mercury_vx * $delta_time; // New position
	$mercury_y = $mercury_y + $mercury_vy * $delta_time; // New position
	$mercury_r = sqrt(pow($mercury_x,2) + pow($mercury_y,2)); // Orbital radius at this position
	$mercury_a =  1.8 / pow($mercury_r, 2); // Acceleration / angle
	$mercury_ax = -$mercury_a * $mercury_x / $mercury_r; // Divide the force for the angle between x & y
	$mercury_ay = -$mercury_a * $mercury_y / $mercury_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$mercury_row = MinMax($mercury_y, $low, $high, $size);
	$mercury_col = MinMax($mercury_x, $low, $high, $size);
	// Plot Mercury
	@imagefilledellipse ( $system, round($mercury_row), round($mercury_col), $mercury_size, $mercury_size, $mercury_grey );
	if($display_names == true){
	    @imagestring ( $system, 5, $mercury_row-$mercury_size+5, $mercury_col-$mercury_size+5, "Mercury", $mercury_grey);
    }
	
	
	
	////
	// Venus
	////
    $venus_vx = $venus_vx + $venus_ax * $delta_time; // New velocity
	$venus_vy = $venus_vy + $venus_ay * $delta_time; // New velocity
	$venus_x = $venus_x + $venus_vx * $delta_time; // New position
	$venus_y = $venus_y + $venus_vy * $delta_time; // New position
	$venus_r = sqrt(pow($venus_x,2) + pow($venus_y,2)); // Orbital radius at this position	
	$venus_a =  $venus_au_from_sun / pow($venus_r, 2); // Acceleration / angle
	$venus_ax = -$venus_a * $venus_x / $venus_r; // Divide the force for the angle between x & y
	$venus_ay = -$venus_a * $venus_y / $venus_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$venus_row = MinMax($venus_y, $low, $high, $size);
	$venus_col = MinMax($venus_x, $low, $high, $size);
	// Plot Venus
	@imagefilledellipse ( $system, round($venus_row), round($venus_col), $venus_size, $venus_size, $venus_brown );
	if($display_names == true){
	    @imagestring ( $system, 5, $venus_row-$venus_size , $venus_col-$venus_size+5 , "Venus" , $venus_brown );
    }
	
	
	
	////
	// Earth
	////
    $earth_vx = $earth_vx + $earth_ax * $delta_time; // New velocity
	$earth_vy = $earth_vy + $earth_ay * $delta_time; // New velocity
	$earth_x = $earth_x + $earth_vx * $delta_time; // New position
	$earth_y = $earth_y + $earth_vy * $delta_time; // New position
	$earth_r = sqrt(pow($earth_x,2) + pow($earth_y,2)); // Orbital radius at this position
	$earth_a =  $earth_au_from_sun / pow($earth_r, 2); // Acceleration / angle
	$earth_ax = -$earth_a * $earth_x / $earth_r; // Divide the force for the angle between x & y
	$earth_ay = -$earth_a * $earth_y / $earth_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$earth_row = MinMax($earth_y, $low, $high, $size);
	$earth_col = MinMax($earth_x, $low, $high, $size);
	// Plot Earth
	@imagefilledellipse ( $system, round($earth_row), round($earth_col), $earth_size, $earth_size, $earth_blue );
	if($display_names == true){
		@imagestring ( $system, 5, $earth_row-$earth_size , $earth_col-$earth_size+5 , "Earth" , $earth_blue );
    }
	
	////
	// Mars
	////
    $mars_vx = $mars_vx + $mars_ax * $delta_time; // New velocity
	$mars_vy = $mars_vy + $mars_ay * $delta_time; // New velocity
	$mars_x = $mars_x + $mars_vx * $delta_time; // New position
	$mars_y = $mars_y + $mars_vy * $delta_time; // New position
	$mars_r = sqrt(pow($mars_x,2) + pow($mars_y,2)); // Orbital radius at this position
	$mars_a =  $mars_au_from_sun / pow($mars_r, 2); // Acceleration / angle
	$mars_ax = -$mars_a * $mars_x / $mars_r; // Divide the force for the angle between x & y
	$mars_ay = -$mars_a * $mars_y / $mars_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$mars_row = MinMax($mars_y, $low, $high, $size);
	$mars_col = MinMax($mars_x, $low, $high, $size);
	// Plot Mars
	@imagefilledellipse ( $system, round($mars_row), round($mars_col), $mars_size, $mars_size, $mars_red );
	if($display_names == true){
		@imagestring ( $system, 5, $mars_row-$mars_size , $mars_col-$mars_size+5 , "Mars" , $mars_red );
	}
	


	// Output Solar System
	imagepng($system, "images/" . ($i + 1) . ".png");

	// Free Memory
	imagedestroy($system);
}

echo 'Complete!' . $line_ending;



echo 'Generating animation...' ;
include('GIFEncoder.class.php'); // GIFEncoder class


$_SESSION['delay'] = 0.1; // 1 second

$images;
$buffered;
@CreateGif($simulations);
echo 'Complete!' .$line_ending ;

if (php_sapi_name() != "cli") {
?>
     <center>
         <img src="inner-sol-system-orbit.gif" alt="inner sol system orbit">
	 </center>

	</body>
</html>
<?php
}
?>
