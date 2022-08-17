<?php
/*
This generates the vocabulary from the text file.
words is sourced from /usr/dict/words on Linux
*/

// fopen the file 'words' and read the contents into an array, the data is newline separated
$words = fopen("words", "r");
$word_array = array(); 
$token = 0; // set token to 0 if creating a new vocabulary and 
            // adjust it to vocabulary_size+1 to add additional lexemes

// Loop through the file and add each word to the array 
// as the key and the token value as the index offset beginning at 0
while (!feof($words)) {
    $word_array[trim(fgets($words))] = $token;
    $token++;
}
fclose($words);// Close the words file

$tokens = json_encode($word_array, 1); // Encode the array to json

// Write the tokens to a vocab.json file
$vocab = fopen("vocab.json", "w");
fwrite($vocab, $tokens);
fclose($vocab);
