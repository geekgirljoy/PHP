<?php


function RandomString($length) {
    $output = '';
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $alphabet_length = strlen($alphabet);

    for ($i = 0; $i <  $length; $i++) {
        $output .= $alphabet[mt_rand(0, $alphabet_length - 1)];
    }

	return $output;
}


function SelectLanguageFunction($param) {
	$output = '';
	$action = mt_rand(0, 38);

	// abs
	 if($action == 0){
		$output .= 'abs(' . $param . ')';
	 }
	 // acos
	elseif($action == 1){
		$output .= 'acos(' . $param . ')';
	 }
	 // acosh
	elseif($action == 2){
		$output .= 'acosh(' . $param . ')';
	 }
	 // asin
	elseif($action == 3){
		$output .= 'asin(' . $param . ')';
	 }
	 // asinh
	elseif($action == 4){
		$output .= 'asinh(' . $param . ')';
	 }
	  // atan
	elseif($action == 5){
		$output .= 'atan(' . $param. ')';
	 }
	 // atan2
	elseif($action == 6){
		$output .= 'atan2(' . $param . ', ' . "($param + " . mt_rand(3, 7) . ')  * pi())';
	 }
	 // atan
	elseif($action == 7){
		$output .= 'atan(' . $param . ')';
	 }
	 // atanh
	elseif($action == 8){
		$output .= 'atanh(' . $param . ')';
	 }
	 // bindec
	elseif($action == 9){
		$output .= 'bindec(' . $param . ')';
	 }
	 // ceil
	elseif($action == 10){
		$output .= 'ceil(' . $param . ')';
	 }
	 // cos
	elseif($action == 11){
		$output .= 'cos(' . $param . ')';
	 }
	 // cosh
	elseif($action == 12){
		$output .= 'cosh(' . $param . ')';
	 }
	 // decbin
	elseif($action == 13){
		$output .= 'decbin(' . $param . ')';
	 }
	 // dechex
	elseif($action == 14){
		$output .= 'dechex(' . $param . ')';
	 }
	 // decoct
	elseif($action == 15){
		$output .= 'decoct(' . $param . ')';
	 }
	 // deg2rad
	elseif($action == 16){
		$output .= 'decoct(' . $param . ')';
	 }
	 // exp
	elseif($action == 17){
		$output .= 'exp(' . $param . ')';
	 }
	 // expm1
	elseif($action == 18){
		$output .= 'expm1(' . $param . ')';
	 }
	 // floor
	elseif($action == 19){
		$output .= 'floor(' . $param . ')';
	 }
	 // fmod
	elseif($action == 20){
		$output .= 'fmod(' . $param . ', 0)';
	 }
	 // hexdec
	elseif($action == 21){
		$output .= 'hexdec(' . $param . ')';
	 }
	 // hypot
	elseif($action == 22){
		$output .= 'hypot(' . $param . ', ' . $param . ' * 2)';
	 }
	  // is_finite
	elseif($action == 23){
		$output .= 'is_finite(' . $param . ')';
	 }
	  // is_infinite
	elseif($action == 24){
		$output .= 'is_infinite(' . $param . ')';
	 }
	 // is_nan
	elseif($action == 25){
		$output .= 'is_nan(' . $param . ')';
	 }
	 // log10
	elseif($action == 26){
		$output .= 'log10(' . $param . ')';
	 }
	 // log1p
	elseif($action == 27){
		$output .= 'log1p(' . $param . ')';
	 }
	 // log
	elseif($action == 28){
		$output .= 'log(' . $param . ')';
	 }
	 // max
	elseif($action == 29){
		$output .= 'max(' . $param . ')';
	 }
	 // min
	elseif($action == 30){
		$output .= 'min(' . $param . ')';
	 }
	 // octdec
	elseif($action == 31){
		$output .= 'octdec(' . $param . ')';
	 }
	 // pow
	 elseif($action == 32){
		$output .= 'pow(' . $param . ',' . mt_rand(2, 7) . ')';
	 }
	 // rad2deg
	 elseif($action == 33){
		$output .= 'rad2deg(' . $param . ')';
	 }
	 // round
	 elseif($action == 34){
		$output .= 'round(' . $param . ')';
	 }
	 // sin
	 elseif($action == 34){
		$output .= 'sin(' . $param . ')';
	 }
	 // sinh
	 elseif($action == 35){
		$output .= 'sinh(' . $param . ')';
	 }
	 // sqrt
	 elseif($action == 36){
		$output .= 'sqrt(' . $param . ')';
	 }
	 // tan
	 elseif($action == 37){
		$output .= 'tan(' . $param . ')';
	 }
	 // tanh
	 elseif($action == 38){
		$output .= 'tanh(' . $param . ')';
	 }
	 return $output;
}


function SelectOpperation() {
	$action = mt_rand(0, 5);

	// Addition +
	 if($action == 0){
		 return '+';
	 }
	// Subtraction -
	elseif($action == 1){
		 return '-';
	 }
	// Multiplication *
	elseif($action == 2){
		 return '*';
	 }
	// Division /
	elseif($action == 3){
		 return '/';
	 }
	// Modulus %
	elseif($action == 4){
		 return '%';
	 }
	// Exponentiation **
	elseif($action == 5){
		 return '**';
	 }
}




function GenerateRandomFunction() {

	// name the function
    $function_name = ucfirst(RandomString(mt_rand(2, 7)));

	// how many parameters should the function take?
	$number_of_parameters = mt_rand(1, 3);
	$parameters = array();
	for ($i = 0; $i < $number_of_parameters; $i++) {
		 $param_name = RandomString(mt_rand(2, 5));
		 $parameters[] = "$$param_name";
    }

	// build function comment
	$funk_header = '/**' . PHP_EOL; // open comment
	$funk_header .= ' * Does Something' . PHP_EOL;  // function description
	$funk_header .= ' *' . PHP_EOL;
	foreach($parameters as $parameter){
		$funk_header .= ' * @param ' . $parameter . ' Add Description' . PHP_EOL; // parameter description
	}
	$funk_header .= ' *' . PHP_EOL;
	$funk_header .= ' */' . PHP_EOL;  // close comment

	// build function
	$funk = 'function ' . $function_name . '(' . implode(', ', $parameters) . '){ ' . PHP_EOL;

	// do something with the parameters
	$funk .= str_repeat(' ', 4) . 'return ';
	foreach( $parameters as $key=>$parameter){
		$funk .= SelectLanguageFunction($parameter); // do something with the parameters
		if($key < $number_of_parameters - 1){
			$funk .= ' '. SelectOpperation() .' '; // add opperation
		}
	}
	$funk .= ';'; // add semicolon

	// build end of function
	$funk .= PHP_EOL . '}' . PHP_EOL . PHP_EOL;

	return  $funk_header . $funk;
}
/////////////////////////////////////////////


$number_of_files = 10; // how many files to generate

// create the files
for($f = 1; $f <= $number_of_files; $f++)
{
	$file = fopen('functions/' . RandomString(mt_rand(3, 7)) . '.php','w');
	fwrite($file, '<?php' .  PHP_EOL);
	for($i = 0; $i < mt_rand(3, 17); $i++){
		fwrite($file, GenerateRandomFunction() . PHP_EOL);
	}
	fclose($file);
}
