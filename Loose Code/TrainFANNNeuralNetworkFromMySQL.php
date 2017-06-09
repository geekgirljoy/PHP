<?php
/*
Author: Joy Harvel
Date: 09/21/2016
*/


set_time_limit ( 300 ); // 5 minutes - Adjust as needed


// MySQL for This Example:
/*
CREATE TABLE `TrainingSets` (
  `ID` int(11) NOT NULL,
  `Name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrainingData` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `TrainingSets` ADD PRIMARY KEY (`ID`);
 
INSERT INTO `TrainingSets` (`ID`, `Name`, `TrainingData`) VALUES(1, 'XOR', '-1 -1\n-1\n-1 1\n1\n1 -1\n1\n1 1\n-1');
ALTER TABLE `TrainingSets` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
*/


// This function will setup the $table table in your database and
// then insert the XOR Training Data
function CreateTable($host, $user, $pass, $database, $table, $field){
    
    $result = false;
    
    // Create connection
    $connection = new mysqli($host, $user, $pass, $database);
    // Check connection
    if ($connection->connect_error) {
        die('Connection failed: ' . $connection->connect_error);
    }
    // sql to create $table table
    $sql = "CREATE TABLE `$table` (
  `ID` int(11) NOT NULL,
  `Name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `$field` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    if ($connection->query($sql) === TRUE) {
        echo "Table $table created successfully.<br>";
        
        // sql to set the ID field as the PRIMARY KEY
        $sql = "ALTER TABLE `$table` ADD PRIMARY KEY (`ID`)";
        if ($connection->query($sql) === TRUE) {
            echo "PRIMARY KEY set to ID.<br>";
            
            // sql to insert XOR into DB
            $sql = "INSERT INTO `$table` (`ID`, `Name`, `$field`) VALUES(1, 'XOR', '-1 -1\n-1\n-1 1\n1\n1 -1\n1\n1 1\n-1')";
            if ($connection->query($sql) === TRUE) {
                echo "XOR inserted into DB.<br>";
                // sql to "auto increment" ID when new $table are added
                $sql = "ALTER TABLE `$table` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";
                if ($connection->query($sql) === TRUE) {
                    echo 'ID will AUTO_INCREMENT.<br>';
                    $result = TRUE;
                } else {
                    echo 'Error altering ID: ' . $connection->error . '<br>';
                }
            } else {
                echo 'Error inserting XOR into DB: ' . $connection->error . '<br>';
            }
        } else {
            echo 'Error setting PRIMARY KEY to ID: ' . $connection->error . '<br>';
        }
    } else {
        echo "Error creating $table table: " . $connection->error . '<br>';
    }
    $connection->close();
    
    return $result;
}

// This function calls/pulls the TrainingData from MySQL
function GetTrainingDataFromDB($host, $user, $password, $database, $table_name, $field, $id) {
    $connection=mysqli_connect($host, $user, $password, $database); // open db connection
    $result=mysqli_query($connection,"SELECT $field FROM $table_name WHERE ID=$id"); // query the db
    $data=mysqli_fetch_assoc($result); // pull training data
    mysqli_close($connection); // close connection
    return $data[$field]; // return training data
}

// This function prepares the newline delimited data to be handed off to FANN
/*
Example of "newline delimited data" (like XOR in a Plain Text File) stored in MySQL:
-1 -1
-1
-1 1
1
1 1
-1
1 -1
1
*/
function PrepareDataFromDB($training_data) {
    $training_data = explode("\n", $training_data); // convert training data rows to array
    $num_data = count($training_data);
	   
    // Sift the data and split inputs and outputs
    for($i=0;$i<$num_data;$i++) {
      if($i % 2) { // $training_data[$i] is Output
       $training_data['outputs'][] = explode(' ', $training_data[$i]);
      }else{ // $training_data[$i] is Input
       $training_data['inputs'][] = explode(' ', $training_data[$i]);
      }
    }
    // remove the unsifted data
    foreach ($training_data as $key => $value) {
        if (is_numeric($key)) {
            unset($training_data[$key]);
        }
    }
    return $training_data; // returned the prepared associative array
}

// This function hands the prepared data over to FANN
function create_train_callback($num_data, $num_input, $num_output) {
    global $training_data;
    global $current_dataset;
  
    $dataset = array('input' => $training_data['inputs'][$current_dataset],
                    'output' => $training_data['outputs'][$current_dataset]);
    $current_dataset++;
	
    return $dataset;
}




// Change to your DB credentials
$host = '127.0.0.1';
$user = 'username';
$password = 'password';
$database = 'test';
$table = 'TrainingSets';
$field = 'TrainingData';

// Insert training data into the database
CreateTable($host, $user, $password, $database, $table, $field); 



// Initialize the program variables
$record_id = 1; // the 'ID' for the training data in MySQL
$current_dataset = 0;
$num_input = 2;
$num_output = 1;
$num_layers = 3;
$num_neurons = 3;
$desired_error = 0.001;
$max_epochs = 500000;
$epochs_between_reports = 1000;

// Get the Training Data from MySQL
$training_data = GetTrainingDataFromDB($host, $user, $password, $database, $table, $field, $record_id);

// Prepare the data
$training_data = PrepareDataFromDB($training_data); 


// How many sets are there?
$num_data = count($training_data['inputs']); 

// Hand the data over to FANN
$train_data = fann_create_train_from_callback($num_data, $num_input, $num_output, "create_train_callback");



// Test for $train_data
if ($train_data) {

    // Create $ann
    $ann = fann_create_standard($num_layers, $num_input, $num_neurons, $num_output);
	
	 

    // Test for $ann
    if ($ann) {
        fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
        fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);
		
		$result = fann_train_on_data($ann, $train_data, $max_epochs, $epochs_between_reports, $desired_error);

		
		// Train XOR ANN with training data obtained from MySQL
        if (fann_train_on_data($ann, $train_data, $max_epochs, $epochs_between_reports, $desired_error))
		{
           echo 'XOR trained.<br>' . PHP_EOL;
           // Test $ann
           $input = array(-1, 1);
           $calc_out = fann_run($ann, $input);
           printf("XOR test (%f,%f) -> %f\n", $input[0], $input[1], $calc_out[0]);
          
           // destroy $ann
           fann_destroy($ann);
         }
    }
}


echo "<br>All Done!";


?>
