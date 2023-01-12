<?php
// This script is used to scan/photograph images for photogrammetry
// It uses ffmpeg to get the image from a webcam
// It uses SAPI on Windows, Say on Mac, eSpeak on Linux to announce the scanning process and facilitate hands free operation

$number_of_images = 100; // How many images we want to take, change this to suit your needs
$current_image_number = 1; // The current image number
$dataset_name = 'Test2'; // The name of the dataset in the Datasets folder
$save_path = 'Datasets'; // The path to the Datasets folder

// If the Datasets folder does not exist, create it
if(!file_exists($save_path)){
    mkdir($save_path);
}

// If the dataset folder does not exist, create it
if(!file_exists("$save_path/$dataset_name")){
    mkdir("$save_path/$dataset_name");
}

// Get the OS type
$OS = strtoupper(substr(PHP_OS, 0, 3));

if($OS === 'WIN'){ // Windows
    $ffmpeg_path = 'ffmpeg.exe';

    // SAPI voice for hands free monitoring of the scanning process
    $voice = new COM("SAPI.SpVoice");
    $file_stream = new COM("SAPI.SpFileStream");
    $voice->Voice = $voice->GetVoices()->Item(1); // Change $voice to Zira
}
elseif($OS === 'LIN'){ // Linux
    $ffmpeg_path = 'ffmpeg';

    // eSpeak voice for hands free monitoring of the scanning process
    $voice = "espeak";
}
elseif($OS === 'DAR'){     // Mac
    $ffmpeg_path = 'ffmpeg';

    // Say voice for hands free monitoring of the scanning process
    $voice = "say -v 'Victoria'";
}
else{
    die('Unsupported OS');
}

// Function to handle cross platform text to speech
function SAY($OS, $voice, $statement){
    if($OS === 'WIN'){
        $voice->Speak($statement);
    }elseif($OS === 'LIN' || $OS === 'DAR'){
        exec("$voice '$statement'");
    }
}

// Announce that the scanning process is ready to begin
$statement = "I am ready to scan $number_of_images images for the $dataset_name data set.";
echo $statement . PHP_EOL;
SAY($OS, $voice, $statement);

// Wait for the user to press [ENTER]
$statement = "Press [ENTER] to continue...";
echo $statement . PHP_EOL;
SAY($OS, $voice, $statement);
fgetc(STDIN); // listen for a key press

// Begin scanning
while($current_image_number <= $number_of_images){
    // Announce the current image number
    $statement = "Taking image $current_image_number";
    echo $statement;
    SAY($OS, $voice, $statement);

    // Get the image from the webcam
    $cmd = "ffmpeg.exe -nostats -loglevel 0 -f vfwcap -i 0 -vframes 1 -y $save_path/$dataset_name/image$current_image_number.jpg";
    exec($cmd);

    // Announce that the image has been taken
    $statement = 'Image taken.';
    echo " - $statement" . PHP_EOL;
    SAY($OS, $voice, $statement);

    // Increment the image number
    $current_image_number++;
}

// Announce that the scanning process is complete
$statement = "Scanning complete";
echo $statement . PHP_EOL;
SAY($OS, $voice, $statement);

// Announce how many images were taken
$statement = "I have taken $number_of_images images for the $dataset_name data set.";
echo $statement . PHP_EOL;
SAY($OS, $voice, $statement);
