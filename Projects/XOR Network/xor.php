<?php

/*
$$\   $$\  $$$$$$\  $$$$$$$\  
$$ |  $$ |$$  __$$\ $$  __$$\ 
\$$\ $$  |$$ /  $$ |$$ |  $$ |
 \$$$$  / $$ |  $$ |$$$$$$$  |
 $$  $$<  $$ |  $$ |$$  __$$< 
$$  /\$$\ $$ |  $$ |$$ |  $$ |
$$ /  $$ | $$$$$$  |$$ |  $$ |
\__|  \__| \______/ \__|  \__| from scratch... in PHP no less! ¯\㋡/¯
*/


////////////////////////////////////////////////////////////////////////
// 84 104 101 32 70 117 110 99 116 105 111 110 115                    //
////////////////////////////////////////////////////////////////////////

// My activation function
function Sigmoid($x) {
    return 1 / (1 + exp(-$x)); // Returns the sigmoid of x
}

// My derivative of the activation function
function SigmoidDerivative($x) {
    return $x * (1 - $x); // Returns the derivative of the sigmoid function
}

// My feed forward function
function FeedForward($inputs, $weights) {
    $hidden = array();

    // Calculate the hidden layer 
    $hidden[0] = Sigmoid($inputs[0] * $weights[0] + $inputs[1] * $weights[1] + $weights[2]);
    $hidden[1] = Sigmoid($inputs[0] * $weights[3] + $inputs[1] * $weights[4] + $weights[5]);
    
    // Calculate the output layer
    $output = Sigmoid($hidden[0] * $weights[6] + $hidden[1] * $weights[7] + $weights[8]);

    return array('hidden'=>$hidden, 'output'=>$output); // Return the hidden layer and output
}

// My back propagation function
function BackPropagate($inputs, $expected, $weights, $learning_rate) {
    // Feed forward
    $feed_forward = FeedForward($inputs, $weights);
    $hidden = $feed_forward['hidden'];
    $output = $feed_forward['output'];
    unset($feed_forward); // Free up some random access memories

    // Calculate error
    $output_error = $expected - $output;
    $output_delta = $output_error * SigmoidDerivative($output);

    // Calculate hidden layer error and delta
    $hidden_error = array();
    $hidden_delta = array();
    $hidden_error[0] = $output_delta * $weights[6];
    $hidden_delta[0] = $hidden_error[0] * SigmoidDerivative($hidden[0]);
    $hidden_error[1] = $output_delta * $weights[7];
    $hidden_delta[1] = $hidden_error[1] * SigmoidDerivative($hidden[1]);

    // Update weights
    $weights[0] += $learning_rate * $inputs[0] * $hidden_delta[0];
    $weights[1] += $learning_rate * $inputs[1] * $hidden_delta[0];
    $weights[2] += $learning_rate * $hidden_delta[0];
    $weights[3] += $learning_rate * $inputs[0] * $hidden_delta[1];
    $weights[4] += $learning_rate * $inputs[1] * $hidden_delta[1];
    $weights[5] += $learning_rate * $hidden_delta[1];
    $weights[6] += $learning_rate * $hidden[0] * $output_delta;
    $weights[7] += $learning_rate * $hidden[1] * $output_delta;
    $weights[8] += $learning_rate * $output_delta;

    return $weights; // Return the updated weights
}

// My training function
function Train($inputs, $expected, $weights, $learning_rate, $iterations, $desired_error) {
    echo "Training...";
    for ($i = 0; $i < $iterations; $i++) {
        for ($j = 0; $j < count($inputs); $j++) {
            $weights = BackPropagate($inputs[$j], $expected[$j], $weights, $learning_rate);
        }
    }
    echo "Done!" . PHP_EOL;
    return $weights;
}

// My testing function
function Test($inputs, $weights, $expected, $desired_error){
    echo  "Testing..." . PHP_EOL;
    for ($i = 0; $i < count($inputs); $i++) {
        
        $output = FeedForward($inputs[$i], $weights)['output'];
        echo "Input: [" . $inputs[$i][0] . "," . $inputs[$i][1] . "] Output: " . $output . " Expected: " . $expected[$i];
        echo " Error: " . abs($output - $expected[$i]);

        // If the error is greater than $desired_error, 
        // The network is not trained well enough so echo Incorrect otherwise echo Correct
        echo (abs($expected[$i] - $output) > $desired_error) ? " Incorrect" : " Correct";

        echo PHP_EOL;
    }
    echo "Done!" . PHP_EOL;
}

// My save function
function Save($weights, $filename){
    echo "Saving network...";
    $file = fopen($filename . '.net', 'w');
    fwrite($file, serialize($weights));
    fclose($file);
    echo "Done!" . PHP_EOL;
}

// My load function
function Load($filename){
    echo "Loading network...";
    $weights = unserialize(file_get_contents($filename . '.net'));
    echo "Done!" . PHP_EOL;
    return $weights;
}

////////////////////////////////////////////////////////////////////////
// 84 104 101 32 86 97 114 105 97 98 108 101 115                      //
////////////////////////////////////////////////////////////////////////

// My inputs
$inputs = array(
    array(0, 0), // Input set 1
    array(0, 1), // Input set 2
    array(1, 0), // Input set 3
    array(1, 1)  // Input set 4
);

// My outputs
$expected = array(
    1, // Expected output for input set 1
    0, // Expected output for input set 2
    0, // Expected output for input set 3
    1  // Expected output for input set 4
);

// My training settings
$learning_rate = 0.1;
$iterations = 1000000;
$desired_error = 0.01;

// My weights
// Create 9 random $weights between 0 and 1
$weights = array();
for ($i = 0; $i < 9; $i++) {
    $weights[$i] = rand(0, 1000) / 1000;
}


////////////////////////////////////////////////////////////////////////
// 84 104 101 32 67 111 100 101                                       //
////////////////////////////////////////////////////////////////////////

// Train the network
$weights = Train($inputs, $expected, $weights, $learning_rate, $iterations, $desired_error);

// Test the network
Test($inputs, $weights, $expected, $desired_error);

// Save the network
Save($weights, 'xor');

echo "Removing the network from memory...";
unset($weights);// Destroy the network (just for fun)
// Prove the weights are gone from memory
//var_dump($weights); // PHP Warning:  Undefined variable $weights in ..\..\..\xor.php on line 173
echo 'Done!' . PHP_EOL;

// Load the network (just for fun)
$weights = Load('xor');

// Re-Test the network
echo "Re-";
Test($inputs, $weights, $expected, $desired_error);

// Use: php xor.php
// Results:
/*
Training...Done!
Testing...
Input: [0,0] Output: 0.99606812753431 Expected: 1 Error: 0.0039318724656874 Correct
Input: [0,1] Output: 0.0033024618219977 Expected: 0 Error: 0.0033024618219977 Correct
Input: [1,0] Output: 0.0033022982637739 Expected: 0 Error: 0.0033022982637739 Correct
Input: [1,1] Output: 0.99664237432973 Expected: 1 Error: 0.0033576256702694 Correct
Done!
Saving network...Done!
Removing the network from memory...Done!
Loading network...Done!
Re-Testing...
Input: [0,0] Output: 0.99606812753431 Expected: 1 Error: 0.0039318724656874 Correct
Input: [0,1] Output: 0.0033024618219977 Expected: 0 Error: 0.0033024618219977 Correct
Input: [1,0] Output: 0.0033022982637739 Expected: 0 Error: 0.0033022982637739 Correct
Input: [1,1] Output: 0.99664237432973 Expected: 1 Error: 0.0033576256702694 Correct
Done!
*/

?>
