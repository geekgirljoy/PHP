<?php

class JoysWaveReader {
    
    public $audio_file_data = array(); // Key Store for Parsed File Chunks
    
    // Pass the path and name of a file
    function ReadWaveFile($file){
        $file_handle = fopen($file, 'r'); // Open Wav File

        $raw_bytes = array(); // Raw bytes will be read 1 byte at a time into this array
                              // until the entire file has been read
                              
        while (!feof($file_handle)) { // From now till the end of the file
                $raw_bytes[] = fread($file_handle, 1); // Read 1 byte of data until the EOF
        }
        fclose($file_handle); // Close Wav File
        
        // Clear the array of any residual data from previous reads
        $this->audio_file_data = array();
        
        $this->audio_file_data['File']['Filename'] = $file; // Store the name of the file
        $this->audio_file_data['Header']['Size'] = 0;
        
        $byte_count = count($raw_bytes);
        for($i = 0; $i < $byte_count;$i++){ // For all the bytes
            
            $four_bytes = $raw_bytes[$i] . $raw_bytes[$i+1] . $raw_bytes[$i+2] . $raw_bytes[$i+3];
            
            if($four_bytes == 'RIFF'){ // Probably Bytes 0-4
                $this->audio_file_data['Header']['Type'] = 'RIFF';
                $this->audio_file_data['Header']['Size'] += 4;
            }
            elseif($four_bytes == 'WAVE'){ // Probably Bytes 8-12
                $this->audio_file_data['Header']['Format'] = 'WAVE';
                $this->audio_file_data['Header']['Size'] += 4;
            }
            elseif($four_bytes == 'fmt '){ // Probably Bytes 12-16
                $this->audio_file_data['FMTChunk']['ID'] = 'fmt ';
                $this->audio_file_data['FMTChunk']['FMTChunkSize'] = $raw_bytes[$i+4] . $raw_bytes[$i+5] . $raw_bytes[$i+6] . $raw_bytes[$i+7]; // 4 Bytes
                $this->audio_file_data['Header']['Size'] += unpack('V', $this->audio_file_data['FMTChunk']['FMTChunkSize'])[1];
                $this->audio_file_data['FMTChunk']['AudioFormat'] = $raw_bytes[$i+8] . $raw_bytes[$i+9]; // 2 Bytes
                $this->audio_file_data['FMTChunk']['NumberOfChannels'] = $raw_bytes[$i+10] . $raw_bytes[$i+11]; // 2 Bytes
                $this->audio_file_data['FMTChunk']['SampleRate'] = $raw_bytes[$i+12] . $raw_bytes[$i+13] . $raw_bytes[$i+14] . $raw_bytes[$i+15]; // 4 Bytes
                $this->audio_file_data['FMTChunk']['ByteRate'] = $raw_bytes[$i+16] . $raw_bytes[$i+17] . $raw_bytes[$i+18] . $raw_bytes[$i+19]; // 4 Bytes
                $this->audio_file_data['FMTChunk']['BlockAlign'] = $raw_bytes[$i+20] . $raw_bytes[$i+21]; // 2 Bytes
                $this->audio_file_data['FMTChunk']['BitsPerSample'] = $raw_bytes[$i+22] . $raw_bytes[$i+23]; // 2 Bytes
            }
            elseif($four_bytes == 'data'){ // YAY WE FOUND THE DATA CHUNK!!!!
                $this->audio_file_data['DataChunk']['ID'] = 'data';
                $this->audio_file_data['DataChunk']['DataChunkSize'] = $raw_bytes[$i+4] . $raw_bytes[$i+5] . $raw_bytes[$i+6] . $raw_bytes[$i+7]; // 4 Bytes
                $data_chunk_size = unpack('V', $this->audio_file_data['DataChunk']['DataChunkSize'])[1]; // Unpack to get
                $this->audio_file_data['Header']['Size'] += $data_chunk_size;
                for($k = $i+8; $k <= $data_chunk_size; $k++){
                    $this->audio_file_data['DataChunk']['Data'] .= $raw_bytes[$k]; // Read all of the Samples Data 1 Byte at a time
                }
            }
        } // / For all the bytes

        // If we can haz all the dataz
        if($this->audio_file_data['Header']['Type'] == 'RIFF'
           && $this->audio_file_data['Header']['Format'] == 'WAVE'
           && $this->audio_file_data['FMTChunk']['ID'] != NULL
           && $this->audio_file_data['DataChunk']['ID'] != NULL){
                 return true;
        }
      return false;
    }

