<?php
 
include('AppTimer.Class.php');   // Include AppTimer class file


$Timer = new AppTimer(); // New Timer Object

echo $Timer->GetTime(89003) . PHP_EOL; // pass the number of seconds

// Destroy $Timer Object
$Timer = NULL; // Reclaim memory immediately by overwriting NULL on Timer object's memory space                  
unset($Timer); // Let Garbage Collection know it can eat the variable
