<?php
// https://en.wikipedia.org/wiki/Rectifier_(neural_networks)
function ReLU($t){
    return max(0, $t);
}

// Leaky Rectified Linear Unit
function LeakyReLU($t, $leak = 0.1){
    return max($leak * $t, $t);
}

// SoftPlus is a smooth approximation to the ReLU
function Softplus($t){
    return log(1 + exp($t));
}

// Exponential Linear Unit
function ELU($t){
    return $t > 0 ? $t : exp($t) - 1;
}

// Scaled Exponential Linear Unit
function SELU($x) {
    $alpha = 1.6732632423543772848170429916717; // alpha value for SELU 
    $scale = 1.0507009873554804934193349852946; // scale value for SELU
    return $scale * ($x >= 0 ? $x : $alpha * exp($x) - $alpha); // SELU function
}

// Sigmoid Linear Unit (sometimes called the "Swish function")
// Reference: https://arxiv.org/abs/1710.05941v1
// "Our experiments show that Swish tends to work better than ReLU on deeper models 
// across a number of challenging datasets. For example, simply replacing ReLUs with 
// Swish units improves top-1 classification accuracy on ImageNet by 0.9% for Mobile NASNet-A
// and 0.6% for Inception-ResNet-v2. The simplicity of Swish and its similarity to ReLU make 
// it easy for practitioners to replace ReLUs with Swish units in any neural network."
function SiLU($x) {
    $sigmoid = 1 / (1 + exp(-$x)); // sigmoid function
    return $sigmoid * $x;
}

// Gaussian Error Linear Unit
function GELU($x) {
    return 0.5 * $x * (1 + tanh(sqrt(2 / pi()) * ($x + 0.044715 * pow($x, 3))));
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


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
    array_push($test_results, ELU($i));
}
var_dump($test_results);

/*

Results of ELU Function:

-0.99326205300091
-0.98168436111127
-0.95021293163214
-0.86466471676339
-0.63212055882856
0
1
2
3
4

*/


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
    array_push($test_results, SELU($i));
}
var_dump($test_results);

/*

Results of SELU Function:

-1.7462533606696
-1.7258986281899
-1.6705687287671
-1.5201664685957
-1.1113307378126
0
1.0507009873555
2.101401974711
3.1521029620664
4.2028039494219

*/


$test_results = array();
for ($i = -5.00; $i < 5.00; $i+= 1){
    array_push($test_results, SiLU($i));
}
var_dump($test_results);

/*

Results of SiLU "Swish" Function:

-0.033464254621424
-0.071944839848366
-0.1422776195327
-0.23840584404424
-0.26894142137
0
0.73105857863
1.7615941559558
2.8577223804673
3.9280551601516

*/


$test_results = array();
for ($i = -5.00; $i <= 5.00; $i+= 1){
    array_push($test_results, GELU($i));
}
var_dump($test_results);

/*

Results of GELU Function:

-2.2917961972624E-7
-7.0245948192271E-5
-0.003637392081773
-0.045402305912225
-0.15880800939172
0
0.84119199060828
1.9545976940878
2.9963626079182
3.9999297540518
4.9999997708204

*/
