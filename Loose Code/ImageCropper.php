<?php

/*

Single Image Example:
php ImageCropper.php some_input_directory_path some_output_directory_path 137 105 878 549 imagename.png

Crop All Images in Folder Example:
php ImageCropper.php some_input_directory_path some_input_directory_path\cropped 0 0 255 255


*/



// https://www.php.net/manual/en/reserved.variables.argv.php
if(empty($argv)){
    $message = 'Missing Command Line Args:' . PHP_EOL;
    $message .= 'TO CROP AN ENTIRE FOLDER - USE: ' . $argv[0] . ' INPUT_DIR OUTPUT_DIR X Y WIDTH HEIGHT' . PHP_EOL;
    $message .= 'TO CROP A SINGLE IMAGE - USE: ' . $argv[0] . ' INPUT_DIR OUTPUT_DIR X Y WIDTH HEIGHT IMAGE_NAME' . PHP_EOL;
    die($message);
}

/////////////////////////////////
// Get Args as Named Variables //
/////////////////////////////////

$in_directory = rtrim($argv[1], " \\/\n\r\t\v\x00");
$out_directory = rtrim($argv[2], " \\/\n\r\t\v\x00");
$x = $argv[3];
$y = $argv[4];
$width = $argv[5];
$height = $argv[6];
$file = '';
if(isset($argv[7])){
    $file = $argv[7];
}


/////////////////////////////////
// Error Checking & Correcting //
/////////////////////////////////

if(!is_dir($in_directory)){ // INPUT_DIR (arg 1) is not a directory
    $message = 'INPUT_DIR invalid: ' . $in_directory . ' is not a valid folder' . PHP_EOL;
    die($message);
}

is_dir($out_directory) || mkdir($out_directory); // Quietly make the OUTPUT_DIR if it doesn't already exist

// Make sure the size variables are numbers
if(!is_numeric($x)){
    $x = 0;
} 
if(!is_numeric($y)){
    $y = 0;
}
if(!is_numeric($width)){
    $width = 0;
}
if(!is_numeric($height)){
    $height = 0;
}


/////////////////////////
// Collect Image Paths //
/////////////////////////
$supported_file_types = array('jpg', 'jpeg', 'png');
$images = array();
if($file != ''){ // arg 7 (IMAGE_NAME) is not empty
    if(!is_dir($in_directory . DIRECTORY_SEPARATOR . $file) ){ // and is not a directory
    
        // Is the file type unsupported
        if(!in_array(strtolower(pathinfo($in_directory . DIRECTORY_SEPARATOR . $file)['extension']),  $supported_file_types)){
            $message = 'Unsupported File Format: ' . $image_extension . PHP_EOL;
            $message .= 'SUPPORTED FILE FORMATS: jpg, jpeg, png' . PHP_EOL;
            die($message);
        }
        
        $images = array($in_directory . DIRECTORY_SEPARATOR . $file); // Single image
    }
    else{
        $message = 'Arg 7 (IMAGE_NAME) is a folder not an image: ' . $file . PHP_EOL;
        die($message);
    }
}
else{ // No file (arg 7) provided
    $images = glob($in_directory . DIRECTORY_SEPARATOR . "*.{jpg,jpeg,png}", GLOB_BRACE); // Is folder
}


////////////////////////////
// GO GO CROPPING POWERS! //
////////////////////////////
if(count($images) > 0){
    foreach($images as $image){ // For all the image paths
            
        // Obtain File Extension
        $image_extension = strtolower(pathinfo($image)['extension']);
        
        
        // Load Image
        if($image_extension == 'jpg' || $image_extension == 'jpeg'){
            $img = imagecreatefromjpeg($image);
        }
        elseif($image_extension == 'png'){
            $img = imagecreatefrompng($image);
        }
        
        
        // Crop Image
        if($width == 0){ // Crop size was invalid
            $width = imagesx($img); // Select entire image width to be non-destructive
        }
        if($height == 0){// Crop size was invalid
            $height = imagesy($img); // Select entire image height to be non-destructive
        }
        $img = imagecrop($img, array('x' => $x, 'y' => $y, 'width' => $width, 'height' => $height));
        
        
        // Save Image
        $save_path = $out_directory . DIRECTORY_SEPARATOR . pathinfo($image)['filename'] . ".cropped.$image_extension";
        if($image_extension == 'jpg' || 'jpeg'){
            imagejpeg($img, $save_path);
        }
        elseif($image_extension == 'png'){
            imagepng($img, $save_path);
        }
        
    }
}
