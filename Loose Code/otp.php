<?php

// One-Time Pad Encryption and Decryption in PHP
// This implementation uses XOR operation for encryption and decryption.
// If you only use the key once, AND the key is at least as long as the message, 
// and the key is "truly random", then this method is unbreakable, if your message is also long enough to avoid brute-force attacks.
// This is because each possible plaintext is equally likely for a given ciphertext.
// This implementation encodes the ciphertext in base64 to ensure it can be safely transmitted as text.
// Usage of this code is at your own risk. Always follow best practices for cryptography and data security.
// Remember to never reuse the key, as doing so compromises security.
// Also remember to use a key that is truly random. Pseudo-random generators are not secure for this purpose.
// In a pinch you can use a news article or other random text as the key becuase it's unknown and a confiderate may have access to it too..
// But remember if an attacker can get a copy of the key, they can decrypt the message.
// For true security use a cryptographically secure key, something like the whitenoise input of a microphone or a alpha particle generator.
// In all cases. remember to preserve the key and distribute it securely.

function Encrypt($plaintext, $key) {
    $ciphertext = ''; // Initialize empty ciphertext
    for ($i = 0; $i < strlen($plaintext); $i++) { // for all the characters in the plaintext
        // XOR each character with the corresponding character in the key (cycling through the key if necessaryr

        $plain = base_convert(ord($plaintext[$i]), 10, 2);// Get the binary value of the ascii character
        $encoded_char = base_convert(ord($key[$i % strlen($key)]), 10, 2);

        // Determine the maximum length between the two binary strings
        $max_len = max(strlen($plain), strlen($encoded_char));

        // Pad the binary strings with leading zeros to make them the same length
        $plain = str_pad($plain, $max_len, '0', STR_PAD_LEFT);
        $encoded_char = str_pad($encoded_char, $max_len, '0', STR_PAD_LEFT);

        // xor the two binary strings
        $xor_result = '';
        for ($j = 0; $j < $max_len; $j++) {
            $xor_result .= ($plain[$j] === $encoded_char[$j]) ? '0' : '1';
        }
 
        $ciphertext .= chr(bindec($xor_result)); // Convert the XOR result back to a character and append to ciphertext
    }
    return base64_encode($ciphertext);
}

function Decrypt($ciphertext, $key) {
    $ciphertext = base64_decode($ciphertext);
    $plaintext = ''; // Initialize empty plaintext
    for ($i = 0; $i < strlen($ciphertext); $i++) { // for all the characters in the ciphertext
        // XOR each character with the corresponding character in the key (cycling through the key if necessary)

        $cipher = base_convert(ord($ciphertext[$i]), 10, 2);// Get the binary value of the ascii character
        $encoded_char = base_convert(ord($key[$i % strlen($key)]), 10, 2);

        // Determine the maximum length between the two binary strings
        $max_len = max(strlen($cipher), strlen($encoded_char));

        // Pad the binary strings with leading zeros to make them the same length
        $cipher = str_pad($cipher, $max_len, '0', STR_PAD_LEFT);
        $encoded_char = str_pad($encoded_char, $max_len, '0', STR_PAD_LEFT);

        // xor the two binary strings
        $xor_result = '';
        for ($j = 0; $j < $max_len; $j++) {
            $xor_result .= ($cipher[$j] === $encoded_char[$j]) ? '0' : '1';
        }

        $plaintext .= chr(bindec($xor_result)); // Convert the XOR result back to a character and append to plaintext
    }
    return $plaintext;
}


// Your Message Here:
$message = "otp.php uploaded to server. 👽🛸🗿🚀😜 Key:" . bin2hex(random_bytes(32)); // padding extra random text
echo "Original Message: " . $message . PHP_EOL;

// Generate a random key of the same length as the message - KEEP THIS SECRET! Distribute it securely. Use Responsibly!
$one_time_pad = $bytes = random_bytes(strlen($message)*2); // Make the key at least as long as the message, unused characters are fine.
echo "One-Time Pad Key (hex): " . bin2hex($one_time_pad) . PHP_EOL;

// Encrypt the message
$encrypted_text = Encrypt($message, $one_time_pad);
echo "Encrypted Text: " . $encrypted_text . PHP_EOL;

// Decrypt the message
$decrypted_text = Decrypt($encrypted_text, $one_time_pad);
echo "Decrypted Text: " . $decrypted_text . PHP_EOL;
/*

Original Message: otp.php uploaded to server. 👽🛸🗿🚀😜 Key:b4f81383b5f48fb9475d1337985f1e4889333563fb80b42fc9c0eed71dadd0e7
One-Time Pad Key (hex): ac0e32912b1716e2e8dda9ce8d1d95e1009a977fe4480e649bc22df6162e6f7bf1dc3edda16c1a7c0fc72b7919f2d86342ab424e7b2bfe46d939dc4862db395a5cee3a2fe641b404cc5166fd6e0e3a868b2918d7b3ebfc53849aa454c901ae0122c7e91cfbccbfd0666837714a8ab66a14c311f4a6a09384e4a64138029175dbf6444c229b0c311af007d19f8e64b776c4fc99cc6ee917ac499a364346d24fe51041b593c84999abd3804e944015db741347992771f8e8bc930ab9b9919deab453a4126971e510dd0470fbed6e0fc8c1564d1227fa467678fd5462a54c8d4c0c02979f1eb7a153e6ef69
Encrypted Text: w3pCv1t/ZsKdrcWh7HnwhSDu+F+XLXwS/rAD1uax/sYBQ6VlUfONw/9YsfnpbUD/YuAnN0FJyiDhCO9wUbkMPGjWXE3fdYMxqGBVzlk3ArPtGH3ji9PFYLepkWL6Z8w5EqXdLp2vhrNWDVIVfbvSC3CnIZGR
Decrypted Text: otp.php uploaded to server. 👽🛸🗿🚀😜 Key:b4f81383b5f48fb9475d1337985f1e4889333563fb80b42fc9c0eed71dadd0e7

*/
