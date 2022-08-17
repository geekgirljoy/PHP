<?php

// Example usage:

// Include the class
require_once("Class.Tokenizer.php"); // If not in this file include the class

// Create a new tokenizer object
$tokenizer = new tokenizer();

$string = "Hello world foobar hello tree three";

// Encode the string
$encoded = $tokenizer->encode($string); // words to vocabulary token keys

// Print the encoded string
print_r($encoded);
// Array
// (
//     [0] => 50195 // hello
//     [1] => 98440 // world
//     [2] => -1    // [foobar = UNKNOWN LEXEME]
//     [3] => 50195 // hello
//     [4] => 92285 // tree
//     [5] => 90606 // three
// )


// Print the decoded string
$decoded = $tokenizer->decode($encoded); // Decode the string
// NOTE: 'Hello' is unknown so it becomes 'hello' which is in the vocabulary
print_r($decoded); // hello world  hello tree three

$embedding = $tokenizer->GetEmbedding($encoded); // Get the embedding

// Not telling you what to do... but... you might want 
// to feed the embedding into your neural network ;P

// Dont print the embedding its 99170 indexes long... 
// you can print but... it's not very human readable
// Uncomment to print the embedding
//print_r($embedding);

// It looks like this:
// Array
// (
//     ...
//     [99165] => 1.0082419351834E-5
//     [99166] => 1.0082419351834E-5
//     [99167] => 1.0082419351834E-5
//     [99168] => 1.0082419351834E-5
//     [99169] => 1.0082419351834E-5
//     [99170] => 1.0082419351834E-5
// )
