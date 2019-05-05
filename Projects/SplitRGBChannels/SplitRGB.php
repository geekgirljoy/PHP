<?php

function SplitRGBChannels(&$img){
        // get image size
	$width = ImagesX($img);
	$height = ImagesY($img);

	// create image resources
	$monochrome_red = ImageCreateTrueColor($width, $height);
	$monochrome_green = ImageCreateTrueColor($width, $height);
	$monochrome_blue = ImageCreateTrueColor($width, $height);

	// black background otherwise
        ImageColorAllocate($monochrome_red, 0, 0, 0);
        ImageColorAllocate($monochrome_green, 0, 0, 0);
        ImageColorAllocate($monochrome_blue, 0, 0, 0);
		
	// for all the rows and columns in the input image
	for($row = 0; $row < $width; $row++){
		for($col = 0; $col < $height; $col++){
			
			
			$pixel = ImageColorAt($img, $row, $col); // get the color for the pixel 
			$colors = ImageColorsForIndex($img, $pixel); // make human readable 
             
                        // allocate the red value of the pixel to the red image and draw the pixel
			$red_color = ImageColorAllocate($monochrome_red, $colors['red'], 0, 0);
			ImageSetPixel($monochrome_red, $row, $col, $red_color);
			
			// allocate the green value of the pixel to the green image and draw the pixel
			$green_color = ImageColorAllocate($monochrome_green, 0, $colors['green'], 0);
			ImageSetPixel($monochrome_green, $row, $col, $green_color);
			
			// allocate the blue value of the pixel to the blue image and draw the pixel
			$blue_color = ImageColorAllocate($monochrome_blue, 0, 0, $colors['blue']);
			ImageSetPixel($monochrome_blue, $row, $col, $blue_color);
		}
	}
	return array('red'=>$monochrome_red, 'green'=>$monochrome_green, 'blue'=>$monochrome_blue);
}

//$image_filename = 'YellowField.jpg';      // courtesy of https://pixabay.com/photos/view-yellow-sky-nature-women-2162026/
//$image_filename = 'RotterdamSkyline.jpg'; // courtesy of https://pixabay.com/photos/rotterdam-new-mesh-maastoren-4152380/
//$image_filename = 'Fern.jpg';             // courtesy of https://pixabay.com/photos/fern-leaves-green-nature-purity-821293/
$image_filename = 'PlouzaneLighthouse.jpg'; // courtesy of https://pixabay.com/photos/plouzane-lighthouse-france-landmark-1758197/

$image = ImageCreateFromJpeg($image_filename); // Load $image into memory
$color_channels = SplitRGBChannels($image);    // Get array of images separated by color channel
ImageDestroy($image); // Free $image from memory

// for all the images in the $color_channels array
foreach($color_channels as $color=>$img){
	ImageJPEG($img, Basename($image_filename, '.jpg') . "-$color.jpg"); // save separated color channel
	ImageDestroy($img); // Free $img from memory
}
