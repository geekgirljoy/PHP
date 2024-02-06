<?php

function RadiansToAngleDegrees($radians){
    return $radians * 180 / PI(); // angle degrees
}

function AngleDegreesToRadians($angle_degrees){
    return $angle_degrees * PI() /  180; // radians
}

function ScreenSpaceToPolar($x, $y, $screen_width, $screen_height){
    //
    // Adjust "Screen Space" coordinates (Never negitive, x rows and y columns) to be relative to the Cartesian and Polar Coordinates center
    // Basically... 
    // if c is ScreenSpaceXY[0,0] and Cartesian[0,0]
    // and p is the "screen/image center" of the "Screen Space", p(x = width / 2, y = height / 2) = Polar Center
    // and the "screen/image center" is also the Polar coordinates center (like measuring/drawing a circle around the center of the screen/image)
    // and n is the x & y "Screen Space" (image x row & y column) coordinates of interest for converting to polar coordinates...
    //
    // Then we can shift the positive only x & y Screen Space coordinates to Cartesian Polar relative coordinates
    // by "moving/projecting" p to c, or rather, calculating the offset of n from p as though p were c
    // by subtracting p[x] from n[x] and n[y] from p[y]
    //
    // Oversimplified Example:
    //
    // screen width = 16
    // screen height = 16
    // screen x center = (16 / 2 (half the horizontal width)) = 8
    // screen y center = (16 / 2 (half the vertical height)) = 8
    //
    // If our point/pixel coordinate n is xy[4,4] then...
    //
    // x offset from p = n[x] - (screen width / 2) = -4  from center p on x axis
    // x offset from p = (4 - 8) = -4
    // y offset from p = (screen height / 2) - n[y] = +4 from center p on y axis
    // y offset from p = (8 - 4) = +4
    //
    // Oversimplified Example Screen Space:
    // 
    //               -y
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //    -x ------------c---------------x+
    //                   |
    //                   |  n
    //                   |
    //                   |       p
    //                   | [In Screen Space]
    //                   |
    //                   |
    //                  +y
    //
    // Oversimplified Example Shifted to Polar:
    //
    //                  +y
    //                   |
    //                   |
    //                   |
    // [In               |
    // Polar Cartesian   |
    //       Space]      |
    //              n    |
    //                   |
    //    -x ------------p---------------x+
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                   |
    //                  -y
    //
    
    // Polar center = screen center
    $polar_center_x = $screen_width / 2;
    $polar_center_y = $screen_height / 2;
    
    // Find/Calculate Polar center
    $polar_center_x_offset = $x - $polar_center_x;
    $polar_center_y_offset = $polar_center_y - $y;

    // Calculate r = radius from Polar center to our point
    $r = sqrt(pow($polar_center_x_offset, 2) + pow($polar_center_y_offset, 2));
    
    // Store the radius in a dictionary with a zero as yet to be calculated theta value
    $polar = ['radius'=>$r, 'theta'=>0];


    // Calculate theta (the "angle" in radians) of n given p
    if($polar_center_x_offset > 0){
        if($polar_center_y_offset >= 0){
            $polar['theta'] = atan($polar_center_y_offset/$polar_center_x_offset);
        }else{
            $polar['theta'] = (PI() * 2) + atan($polar_center_y_offset/$polar_center_x_offset);
        }
    }else{
        if($polar_center_x_offset == 0){
            if($polar_center_y_offset > 0){
                $polar['theta'] = (PI() / 2);
            }else{
                $polar['theta'] = (PI() * 3) / 2;
            }
        }else{
            $polar['theta'] = PI() + atan($polar_center_y_offset/$polar_center_x_offset);            
        }
    }
    
    return $polar;
}

// Example usage with screen dimensions - does not need to be a square (only positive numbers)
$screen_height = 1024;
$screen_width = 1024;


$East = ScreenSpaceToPolar($screen_width, $screen_height / 2, $screen_width, $screen_height); // Cardinal East
$NorthEast = ScreenSpaceToPolar($screen_width, 0, $screen_width, $screen_height); // Ordinal North East
$North = ScreenSpaceToPolar($screen_width / 2, 0, $screen_width, $screen_height); // Cardinal North
$NorthWest = ScreenSpaceToPolar(0, 0, $screen_width, $screen_height); // Ordinal North West
$West = ScreenSpaceToPolar(0, $screen_height / 2, $screen_width, $screen_height); // Cardinal West
$SouthWest = ScreenSpaceToPolar(0, $screen_height, $screen_width, $screen_height); // Ordinal South West
$South = ScreenSpaceToPolar($screen_width / 2, $screen_height, $screen_width, $screen_height); // Cardinal South
$SouthEast = ScreenSpaceToPolar($screen_width, $screen_height, $screen_width, $screen_height); // Ordinal South East

