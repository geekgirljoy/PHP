<?php

// The image to create a displacement map from
$image_path = "building.png";

// Open the image
$image = imagecreatefrompng($image_path);

// Convert the image to grayscale
imagefilter($image, IMG_FILTER_GRAYSCALE);

// Invert the image
imagefilter($image, IMG_FILTER_NEGATE);

// Adjust the image contrast
imagefilter($image, IMG_FILTER_CONTRAST, -100);

// Save the image
imagepng($image, "displacement_map.png");

// Free up memory
imagedestroy($image);

?>
