<?php

// This code extracts pixel data from an image and saves it in another image
// using a mask image to determine which pixels to copy
// transparent pixels are not copied whereas opaque pixels are copied
// the mask image is assumed to be the same size as the source image and
// with the same name as the source image but in a different directory
// images are saved to a different directory called "output"


// Path to the transparency mask images
$mask_images_path = 'mask_images/';

// Path to the images to be masked
$images_path = 'images/';

// Path to save the images
$save_path = 'output/';

// If the output directory does not exist, create it
if (!file_exists($save_path)) {
    mkdir($save_path);
}

// Glob the mask images
$mask_images = glob($mask_images_path . '*.png');

// Glob the images to be masked
$images = glob($images_path . '*.png');

// Natural sort the images because glob doesn't
// ie. we want: 0001.png, 0002.png, 0003.png, 0004.png, 0005.png, 0006.png, 0007.png, 0008.png, 0009.png, 0010.png, 0011.png, 0012.png, ...
// instead of 0001.png, 00010.png, 00011.png, 00012.png, 0002.png, 0003.png, 0004.png, 0005.png, 0006.png, 0007.png, 0008.png, 0009.png, ...
natsort($images);

// Loop through the images
foreach ($images as $image) {

    // Get the image name
    $image_name = basename($image);

    // Log the image name
    echo "Processing $image_name" . PHP_EOL;

    // Open the image and mask image
    $image = imagecreatefrompng($image);
    $mask = imagecreatefrompng($mask_images_path . $image_name);

    // Create a new image with alpha channel
    $new_image = imagecreatetruecolor(imagesx($image), imagesy($image));

    // Fill the new image with transparent color
    $transparent = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    imagefill($new_image, 0, 0, $transparent);

    // Save the alpha channel
    imagesavealpha($new_image, true);

    // Get the image size
    $image_width = imagesx($image);
    $image_height = imagesy($image);

    // Loop through the image pixels
    for ($x = 0; $x < $image_width; $x++) {
        for ($y = 0; $y < $image_height; $y++) {

            // Get the pixel color
            $pixel_color = imagecolorat($image, $x, $y);

            // Get the mask pixel color
            $mask_pixel_color = imagecolorat($mask, $x, $y);

            // Get the alpha value
            $alpha = ($mask_pixel_color >> 24) & 0xFF;

            // If the pixel is not transparent
            if ($alpha <= 0) {

                // convert the pixel color to rgba
                $rgba = imagecolorsforindex($image, $pixel_color);

                // allocate the pixel color in the new image
                $pixel_color = imagecolorallocatealpha($new_image, $rgba['red'], $rgba['green'], $rgba['blue'], $rgba['alpha']);

                // Set the pixel color in the new image
                imagesetpixel($new_image, $x, $y, $pixel_color);
            }
        }
    }

    // Save the image
    imagepng($new_image, $save_path . $image_name);

    // Destroy the image
    imagedestroy($new_image);
    imagedestroy($image);
    imagedestroy($mask);
}
?>
