<?php 

function AlienName(){
	$chars = "abcdefghijklmnopqrstuvwxyz";
	$chars_len = strlen($chars) - 1;
	
	$f_len = random_int(3, 9);
	$f_name = '';
	
	$l_len = random_int(3, 9);
    $l_name = '';


	for($i = 0; $i < $f_len; $i++){
		$f_name .=  $chars[random_int(0, $chars_len)];
	}
	
	for($i = 0; $i < $l_len; $i++){
		$l_name .= $chars[random_int(0, $chars_len)];
	}
	
	return ucfirst($f_name) . ' ' . ucfirst($l_name);
}


$number_of_names = 1000;

$file = fopen('alien-names.txt', 'w');
for($i = 0; $i < number_of_names; $i++){
	fwrite($file, AlienName() . PHP_EOL);
}
fclose($file);
