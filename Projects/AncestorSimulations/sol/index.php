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
	$animation_file = fopen('all-planets-sol-system-orbit.gif', 'w');
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
$low = -40;
$high = 40;
$simulations = 211;// 120 // 210
$frames_per_earth_year = 210;
$display_names = true;
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
$sun_size=1; // Size
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
$mercury_size=round(4*0.39); // Size
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
$venus_size=round(4*0.95); // Size
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
$mars_size = round(4*0.53); // Size
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


////
// Define Jupiter
////
$jupiter_au_from_sun = 5.2; // AU from Sun
$jupiter_size = round(4*11.19); // Size
$jupiter_red = imagecolorallocate($system, 255, 0, 0); // Color
$jupiter_vy = 0.8; // Velocity
$jupiter_vx = 0; // Velocity
$jupiter_x = $jupiter_au_from_sun; // Initial x position
$jupiter_y = 0; // Initial y position
$jupiter_r = sqrt(pow($jupiter_x,2) + pow($jupiter_y,2)); // Orbital radius at this position
$jupiter_a =  $jupiter_au_from_sun / pow($jupiter_r, 2); // Acceleration / angle
$jupiter_ax = -$jupiter_a * $jupiter_x / $jupiter_r; // Divide the force for the angle between x & y
$jupiter_ay = -$jupiter_a * $jupiter_y / $jupiter_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$jupiter_row = MinMax($jupiter_y, $low, $high, $size);
$jupiter_col = MinMax($jupiter_x, $low, $high, $size);
// Plot Jupiter
@imagefilledellipse ($system, round($jupiter_row), round($jupiter_col), $jupiter_size, $jupiter_size, $jupiter_red);
if($display_names == true){
    @imagestring ($system, 5, $jupiter_row-$jupiter_size/2, $jupiter_col-$jupiter_size+65, "Jupiter", $jupiter_red);
}
echo 'Jupiter initialized.' . $line_ending;


////
// Define Saturn
////
$saturn_au_from_sun = 9.6; // AU from Sun
$saturn_size = round(4*9.40); // Size
$saturn_tan = imagecolorallocate($system, 210,180,140); // Color
$saturn_vy = 0.8; // Velocity
$saturn_vx = 0; // Velocity
$saturn_x = $saturn_au_from_sun; // Initial x position
$saturn_y = 0; // Initial y position
$saturn_r = sqrt(pow($saturn_x,2) + pow($saturn_y,2)); // Orbital radius at this position
$saturn_a =  $saturn_au_from_sun / pow($saturn_r, 2); // Acceleration / angle
$saturn_ax = -$saturn_a * $saturn_x / $saturn_r; // Divide the force for the angle between x & y
$saturn_ay = -$saturn_a * $saturn_y / $saturn_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$saturn_row = MinMax($saturn_y, $low, $high, $size);
$saturn_col = MinMax($saturn_x, $low, $high, $size);
// Plot Saturn
@imagefilledellipse ($system, round($saturn_row), round($saturn_col), $saturn_size, $saturn_size, $saturn_tan);
if($display_names == true){
    @imagestring ($system, 5, $saturn_row-$saturn_size/2, $saturn_col-$saturn_size+60, "Saturn", $saturn_tan);
}
echo 'Saturn initialized.' . $line_ending;


////
// Define Uranus
////
$uranus_au_from_sun = 19.2; // AU from Sun
$uranus_size = round(4*4.04); // Size
$uranus_blue = imagecolorallocate($system, 173,216,230); // Color
$uranus_vy = 0.8; // Velocity
$uranus_vx = 0; // Velocity
$uranus_x = $uranus_au_from_sun; // Initial x position
$uranus_y = 0; // Initial y position
$uranus_r = sqrt(pow($uranus_x,2) + pow($uranus_y,2)); // Orbital radius at this position
$uranus_a =  $uranus_au_from_sun / pow($uranus_r, 2); // Acceleration / angle
$uranus_ax = -$uranus_a * $uranus_x / $uranus_r; // Divide the force for the angle between x & y
$uranus_ay = -$uranus_a * $uranus_y / $uranus_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$uranus_row = MinMax($uranus_y, $low, $high, $size);
$uranus_col = MinMax($uranus_x, $low, $high, $size);
// Plot Uranus
@imagefilledellipse ($system, round($uranus_row), round($uranus_col), $uranus_size, $uranus_size, $uranus_blue);
if($display_names == true){
    @imagestring ($system, 5, $uranus_row-$uranus_size, $uranus_col-$uranus_size+25, "Uranus", $uranus_blue);
}
echo 'Uranus initialized.' . $line_ending;


