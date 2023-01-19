<?php

// This function will return the combined histograms, it's intended for use with the Histogram function below
function CombineHistograms($histogram_a, $histogram_b){
    $h = array_fill(0, 256, 0);
    foreach($histogram_a as $key => $value){
        $h[$key] += $value;
    }
    foreach($histogram_b as $key => $value){
        $h[$key] += $value;
    }
    return $h;
}

// This function will return the histogram for an image
// Assumes the image is a jpg, png, or gif and that they are encoded as 8 bit (256 colors)
// $color_channels is the color channel histogram to return:
// Separate histograms for the color channels can be returned by passing 'r', 'g', 'b', 'a', 'rgb', or 'rgba'
// 'r' = red
// 'g' = green
// 'b' = blue
// 'a' = alpha
// Combine histograms for the color channels by passing 'rgb' or 'rgba'
// and will return a histogram for the combined color channels as an intensity histogram
// 'rgb' = red + green + blue 
// 'rgba' = red + green + blue + alpha
// If no color channel is specified, the intensity histogram will be returned
// example: $histogram = Histogram('image.jpg'); // Get the intensity (rgb) histogram for the image
// example: $histogram = Histogram('image.jpg', ['rgb']); // Get the intensity histogram for the image
// example: $histogram = Histogram('image.png', ['rgba']); // Get the intensity histogram for the image including the alpha channel
// example: $histogram = Histogram('image.jpg', ['r']); // Get the red histogram for the image
// example: $histogram = Histogram('image.png', ['a']); // Get the alpha histogram for the image
// example: $histogram = Histogram('image.png', ['r', 'g', 'b']); // Get the separate red, green, and blue histograms for the image
function Histogram($image_path, $color_channels = array('rgb')){

    // Get the image extension from the path
    $extension = pathinfo($image_path, PATHINFO_EXTENSION);

    // Check the extension and create the image
    if($extension == "jpg" || $extension == "jpeg"){
        $image = imagecreatefromjpeg($image_path);
    } else if($extension == "png"){
        $image = imagecreatefrompng($image_path);
    } else if($extension == "gif"){
        $image = imagecreatefromgif($image_path);
    } else {
        return false; // Invalid image type, do not pass go, do not collect $200 dollars... No histogram for you!
    }

    // Get the image size
    $width = imagesx($image);
    $height = imagesy($image);

    // Create an array to hold the histograms and initialize all keys to 0
    $h = array();
    $h['r'] = array_fill(0, 256, 0);
    $h['g'] = array_fill(0, 256, 0);
    $h['b'] = array_fill(0, 256, 0);
    $h['a'] = array_fill(0, 256, 0);

    // Loop through the image
    for($x = 0; $x < $width; $x++){
        for($y = 0; $y < $height; $y++){

            // Get the pixel color
            $rgba = imagecolorat($image, $x, $y);

            // Extract the rgba values from the color
            $a = ($rgba >> 24) & 0xFF; // alpha
            $r = ($rgba >> 16) & 0xFF; // red
            $g = ($rgba >> 8) & 0xFF; // green
            $b = $rgba & 0xFF; // blue

            // Increment the count for the colors
            $h['r'][round($r)]++;
            $h['g'][round($g)]++;
            $h['b'][round($b)]++;
            $h['a'][round($a)]++;
        }
    }

    // Create the histogram array to return
    $histogram = [];
    if(in_array('r', $color_channels)){ // Check if the red histogram should be returned
        $histogram['r'] = $h['r'];
    }
    if(in_array('g', $color_channels)){ // Check if the green histogram should be returned
        $histogram['g'] = $h['g'];
    }
    if(in_array('b', $color_channels)){ // Check if the blue histogram should be returned
        $histogram['b'] = $h['b'];
    }
    if(in_array('a', $color_channels)){ // Check if the alpha histogram should be returned
        $histogram['a'] = $h['a'];
    }
    if(in_array('rgb', $color_channels)){ // Check if the rgb intensity histogram should be returned
        // Combine the red, green, and blue histograms
        $histogram['rgb'] = CombineHistograms($h['r'], $h['g']);
        $histogram['rgb'] = CombineHistograms($histogram['rgb'], $h['b']);
        // divide by 3 to get the average
        foreach($histogram['rgb'] as $key => $value){
            $histogram['rgb'][$key] = round($value / 3);
        }
    }
    if(in_array('rgba', $color_channels)){ // Check if the rgba intensity histogram should be returned
        // Combine the red, green, blue, and alpha histograms
        $histogram['rgba'] = CombineHistograms($h['r'], $h['g']);
        $histogram['rgba'] = CombineHistograms($histogram['rgba'], $h['b']);
        $histogram['rgba'] = CombineHistograms($histogram['rgba'], $h['a']);
        // divide by 4 to get the average
        foreach($histogram['rgba'] as $key => $value){
            $histogram['rgba'][$key] = round($value / 4);
        }
    }

    // Unset the histograms array since we don't need it anymore
    unset($h);

    // Return the histogram
    return $histogram;
}

// A Cumulative Histogram is a histogram that shows the cumulative sum of the pixels for each intensity value
// It is useful for determining the threshold for binarization and other image processing operations
function CumulativeHistogram($histogram){
    $cumulative_histogram = [];
    $cumulative_histogram[0] = $histogram[0];
    for($i = 1; $i < count($histogram); $i++){
        $cumulative_histogram[$i] = $cumulative_histogram[$i - 1] + $histogram[$i];
    }
   
    return $cumulative_histogram;
}

// Get the rgb grayscale intensity histogram for the image
$histogram = Histogram('Untitled.png', ['rgb']);

// Get the cumulative histogram
$cumulative_histogram = CumulativeHistogram($histogram['rgb']);

echo "Histogram: ";
// Print the histogram
print_r($histogram);

echo "Cumulative Histogram: ";
// Print the cumulative histogram
print_r($cumulative_histogram);
