<?php
// https://en.wikipedia.org/wiki/Pythagorean_theorem
/*
    The Pythagorean theorem states that the area of the square 
    whose side is the hypotenuse (the side opposite the right angle) is equal to 
    the sum of the areas of the squares on the other two sides.
    
    The theorem can be written as an equation relating the lengths of the sides:
    a (ajacent side), b (opposite side) and c (hypotenuse), where c is the longest side:
    a^2 + b^2 = c^2
*/
function Pythagorean($ajacent, $opposite) {
    $hypotenuse = sqrt(pow($ajacent, 2) + pow($opposite, 2)); // a^2 + b^2 = c^2
    return $hypotenuse;
}


// Imgagine a triangle like this:

/*
   /|
h / |
 /  | b
/___|
  a
  
  a = 3
  b = 4
  h = ?
*/

echo Pythagorean(3, 4); // h = 5
