<?php

include('AppTimer.Class.php');     // Include AppTimer class file

$Timer = new AppTimer();           // Create Timer
$Timer->Start();                   // Start() Timer

// Code you want to time

$Timer->Stop();                    // Stop() Timer
echo $Timer->Report() . PHP_EOL;   // Report()


// Destroy $Timer Object
$Timer = NULL; // Reclaim memory immediately by overwriting NULL on Timer object's memory space                  
unset($Timer); // Let Garbage Collection know it can eat the variable
