<?php

define('P', "<p>");
define('p', "</p>" . PHP_EOL);
define('BR', "<br/>" . PHP_EOL);

$myArray = [];

echo P . 'Building myArray';
for($i = 0; $i <= 9; $i++){
	array_push($myArray, 'Item ' . $i);
	echo '.';
}
echo ' done!' . p;

echo P . 'Echoing myArray:' . BR;
foreach($myArray as $key=>$value){
	echo '[' . $key . ']: ' . $value . BR;
}
echo ' done!' . p;
?>