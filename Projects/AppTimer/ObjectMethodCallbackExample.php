<?php
 
include('AppTimer.Class.php');   // Include AppTimer class file

// Example Class Object
class ExampleClassObject {
		
    // Method without args
    function HelloWorld() {
        echo 'Hello World' . PHP_EOL;
    }
    
    // Method with args
    function Add($a, $b) {
        if(is_numeric($a) && is_numeric($b)){
		    echo "Add($a, $b) = " . ($a + $b) . PHP_EOL;
		}
    }
}




$Timer = new AppTimer(); // New Timer Object
$Example = new ExampleClassObject(); // Create instance of your object


// Time an object method without args
$HelloWorld_method_run_time = $Timer->CallbackTimer(array($Example, 'HelloWorld'));


// Time an object method with args
$Add_method_run_time = $Timer->CallbackTimer(array($Example, 'Add'), array(9, 1));


// Destroy $Timer Object
$Timer = NULL; // Reclaim memory immediately by overwriting NULL on Timer object's memory space                  
unset($Timer); // Let Garbage Collection know it can eat the variable


// Echo Results
echo "\$Example->HelloWord() Run Time: $HelloWorld_method_run_time" . PHP_EOL;
echo "\$Example->Add(9, 1) Run Time: $Add_method_run_time" . PHP_EOL;
