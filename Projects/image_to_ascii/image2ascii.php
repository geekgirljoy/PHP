<?php 


// ASCII gradient based on the percieved luminocity of the pixel and the ASCII character
$ascii_intencity_gradient = [
    "@", // 0 - 25.5
    "%", // 25.5 - 51
    "#", // 51 - 76.5
    "*", // 76.5 - 102
    "+", // 102 - 127.5
    "=", // 127.5 - 153
    "-", // 153 - 178.5
    ":", // 178.5 - 204
    ".", // 204 - 229.5
    " "  // 229.5 - 255
];
$ascii_intencity_gradient_inverted = array_reverse($ascii_intencity_gradient); // Use me for inverted luminocity gradient

// Function to get and return an image using GD library
function GetImage($image_path) {
    // image_type
    $image_type = exif_imagetype($image_path);
    if ($image_type == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($image_path);
    } elseif ($image_type == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($image_path);
    }else {
        return false;
    }
    return $image;
}

// Function to get the luminocity of the pixel using (R+G+B)/3
function GetLuminocity($r, $g, $b) {
    return ($r + $g + $b) / 3;
}

// Function to get the ASCII character based on the luminocity and the length of the ascii_intencity_gradient arrayd
function GetAsciiChar($luminocity, $ascii_intencity_gradient) {
    $length = count($ascii_intencity_gradient);
    $step = 255 / $length;
    $index = floor($luminocity / $step);

    // Make sure the index is within the range of the ascii_intencity_gradient array
    if ($index >= $length) {
        $index = $length - 1;
    }
    return $ascii_intencity_gradient[$index];
}

// Array of images to convert to ASCII
$image_to_convert = array(
    '1337.jpg',
    '40217541018.jpg',
    '75160852579.jpg',
    '88250271418.jpg',
    'TicTacToe.jpg'
);

// Loop through the images
foreach ($image_to_convert as $image_name) {
    // Get the image
    $image = GetImage(__DIR__ . '/' . $image_name);

    // Get the image width and height
    $width = imagesx($image);
    $height = imagesy($image);

    // Create an array to hold the ASCII image based on the width and height of the image
    $ascii_image = [];


    $color_graident = $ascii_intencity_gradient;
    //$color_graident = $ascii_intencity_gradient_inverted; // use me for inverted color gradient



    // Based on the width and height of the image
    // loop through the image and get the pixel color
    // get the luminocity of the pixel
    // get the ASCII character based on the luminocity
    // populate the ascii_image array with the ASCII character
    for ($y = 0; $y < $height; $y++) {
        $ascii_image[$y] = '';
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $luminocity = GetLuminocity($r, $g, $b);
            $ascii_image[$y] .= GetAsciiChar($luminocity, $color_graident);
        }
    }

    // Loop through the ascii_image array and print the ASCII image
    foreach ($ascii_image as $line) {
        echo $line . PHP_EOL;
    }

    // Save the ASCII image to a file
    file_put_contents(__DIR__ . "/$image_name.txt", implode(PHP_EOL, $ascii_image));
}