/*
var_dump($East['theta']);
echo RadiansToAngleDegrees($East['theta']) . PHP_EOL . PHP_EOL;
var_dump($NorthEast['theta']);
echo RadiansToAngleDegrees($NorthEast['theta']) . PHP_EOL . PHP_EOL;
var_dump($North['theta']);
echo RadiansToAngleDegrees($North['theta']) . PHP_EOL . PHP_EOL;
var_dump($NorthWest['theta']);
echo RadiansToAngleDegrees($NorthWest['theta']) . PHP_EOL . PHP_EOL;
var_dump($West['theta']);
echo RadiansToAngleDegrees($West['theta']) . PHP_EOL . PHP_EOL;
var_dump($SouthWest['theta']);
echo RadiansToAngleDegrees($SouthWest['theta']) . PHP_EOL . PHP_EOL;
var_dump($South['theta']);
echo RadiansToAngleDegrees($South['theta']) . PHP_EOL . PHP_EOL;
var_dump($SouthEast['theta']);
echo RadiansToAngleDegrees($SouthEast['theta']) . PHP_EOL . PHP_EOL;
*/


// Find the boundries between the Cardinal and Ordinal directions
$Boundry_between_East_And_NorthEast = AngleDegreesToRadians(RadiansToAngleDegrees($East['theta']) + 22.5);
$Boundry_between_NorthEast_And_North = AngleDegreesToRadians(RadiansToAngleDegrees($NorthEast['theta']) + 22.5);
$Boundry_between_North_And_NorthWest = AngleDegreesToRadians(RadiansToAngleDegrees($North['theta']) + 22.5);
$Boundry_between_NorthWest_And_West = AngleDegreesToRadians(RadiansToAngleDegrees($NorthWest['theta']) + 22.5);
$Boundry_between_West_And_SouthWest = AngleDegreesToRadians(RadiansToAngleDegrees($West['theta']) + 22.5);
$Boundry_between_SouthWest_And_South = AngleDegreesToRadians(RadiansToAngleDegrees($SouthWest['theta']) + 22.5);
$Boundry_between_South_And_SouthEast = AngleDegreesToRadians(RadiansToAngleDegrees($South['theta']) + 22.5);
$Boundry_between_SouthEast_And_East = AngleDegreesToRadians(RadiansToAngleDegrees($SouthEast['theta']) + 22.5);



// Create a blank image with the screen dimensions
$image = @imagecreate($screen_width, $screen_height);

// Allocate the colors we'll be using
$background_color = imagecolorallocate($image, 0, 0, 0); // We'll never see this color, but it's good to have a background color.. cause why not?
$R = imagecolorallocate($image, 255, 0, 0); // R is for red
$O = imagecolorallocate($image, 255, 165, 0); // O is for orange
$Y = imagecolorallocate($image, 255, 255, 0); // Y is for yellow
$G = imagecolorallocate($image, 0, 255, 0); // And G is for green
$B = imagecolorallocate($image, 0, 0, 255); // B is for blue
$I = imagecolorallocate($image, 75, 0, 130); // I for indigo
$V = imagecolorallocate($image, 127, 0, 255); // And V is for violet
$C = imagecolorallocate($image, 0, 255, 255); // C is for Cyan
/*
And that spells Roy G. Biv. + C :-P
Roy G. BivC is a colorful man
And his name spells out the whole (visible) color spectrum... plus Cyan
*/

// For all the rows and columns in the image
for($y = 0; $y <= $screen_height; $y++){
    for($x = 0; $x <= $screen_width; $x++){

        // Convert the Screen Space coordinates to Polar coordinates
        $polar = ScreenSpaceToPolar($x, $y, $screen_width, $screen_height);
        $theta = $polar['theta'];
        
        // Assign a color to the pixel based on the Polar coordinates, and the boundries between the Cardinal and Ordinal directions
        if($theta <= $Boundry_between_East_And_NorthEast){
            imagesetpixel($image, $x, $y, $R); // Facing East is Red
        }elseif($theta <= $Boundry_between_NorthEast_And_North){
            imagesetpixel($image, $x, $y, $O); // Facing North East is Orange
        }elseif($theta <= $Boundry_between_North_And_NorthWest){
            imagesetpixel($image, $x, $y, $Y); // Facing North is Yellow
        }elseif($theta <= $Boundry_between_NorthWest_And_West){
            imagesetpixel($image, $x, $y, $G); // Facing North West is Green
        }elseif($theta <= $Boundry_between_West_And_SouthWest){
            imagesetpixel($image, $x, $y, $B); // Facing West is Blue
        }elseif($theta <= $Boundry_between_SouthWest_And_South){
            imagesetpixel($image, $x, $y, $I); // Facing South West is Indigo
        }elseif($theta <= $Boundry_between_South_And_SouthEast){
            imagesetpixel($image, $x, $y, $V); // Facing South is Violet
        }elseif($theta <= $Boundry_between_SouthEast_And_East){
            imagesetpixel($image, $x, $y, $C); // Facing South East is Cyan
        }
        else{
            imagesetpixel($image, $x, $y, $R); // Facing East is Red
        }
    }
}

// Save the image to a file
imagepng($image, "PolarColorWheel.png");

// Free up memory
imagedestroy($image);
