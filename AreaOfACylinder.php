<?php
/*
Area of a Cylinder is equal to 6.28318530718 ( 2 * Pi ) times the radius of the Cylinder, times the sum of the Radius plus the Height.

Area = (2 * Pi) * R * ( R + H )

This number will be in square
*/

$cylinder_radius = 7;
$cylinder_height = 22;

$area = ( 2 * pi() ) * $cylinder_radius * ( $cylinder_radius + $cylinder_height);

// note the . (period) is the concatenation symbol and
// you can concatenate numbers and string like below
echo "The area of your cylinder is: " . $area;

// will output: The area of your cylinder is: 1275.4866173575


?>