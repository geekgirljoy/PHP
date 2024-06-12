<?php

// Please dear runtime environment... no memory limit :)
ini_set('memory_limit', '-1');

// Include the JoysWaveReader class
require_once 'JoysWaveReader.class.php';

// Positively Negitive!
define("POSITIVE_SIGN", 0);
define("NEGATIVE_SIGN", 1);

// Color modes for color codes
define("COLOR_GRAYSCALE", 0);
define("COLOR_RGB", 1);

// Extract exclusive sign (positive || negative) amplitude from audio data 
function ExclusiveSign(&$data, $sign, $bits_per_sample){
    $number_of_samples = count($data); // How many samples are in the data array
    for($i=1; $i < $number_of_samples; $i++){// For all the samples
        $bin_data = decbin($data[$i]); // Convert value to binary
        $bin_data_length = count(str_split($bin_data)); // Split binary value to arr and count
        if($bin_data_length < $bits_per_sample){ // If the bin arr is < than bits in sample
            $prepend_length  = $bits_per_sample -  $bin_data_length; // compute how short it is
            $bin_data = str_repeat('0', $prepend_length) . $bin_data; // prepend 0's
        }
        if($bin_data[0] != $sign){ // Value is NOT the sign we want
            $data[$i] = 0; // Attenuate value to zero
        }
    }
}

// Hello, my name is Scale() and we might have met before
// I'll be adjusting the size of your data today so you don't want to upset me by passing nonnumeric data
// We'll be traveling from $min_value to $max_value and I'll be adjusting the data 
// to fit between $min_scaled_value and $max_scaled_value
// Once we're in the air the pilot will turn off the seat belt light and you'll be free 
// to move about the cabin, I'll come by then with some peanuts and a drink and take your data scale orders
// I hope you enjoy your flight with Scale() and thank you for choosing JoysWaveReader
function Scale($dataset, $min_scaled_value, $max_scaled_value){

    $min_value = min($dataset);
    $max_value = max($dataset);

    foreach($dataset as &$n){
        $n = ($max_scaled_value - $min_scaled_value) * ($n - $min_value) / ($max_value - $min_value) + $min_scaled_value;
    }
    
    return $dataset;
}

//////////////////////////////////////////////////////////////////////

$files = array('220HzSaw.wav','220HzSine.wav','220HzSquare.wav');
$color_mode = COLOR_RGB;

$wav_reader = new JoysWaveReader;

foreach($files as $file_name){

    echo "Processing $file_name...";

    // Read the audio file
    if(@$wav_reader->ReadWaveFile(__DIR__ . '/WAVs/' . $file_name)){
        $wav_reader->Decode(); // Unpack the data

        ////////////////////////////////////////////////////////////////////////
        // EXTRACT POSITIVE AND NEGATIVE AMPLITUDE VALUES
        ////////////////////////////////////////////////////////////////////////

        // Create separate copies of the data for different processing effects
        $positive = $wav_reader->audio_file_data;
        $negative = $wav_reader->audio_file_data;

        // Filter for only positive amplitude values
        ExclusiveSign($positive['DataChunk']['Data'], POSITIVE_SIGN, $positive['FMTChunk']['BitsPerSample']); // Leave only positive
        
        // Filter for only negative amplitude values
        ExclusiveSign($negative['DataChunk']['Data'], NEGATIVE_SIGN, $negative['FMTChunk']['BitsPerSample']); // Leave only negative


        ////////////////////////////////////////////////////////////////////////
        // DRAW THE AUDIO DATA TO AN IMAGE
        ////////////////////////////////////////////////////////////////////////
        // Get the square root of the $wav_reader->audio_file_data count() so we can plot the data to a square image, so we round up to the nearest whole number using ceil()
        $square_root = ceil(sqrt(count($wav_reader->audio_file_data['DataChunk']['Data'])));
        
        // Scale() Airlines now boarding. All passengers in Sector 12 DataChunk, all the data to Sector 12 please and have your passports ready for inspection and scaling, and please remember to discard any non-numeric contraband before embarking
        $wav_reader->audio_file_data['DataChunk']['Data'] = Scale($wav_reader->audio_file_data['DataChunk']['Data'], 0, 765); // scale the data between 0 & 765 (255*3 = rgb)

        // Create a square image from the audio data
        $image = imagecreatetruecolor($square_root, $square_root);
        $color = imagecolorallocate($image, 0, 0, 0); // black

        // Loop through the audio data and plot the data to the image
        $x = 0;
        $y = 0;
        foreach($wav_reader->audio_file_data['DataChunk']['Data'] as $value){

            // Lets decide the color of the pixel
            $color = array('red' => 0, 'green' => 0, 'blue' => 0); // I'm black by default

            // But I might be a different color
            if($color_mode == COLOR_GRAYSCALE){// Actually, I'm a shade of gray
                $color = array('red' => round($value/3), 'green' => round($value/3), 'blue' => round($value/3));
            }
            else if($color_mode == COLOR_RGB){ // Nope, I'm definitely a color
                if($value <= 255){
                    $color['red'] = $value;
                }
                else if($value <= 510){
                    $color['red'] = 255;
                    $color['green'] = $value - 255;
                }
                else{
                    $color['red'] = 255;
                    $color['green'] = 255;
                    $color['blue'] = $value - 510;
                }
            }
            
            // Draw the pixel
            imagesetpixel($image, $x, $y, imagecolorallocate($image, $color['red'], $color['green'], $color['blue']));

            // Move to the next pixel
            $x++; 
            if($x >= $square_root){ // If we're at the end of the row
                $x = 0; // Back to the first column
                $y++; // Move down a row
            }
        }

        ////////////////////////////////////////////////////////////////////////
        // SAVE THE FILES
        ////////////////////////////////////////////////////////////////////////

        // Save the image to the disk
        imagepng($image, __DIR__ . '/WAVs/'. basename($wav_reader->audio_file_data['File']['Filename'], '.wav') . ".png");
        imagedestroy($image);

        // RePack positive data and write to file
        $wav_reader->audio_file_data = $positive;
        $wav_reader->Encode();
        $wav_reader->WriteWaveFile(__DIR__ . '/WAVs/'. basename($wav_reader->audio_file_data['File']['Filename'], '.wav') . "-only_positive.wav");

        // RePack negative data and write to file
        $wav_reader->audio_file_data = $positive;
        $wav_reader->Encode();
        $wav_reader->WriteWaveFile(__DIR__ . '/WAVs/'. basename($wav_reader->audio_file_data['File']['Filename'], '.wav') . "-only_negative.wav");
        
        echo " Done!" . PHP_EOL;
    }
    else{ // ReadWaveFile() returned false
        echo ' Missing File Data!' . PHP_EOL;
    }
}
