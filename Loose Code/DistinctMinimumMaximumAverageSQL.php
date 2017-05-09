<?php

// DistinctMinimumMaximumAverageSQL

function Distinct($field, $conn, $table){
	$SQL = "SELECT DISTINCT `". $field ."` FROM `$table` ORDER BY `$table`.`" . $field . "` ASC";
	$result = mysqli_query($conn, $SQL);
	return $result->num_rows;
}

function Minimum($field, $conn, $table){
	$SQL = "SELECT MIN(`". $field ."`) FROM `$table`";
	return mysqli_query($conn, $SQL);
}

function Maximum($field, $conn, $table){
	$SQL = "SELECT MAX(`". $field ."`) FROM `$table`";
	return mysqli_query($conn, $SQL);
}

function Average($field, $conn, $table){
	$SQL = "SELECT AVG(`". $field ."`) FROM `$table`";
	return mysqli_query($conn, $SQL);
}


// DB Credentials
$hostname = "127.0.0.1";
$username = "CHANGE-TO-DB-USERNAME";
$dbname = "CHANGE-TO-YOUR-DATABASE";
$password = "CHANGE-TO-YOUR-PASSWORD";
$port = 3306;

$connection = mysqli_connect($hostname, $username, $password, $dbname, $port)or die(mysql_error());


// Example Use:

// Totals / sort each pertinent param
$ethnicityTotal = Distinct('ethnicity', $connection, "mock_data");
$genderTotal = Distinct('gender', $connection, "mock_data");
$primaryLanguagesTotal = Distinct('primaryLanguages', $connection, "mock_data");
$secondaryLanguagesTotal = Distinct('secondaryLanguages', $connection, "mock_data");
$sexualPreferenceTotal = Distinct('sexualPreference', $connection, "mock_data");
$zipCodeTotal = Distinct('zipCode', $connection, "mock_data");
$stateTotal = Distinct('state', $connection, "mock_data");
$relationshipPreferenceTotal = Distinct('relationshipPreference', $connection, "mock_data");
$religionTotal = Distinct('religion', $connection, "mock_data");
$politicalTotal = Distinct('political', $connection, "mock_data");

//--- MIN & MAX each pertinent param
$youngest = Maximum('birthDate', $connection, "mock_data");
$oldest = Minimum('birthDate', $connection, "mock_data");
$shortest = Minimum('height', $connection, "mock_data");
$tallest = Maximum('height', $connection, "mock_data");
$averageHeight = Average('height', $connection, "mock_data");
$fewestKids = Minimum('numberOfKids', $connection, "mock_data");
$mostKids = Maximum('numberOfKids', $connection, "mock_data");
$averageKids = Average('numberOfKids', $connection, "mock_data");
$lowestIncome = Minimum('annualIncome', $connection, "mock_data");
$highestIncome = Maximum('annualIncome', $connection, "mock_data");
$averageIncome = Average('annualIncome', $connection, "mock_data");

?>

