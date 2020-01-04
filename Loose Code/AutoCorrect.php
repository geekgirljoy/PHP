<?php


// This function makes use of the example levenshtein distance
// code: https://www.php.net/manual/en/function.levenshtein.php
function AutoCorrect($input, $dictionary){

    // No shortest distance found, yet
    $shortest = -1;
    
    // Loop through words to find the closest
    foreach($dictionary as $word){
        
        // Calculate the distance between the input word,
        // and the current word
        $lev = levenshtein($input, $word); 

        // Check for an exact match
        if ($lev == 0){

            // Closest word is this one (exact match)
            $closest = $word;
            $shortest = 0;

            // Break out of the loop; we've found an exact match
            break;
        }

        // If this distance is less than the next found shortest
        // distance, OR if a next shortest word has not yet been found
        if ($lev <= $shortest || $shortest < 0){
            // Set the closest match, and shortest distance
            $closest = $word;
            $shortest = $lev;
        }
    }
    
    return $closest;
}


// Data: https://raw.githubusercontent.com/geekgirljoy/Part-Of-Speech-Tagger/master/data/csv/Words.csv

// Load "Hash","Word","Count","TagSum","Tags"
$words = array_map('str_getcsv', file('Words.csv'));

// Remove unwanted fields - Keep Word 
$words = array_map(function ($words){ return $words[1]; }, $words);

sort($words); // Not absolutely necessary 

// carrrot and automn are misspelled 
// olgivanna is a proper noun and should be capitalized
$sentence = 'I love $1 carrrot juice with olgivanna in the automn.';

// This expects all words to be space delimited
$input = explode(' ', $sentence);// Either make this more robust
                                 // or split so as to accommodate 
                                 // or remove punctuation because
                                 // the AutoCorrect function can
                                 // add, remove or change punctuation
                                 // and not necessarily in correct
                                 // ways because our auto correct
                                 // method relies solely on the 
                                 // distance between two strings
                                 // so it's also important to have a 
                                 // high quality dictionary/phrasebook/
                                 // pattern set when we call
                                 // AutoCorrect($word_to_check, $dictionary)


var_dump($input); // Before auto correct

// For all the words in the in $input sentence array
foreach($input as &$word_to_check){
    $word_to_check = AutoCorrect($word_to_check, $words);// Do AutoCorrect
}

var_dump($input); // After auto correct



/*
// Before 
array(10) {
  [0]=>
  string(1) "I"
  [1]=>
  string(4) "love"
  [2]=>
  string(2) "$1"
  [3]=>
  string(7) "carrrot"
  [4]=>
  string(5) "juice"
  [5]=>
  string(4) "with"
  [6]=>
  string(9) "olgivanna"
  [7]=>
  string(2) "in"
  [8]=>
  string(3) "the"
  [9]=>
  string(6) "automn"
}

After:
array(10) {
  [0]=>
  string(1) "I"
  [1]=>
  string(4) "love"
  [2]=>
  string(2) "$1"
  [3]=>
  string(6) "carrot"
  [4]=>
  string(5) "juice"
  [5]=>
  string(4) "with"
  [6]=>
  string(9) "Olgivanna"
  [7]=>
  string(2) "in"
  [8]=>
  string(3) "the"
  [9]=>
  &string(6) "autumn"
}

*/

?>
