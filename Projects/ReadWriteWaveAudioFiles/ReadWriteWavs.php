<?php

require_once 'JoysWaveReader.class.php';

define("POSITIVE_SIGN", 0);
define("NEGATIVE_SIGN", 1);

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

//////////////////////////////////////////////////////////////////////

$files = array('220HzSaw.wav','220HzSine.wav','220HzSquare.wav');

$wav_reader = new JoysWaveReader;

foreach($files as $file_name){

    echo "Processing $file_name...";

    // Read the audio file
    if(@$wav_reader->ReadWaveFile(__DIR__ . '/WAVs/' . $file_name)){
        $wav_reader->Decode(); // Unpack the data

        // Create seperate copies of the data for different processing effects
        $positive = $wav_reader->audio_file_data;
        $negative = $wav_reader->audio_file_data;

        // Filter for only positive amplitude values
        ExclusiveSign($positive['DataChunk']['Data'], POSITIVE_SIGN, $positive['FMTChunk']['BitsPerSample']); // Leave only positive
        
        // Filter for only negative amplitude values
        ExclusiveSign($negative['DataChunk']['Data'], NEGATIVE_SIGN, $negative['FMTChunk']['BitsPerSample']); // Leave only negative

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
