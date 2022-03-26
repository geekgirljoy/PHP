<?php
// https://en.wikipedia.org/wiki/Rectifier_(neural_networks)
function ReLU($t){
    return max(0, $t);
}

function LeakyReLU($t, $leak = 0.1){
	return max($leak * $t, $t);
}

function Softplus($t){
	return log(1 + exp($t));
}


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
	array_push($test_results, ReLU($i));
}
var_dump($test_results);


/*

Results of ReLU Function:

0
0
0
0
0
0
1
2
3
4

*/


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
	array_push($test_results, LeakyReLU($i));
}
var_dump($test_results);


/*

Results of LeakyReLU Function:

-0.5
-0.4
-0.3
-0.2
-0.1
0
1
2
3
4

*/


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
	array_push($test_results, Softplus($i));
}
var_dump($test_results);

/*

Results of Softplus Function:

0.006715348489118
0.01814992791781
0.048587351573742
0.12692801104297
0.31326168751822
0.69314718055995
1.3132616875182
2.126928011043
3.0485873515737
4.0181499279178

*/