////
// Define Neptune
////
$neptune_au_from_sun = 29.8; // AU from Sun
$neptune_size = round($earth_size*3.88); // Size
$neptune_blue = imagecolorallocate($system, 100,200,255); // Color
$neptune_vy = 0.8; // Velocity
$neptune_vx = 0; // Velocity
$neptune_x = $neptune_au_from_sun; // Initial x position
$neptune_y = 0; // Initial y position
$neptune_r = sqrt(pow($neptune_x,2) + pow($neptune_y,2)); // Orbital radius at this position
$neptune_a =  $neptune_au_from_sun / pow($neptune_r, 2); // Acceleration / angle
$neptune_ax = -$neptune_a * $neptune_x / $neptune_r; // Divide the force for the angle between x & y
$neptune_ay = -$neptune_a * $neptune_y / $neptune_r; // Divide the force for the angle between x & y
// Normalize positions to be within the image bounds
$neptune_row = MinMax($neptune_y, $low, $high, $size);
$neptune_col = MinMax($neptune_x, $low, $high, $size);
// Plot Neptune
@imagefilledellipse ($system, round($neptune_row), round($neptune_col), $neptune_size, $neptune_size, $neptune_blue);
if($display_names == true){
    @imagestring ($system, 5, $neptune_row-$neptune_size, $neptune_col-$neptune_size+25, "Neptune", $neptune_blue);
}
echo 'Neptune initialized.' . $line_ending;


