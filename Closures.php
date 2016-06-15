<?php

//Examples of PHP closures / anonymous functions

// Without arguments
$PHP_Hello_World_Closure = function ()
{
   return "Hello World! ";
};
echo $PHP_Hello_World_Closure();

// With Arguments
$PHP_Say_Hello_Closure = function ($name) 
{
   return "Hello $name! ";
};
echo $PHP_Say_Hello_Closure("Joy");


?>