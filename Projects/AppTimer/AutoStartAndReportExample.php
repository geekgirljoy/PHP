<?php
 
include('AppTimer.Class.php');   // Include AppTimer class file
 
 
// Use true or 1 to Auto Start the Timer when the object is instantiated
$Timer = new AppTimer(1);

usleep(1000000); // wait for 1 seconds
echo $Timer->Report() . PHP_EOL; // Use Report() before Timer is stopped to get elapsed time 
usleep(3000000); // wait for 3 seconds
 
echo $Timer->Stop(1) . PHP_EOL;  // Use true or 1 to Auto Report
echo $Timer->Report() . PHP_EOL; // Report() wont change after Stop() 


// Destroy $Timer Object
$Timer = NULL; // Reclaim memory immediately by overwriting NULL on Timer object's memory space                  
unset($Timer); // Let Garbage Collection know it can eat the variable

