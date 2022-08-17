<?php

class Tokenizer{

    private $vocabulary = array();

    // Simple constructor
    function __construct(){
        // Load the vocabulary from the vocab.json file
        // NOTE: Run GenerateWordTokensVocabulary.php FIRST to generate the vocab.json file
        $vocab = fopen("vocab.json", "r");
        $this->vocabulary = json_decode(fread($vocab, filesize("vocab.json")), 1);
        fclose($vocab);
    }

    // Encode the string into a token array
    function encode($string){

        // Split the string into an array of words
        $words = explode(" ", $string);

        // Loop through the words and encode them
        foreach($words as &$word){

            // If the word isn't in the vocabulary
            if(!in_array($word, array_keys($this->vocabulary))){
                $word = strtolower($word); // Lowercase the word
                // If the lowercase word isn't in the vocabulary
                if(!in_array($word, array_keys($this->vocabulary))){
                    $word = -1; // Set the word to -1 because it is not in the vocabulary
                }else{
                    $word = $this->vocabulary[$word]; // Set the word to the token value of the word in the vocabulary
                }
            }else{
                $word = $this->vocabulary[$word]; // Get the token for the word
            }
        }

        return $words; // Return the word tokens array
    }

    // Decode the token array into a string
    function decode($array){
        $words = array(); // Create an array to hold the words
        foreach($array as $token){ // Loop through the tokens
            // look up the token/word in the vocabulary
            $words[] = array_search($token, $this->vocabulary);
        }
        return implode(" ", $words); // Return the words as a string
    }
    
    function SoftMax($array){
        $max = max($array); // Get the max value
        $sum = 0; // Initialize the sum
        // Loop through the array 
        foreach($array as $value){
            // Add the exponential of the value minus the max value to the sum
            $sum += exp($value - $max);
        }
        // Loop through the array again and divide each value by the sum
        return array_map(function($value) use ($sum, $max){
            return exp($value - $max) / $sum;
        }, $array);
    }
    
    function GetEmbedding($tokens){
        // Embedding keys are $this->vocabulary array/token values
        $embedding = array_fill_keys(array_values($this->vocabulary), 0);
        
        // For each token in the tokens array
        foreach($tokens as $token){
            // If the token is in the vocabulary
            if(array_key_exists($token, $embedding)){
                $embedding[$token] += 1;
            }
        }
        
        return $this->SoftMax($embedding);
    }
}


/*

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

*/