$interface_green = imagecolorallocate($system, 0,255,0); // Color
@imagestring ($system, 5, 5, 5, "0.00 Years (0 days)" , $interface_green);


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
	
	////
	// Jupiter
	////
    $jupiter_vx = $jupiter_vx + $jupiter_ax * $delta_time; // New velocity
	$jupiter_vy = $jupiter_vy + $jupiter_ay * $delta_time; // New velocity
	$jupiter_x = $jupiter_x + $jupiter_vx * $delta_time; // New position
	$jupiter_y = $jupiter_y + $jupiter_vy * $delta_time; // New position
	$jupiter_r = sqrt(pow($jupiter_x,2) + pow($jupiter_y,2)); // Orbital radius at this position
	$jupiter_a =  $jupiter_au_from_sun / pow($jupiter_r, 2); // Acceleration / angle
	$jupiter_ax = -$jupiter_a * $jupiter_x / $jupiter_r; // Divide the force for the angle between x & y
	$jupiter_ay = -$jupiter_a * $jupiter_y / $jupiter_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$jupiter_row = MinMax($jupiter_y, $low, $high, $size);
	$jupiter_col = MinMax($jupiter_x, $low, $high, $size);
	// Plot Jupiter
	@imagefilledellipse ($system, round($jupiter_row), round($jupiter_col), $jupiter_size, $jupiter_size, $jupiter_red);
	if($display_names == true){
		@imagestring ($system, 5, $jupiter_row-$jupiter_size/2, $jupiter_col-$jupiter_size+65, "Jupiter", $jupiter_red);
	}

	// Saturn
	////
    $saturn_vx = $saturn_vx + $saturn_ax * $delta_time; // New velocity
	$saturn_vy = $saturn_vy + $saturn_ay * $delta_time; // New velocity
	$saturn_x = $saturn_x + $saturn_vx * $delta_time; // New position
	$saturn_y = $saturn_y + $saturn_vy * $delta_time; // New position
	$saturn_r = sqrt(pow($saturn_x,2) + pow($saturn_y,2)); // Orbital radius at this position
	$saturn_a =  $saturn_au_from_sun / pow($saturn_r, 2); // Acceleration / angle
	$saturn_ax = -$saturn_a * $saturn_x / $saturn_r; // Divide the force for the angle between x & y
	$saturn_ay = -$saturn_a * $saturn_y / $saturn_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$saturn_row = MinMax($saturn_y, $low, $high, $size);
	$saturn_col = MinMax($saturn_x, $low, $high, $size);
	// Plot Saturn
	@imagefilledellipse ($system, round($saturn_row), round($saturn_col), $saturn_size, $saturn_size, $saturn_tan);
	if($display_names == true){
		@imagestring ($system, 5, $saturn_row-$saturn_size/2, $saturn_col-$saturn_size+60, "Saturn", $saturn_tan);
	}
	
	////
	// Uranus
	////
    $uranus_vx = $uranus_vx + $uranus_ax * $delta_time; // New velocity
	$uranus_vy = $uranus_vy + $uranus_ay * $delta_time; // New velocity
	$uranus_x = $uranus_x + $uranus_vx * $delta_time; // New position
	$uranus_y = $uranus_y + $uranus_vy * $delta_time; // New position
	$uranus_r = sqrt(pow($uranus_x,2) + pow($uranus_y,2)); // Orbital radius at this position
	$uranus_a =  $uranus_au_from_sun / pow($uranus_r, 2); // Acceleration / angle
	$uranus_ax = -$uranus_a * $uranus_x / $uranus_r; // Divide the force for the angle between x & y
	$uranus_ay = -$uranus_a * $uranus_y / $uranus_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$uranus_row = MinMax($uranus_y, $low, $high, $size);
	$uranus_col = MinMax($uranus_x, $low, $high, $size);
	// Plot Uranus
	@imagefilledellipse ($system, round($uranus_row), round($uranus_col), $uranus_size, $uranus_size, $uranus_blue);
	if($display_names == true){
		@imagestring ($system, 5, $uranus_row-$uranus_size, $uranus_col-$uranus_size+25, "Uranus", $uranus_blue);
	}
	
	////
	// Neptune
	////
    $neptune_vx = $neptune_vx + $neptune_ax * $delta_time; // New velocity
	$neptune_vy = $neptune_vy + $neptune_ay * $delta_time; // New velocity
	$neptune_x = $neptune_x + $neptune_vx * $delta_time; // New position
	$neptune_y = $neptune_y + $neptune_vy * $delta_time; // New position
	$neptune_r = sqrt(pow($neptune_x,2) + pow($neptune_y,2)); // Orbital radius at this position
	$neptune_a =  $neptune_au_from_sun / pow($neptune_r, 2); // Acceleration / angle
	$neptune_ax = -$neptune_a * $neptune_x / $neptune_r; // Divide the force for the angle between x & y
	$neptune_ay = -$neptune_a * $neptune_y / $neptune_r; // Divide the force for the angle between x & y
	// Normalize positions to be within the image bounds
	$neptune_row = MinMax($neptune_y, $low, $high, $size);
	$neptune_col = MinMax($neptune_x, $low, $high, $size);
	// Plot Neptune
	@imagefilledellipse ($system, round($neptune_row), round($neptune_col), $neptune_size, $neptune_size, $neptune_blue);
	if($display_names == true){
		@imagestring ($system, 5, $neptune_row-$neptune_size, $neptune_col-$neptune_size+25, "Neptune", $neptune_blue);
	}

    @imagestring ($system, 5, 5, 5, round($i/$frames_per_earth_year, 2) . " Years (" . round((365/$frames_per_earth_year)*$i, 2) . " days)" , $interface_green);

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
         <img src="all-planets-sol-system-orbit.gif" alt="all planets sol system orbit">
	 </center>

	</body>
</html>
<?php
}
?>
