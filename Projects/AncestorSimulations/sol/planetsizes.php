<!DOCTYPE html>
<html>
    <head>
        <title>Ancestor Simulations The Sol System - Planet Sizes</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body style="background-color:black; color:white;">
<?php

////
// Create Solar System
////
$size = 4096;
$system = imagecreatetruecolor(2500, 2000);
$space_black = imagecolorallocate($system, 0, 0, 0);


////
// Define Sun
////
$sun_size = 10 * 109; // Size
$sun_x = $sun_size; // center the sun on x
$sun_y = $sun_size; // center the sun on y
$sun_yellow = imagecolorallocate($system, 255, 255, 0); // Color

////
// Define Mercury
////
$mercury_size = 10 * 0.38; // Size
$mercury_grey = imagecolorallocate($system, 100, 100, 100); // Color
$mercury_x = $sun_size + $sun_size/2 + 50; // Initial x position
$mercury_y = $sun_size; // Initial y position

////
// Define Venus
////
$venus_size= 10 * 0.95; // Size
$venus_brown = imagecolorallocate($system, 150, 100, 0); // Color
$venus_x = $sun_size + $sun_size/2 + 150; // Initial x position
$venus_y = $sun_size; // Initial y position

////
// Define Earth
////
$earth_size = 10; // Size
$earth_blue = imagecolorallocate($system, 0, 0, 255); // Color
$earth_x = $sun_size + $sun_size/2 + 250; // Initial x position
$earth_y = $sun_size; // Initial y position

////
// Define Mars
////
$mars_size = 10 * 0.93; // Size
$mars_red = imagecolorallocate($system, 255, 0, 0); // Color
$mars_x = $sun_size + $sun_size/2 + 350; // Initial x position
$mars_y = $sun_size; // Initial y position

////
// Define Jupiter
////
$jupiter_size = 10 * 11.19; // Size
$jupiter_red = imagecolorallocate($system, 255, 0, 0); // Color
$jupiter_x = $sun_size + $sun_size/2 + 80; // Initial x position
$jupiter_y = $sun_size + 150; // Initial y position

////
// Define Saturn
////
$saturn_size = 10 *9.40; // Size
$saturn_tan = imagecolorallocate($system, 210,180,140); // Color
$saturn_x = $sun_size + $sun_size/2 + 200; // Initial x position
$saturn_y = $sun_size + 150; // Initial y position

////
// Define Uranus
////
$uranus_size = 10 * 4.04; // Size
$uranus_blue = imagecolorallocate($system, 173,216,230); // Color
$uranus_x = $sun_size + $sun_size/2 + 300; // Initial x position
$uranus_y =  $sun_size + 150; // Initial y position

////
// Define Neptune
////
$neptune_size = 10 * 3.88 ; // Size
$neptune_blue = imagecolorallocate($system, 100,200,255); // Color
$neptune_x = $sun_size + $sun_size/2 + 380; // Initial x position
$neptune_y = $sun_size + 150; // Initial y position


@imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow);
@imagefilledellipse ( $system, $mercury_x, $mercury_y , $mercury_size, $mercury_size, $mercury_grey);
@imagefilledellipse ( $system, $venus_x, $venus_y, $venus_size, $venus_size, $venus_brown );
@imagefilledellipse ( $system, $earth_x, $earth_y, $earth_size, $earth_size, $earth_blue );
@imagefilledellipse ( $system, $mars_x, $mars_y, $mars_size, $mars_size, $mars_red);
@imagefilledellipse ($system, $jupiter_x, $jupiter_y, $jupiter_size, $jupiter_size, $jupiter_red);
@imagefilledellipse ($system, $saturn_x, $saturn_y, $saturn_size, $saturn_size, $saturn_tan);
@imagefilledellipse ($system, $uranus_x, $uranus_y, $uranus_size, $uranus_size, $uranus_blue);
@imagefilledellipse ($system, $neptune_x, $neptune_y, $neptune_size, $neptune_size, $neptune_blue);


@imagestring ( $system, 5, $sun_x , $sun_y , "Sun" , $space_black );
@imagestring ( $system, 5, $mercury_x, $mercury_y + 10, "Mercury", $mercury_grey);
@imagestring ( $system, 5, $venus_x, $venus_y + 10, "Venus" , $venus_brown );
@imagestring ( $system, 5, $earth_x, $earth_y + 10, "Earth" , $earth_blue );
@imagestring ( $system, 5, $mars_x, $mars_y + 10, "Mars" , $mars_red );
@imagestring ($system, 5, $jupiter_x, $jupiter_y + 60, "Jupiter", $jupiter_red);
@imagestring ($system, 5, $saturn_x, $saturn_y + 50, "Saturn", $saturn_tan);
@imagestring ($system, 5, $uranus_x, $uranus_y + 25, "Uranus", $uranus_blue);
@imagestring ($system, 5, $neptune_x, $neptune_y + 25, "Neptune", $neptune_blue);


$interface_green = imagecolorallocate($system, 0,255,0); // Color
@imagestring ($system, 5, $sun_size + $sun_size/2 + 90,  $sun_size - 100, "Solar System Size Comparison" , $interface_green);
@imagestring ($system, 5, $sun_size + $sun_size/2 + 125,  $sun_size - 30, "Inner Rocky Planets" , $interface_green);
@imagestring ($system, 5, $sun_size + $sun_size/2 + 125,  $sun_size + 75, "Outer Gas Giants" , $interface_green);


// Output image
imagepng($system, "planetsizes.png");
// free memory
imagedestroy($system);

?>
     <center>
         <img src="planetsizes.png" alt="Sizes">
	 </center>

	</body>
</html>
