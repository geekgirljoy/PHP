<?php
define('ENDL', '<br>' . PHP_EOL); // clean html break with default OS line break added

echo '<strong>String:</strong> ' . $my_string = strtoupper('Name:Joy');

echo ENDL . ENDL;

// Positions
$key_end = (strpos($my_string, ':') - 1);
$value_begin = (strpos($my_string, ':') + 1);

// Values
$key = substr($my_string, 0, strpos($my_string, ':') );
$value = substr($my_string, (strpos($my_string, ':') + 1), strlen($my_string));

// Output values
echo '<h3>Results</h3>';
echo "Key ends at: $key_end" . ENDL;
echo "Key is: $key" . ENDL;
echo "Value begins at: $value_begin" . ENDL;
echo "Value is: $value" . ENDL;

// Tests
echo '<h3>Testing</h3>';
if(strtoupper($key) == strtoupper('name')){echo 'Key Name - Passed!' . ENDL;}
else{echo 'Key Name - Failed!' . ENDL;}

if(strtoupper($value) == strtoupper('joy')){echo 'Key Value - Passed!' . ENDL;}
else{echo 'Key Value - Failed!' . ENDL;}

?>