    function WriteWaveFile($name){
	$file_handle = fopen($name, 'w'); // Open wav file for writing
        fwrite($file_handle, $this->audio_file_data['Header']['Type'], 4);// Write Bytes 0-4
	fwrite($file_handle, $this->audio_file_data['Header']['Size'], 4);// Write Bytes 4-8
        fwrite($file_handle, $this->audio_file_data['Header']['Format'], 4);// Write Bytes 8-12
	fwrite($file_handle, strtolower($this->audio_file_data['FMTChunk']['ID']), 4);// Write Bytes 12-16
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['FMTChunkSize'], 4);// Write Bytes 16-20
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['AudioFormat'], 2);// Write Bytes 20-22
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['NumberOfChannels'], 2);// Write Bytes 22-24
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['SampleRate'], 4);// Write Bytes 24-28
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['ByteRate'], 4);// Write Bytes 28-32
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['BlockAlign'], 2);// Write Bytes 32-34
	fwrite($file_handle, $this->audio_file_data['FMTChunk']['BitsPerSample'], 2);// Write Bytes 34-36
	fwrite($file_handle, strtolower($this->audio_file_data['DataChunk']['ID']), 4);// Write Bytes 36-40
	fwrite($file_handle, $this->audio_file_data['DataChunk']['DataChunkSize'], 4);// Write Bytes 40-44
	fwrite($file_handle, $this->audio_file_data['DataChunk']['Data']);// Write Bytes 44-EOF
        fclose($file_handle); // Close Wav File
    }


    function Decode(){
	$this->audio_file_data['Header']['Size'] = unpack('V', $this->audio_file_data['Header']['Size'])[1]; // File size in kb
        $this->audio_file_data['FMTChunk']['FMTChunkSize'] = unpack('V', $this->audio_file_data['FMTChunk']['FMTChunkSize'])[1]; // 4 Bytes
        $this->audio_file_data['FMTChunk']['AudioFormat'] = unpack('v', $this->audio_file_data['FMTChunk']['AudioFormat'])[1]; // 2 Bytes
        $this->audio_file_data['FMTChunk']['NumberOfChannels'] = unpack('v', $this->audio_file_data['FMTChunk']['NumberOfChannels'])[1]; // 2
        $this->audio_file_data['FMTChunk']['SampleRate'] = unpack('V', $this->audio_file_data['FMTChunk']['SampleRate'])[1]; // 4 Bytes
        $this->audio_file_data['FMTChunk']['ByteRate'] = unpack('V', $this->audio_file_data['FMTChunk']['ByteRate'])[1]; // 4 Bytes
        $this->audio_file_data['FMTChunk']['BlockAlign'] = unpack('v', $this->audio_file_data['FMTChunk']['BlockAlign'])[1]; // 2 Bytes
        $this->audio_file_data['FMTChunk']['BitsPerSample'] = unpack('v', $this->audio_file_data['FMTChunk']['BitsPerSample'])[1]; // 2 Bytes
        $this->audio_file_data['DataChunk']['DataChunkSize'] = unpack('V', $this->audio_file_data['DataChunk']['DataChunkSize'])[1]; // 4 Bytes
        $this->audio_file_data['DataChunk']['Data'] = unpack('v*', $this->audio_file_data['DataChunk']['Data']); // All Data Bytes
    }

    function Encode(){
      $this->audio_file_data['Header']['Size'] = pack('V', $this->audio_file_data['Header']['Size']); // File size in kb
        $this->audio_file_data['FMTChunk']['FMTChunkSize']    = pack('V', $this->audio_file_data['FMTChunk']['FMTChunkSize']);
        $this->audio_file_data['FMTChunk']['AudioFormat'] = pack('v', $this->audio_file_data['FMTChunk']['AudioFormat']); // 2 Bytes
        $this->audio_file_data['FMTChunk']['NumberOfChannels'] = pack('v', $this->audio_file_data['FMTChunk']['NumberOfChannels']); // 2 Bytes
        $this->audio_file_data['FMTChunk']['SampleRate'] = pack('V', $this->audio_file_data['FMTChunk']['SampleRate']); // 2 Bytes
        $this->audio_file_data['FMTChunk']['ByteRate'] = pack('V', $this->audio_file_data['FMTChunk']['ByteRate']); // 4 Bytes
        $this->audio_file_data['FMTChunk']['BlockAlign'] = pack('v', $this->audio_file_data['FMTChunk']['BlockAlign']); // 2 Bytes
        $this->audio_file_data['FMTChunk']['BitsPerSample'] = pack('v', $this->audio_file_data['FMTChunk']['BitsPerSample']); // 2 Bytes
        $this->audio_file_data['DataChunk']['DataChunkSize'] = pack('V', $this->audio_file_data['DataChunk']['DataChunkSize']); // 4 Bytes
        $data = $this->audio_file_data['DataChunk']['Data'];
        $this->audio_file_data['DataChunk']['Data'] = '';
	foreach($data as $datachunk){
            $this->audio_file_data['DataChunk']['Data'] .= pack('v*', $datachunk); // 4 Bytes
        }
    }
}

// $wav_reader = new JoysWaveReader;
