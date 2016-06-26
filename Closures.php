<?php

//Examples of PHP closures / anonymous functions

// Closure without arguments
$HelloWorldClosure = function (){
   return "Hello World! ";
};
echo $HelloWorldClosure();


// With Arguments
$SayHelloClosure = function ($name) {
   return "Hello $name! ";
};
echo $SayHelloClosure("Joy");


?>