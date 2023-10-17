<?php
// RealisticTypingTyposForAITypists.php - A text mangler for AI generated text
/*
## Realistic Typing Typos For AI Typists

This project aims to add "realistically-typed" errors to your input text 
in order to make it appear more natural and authentically written by a human who is prone to making mistakes. 

Specifically, this code was developed with the intention of aiding the process of obscuring and 
obfuscating machine-generated text content by adding common typing errors that humans are likely to make. 

### This includes:
   * misspelled and doubled words
   * inserting, deleting or substituting characters
   * incorrect and missing punctuation
   * minor mistakes and other such delightful phuckery  

### Examples:

#### Default Settings (0.01% probability for each type of error)):

 Input text: "Little miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and frightened miss muffet away."
Output text: "Luttle miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and rightened miss muffet away."
Output text: "Little misvs muffet sat on a tuffet, eating her curds and whey. Along caje a spider, who sat down beside her, ane frilghtened missmuffet away"
Output text: "Little miss muffet sat on a tuffet, eatihg her curds and whey. Along came a spider, who sat down beside her, and fryightened misxs muffet away."
Output text: "Little miss mufffet sat on a tuffet, eating her currds and whey. long came a sbpkder, who sat dwown beside her, and frightened bmiss muffet away."
Output text: "Lbittle mmiss muffet sat on a tuffet, eating her curds and whey.r Along came a spider, who sat dwn besidd her, andfrigntened mss muffget  away."
Output text: "Little miss muffelt sat on a tuffet, eating her curds wnd whey. AAlong came a spider, who sat down beside her,, and frightsened miss muffet away."
Output text: "Little miss muffet sat on a tuffet, eating yer ccuds and whey. Along came a spider, who sat down beside her, and frightenedd miss muffet awuay."
Output text: "Littole miss muffet sat on a tuffet eating her curds aynd wuey.. Along came a spider, who sat down bedide her, and frighftened miss muffet away,"
Output text: "Little misss muffet sat on a vtuffet, eating her curds and whey.c  Along came a spidper, who sat down beside er, qnd fightened miss muffet away."
Output text: "Little miss mumffet sat on a tuffet, eating her curds and whey. Alog came a spider who sat down beside her, and frighened mis muffet away."
Output text: "Little miss muffet sat on a tuffet? eating her curds and wwhey! Along came a spider, wp sat down beside her, and frightened jiss muffet away."
Output text: "Litttle miss mcuffet sat on  tuffet, eating her curds  and whey. Along came a stpider, who sat down beside her, and frightened miss muffet away"

 Input text: "What I found personally to be true was that it's easier to manipulate people rather than technology."
Output text: "What I found ppersonally to be true was that it's easievr to manipulate people rather than technology."
Output text: "Whhat I found personally to be true was that i's easier to manipulate peoplye rather than technology!"
Output text: "What I founr personaly too be true wfas that it's easer to manipulate people rather than technology."
Output text: "What I found personally to be true was that it's essier to manipulate people rther than technology."
Output text: "What I found peraonally to bbe trie wasv that it's easier to manipulate people rather than technology."
Output text: "What I fouund personally to be true was that it's sasier to manipulate peopl rather than technolnogy"
Output text: "hat I found personally to be atrue was that it's easier to manilulate peoplee rather fhan technology."
Output text: "Wahat I found personally to be true was that it's easier to manipulate people ryather than technology."
Output text: "What I found personally to be true was that it's easier to maniplate people rather rhan technology."
Output text: "What I found personasly to be true was that ot's easier to manipulate people rather than technology.."
Output text: "What I found pdrsonally to b true was that it's easier to manipulate people rathcer than technology."
Output text: "What I found persaonally to be true was that it's easier to maanipulate people rather tnan tefhnology.."

 Input text: "There is no great genius without some touch of madness."
Output text: "There  is no great genius without some touch of madness."
Output text: "There is no great geniys withouf some touch of madness..."
Output text: "Ther is no great genius without some touch f madness."
Output text: "There is no great genius without some touchh of madness."
Output text: "There  is no great genius without some touch of madness."
Output text: "There is no great geniusu without some touch of madness!"
Output text: "Theree is noo great genius without some touch of madness."
Output text: "There is no great genius withojt some touch of madness"
Output text: "TThere is is no great genius wiithout some some touch of maxness."
Output text: "There ks no eat geznius without some touch of madness.n"
Output text: "There is nl greeat geius without some touch of madness."
Output text: "Tyere iss nno great genius wiithout some touch of madnees"


#### 10% Probability for each type of error(0.10%)):
 Input text: "Little miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and frightened miss muffet away."
Output text: "Lftkee misss  muffet aayy on a btuffeer,, gearting herr  xurds aand nd hey,k Along cam w pidev,wjo  way edownng beside ber annd gandd  fftripgwhffenned miss miffet aaeay..p"

 Input text: "What I found personally to be true was that it's easier to manipulate people rather than technology."
Output text: "WhatyIIj kfxovuond perdiqllvy itto be tre as thhqt bit's feassir tmanfipukdate popl athdr otthan tecyhcnoloy."

 Input text: "There is no great genius without some touch of madness."
Output text: "here is no geat  geius wiithhou  some touch ol mdness."


#### 30% Probability for each type of error(0.30%)):
 Input text: "Little miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and frightened miss muffet away."
Output text: "Lirqlmrr mmizzs mhfzfrbttns q mootn   utuft?  hevtyngi srp gkehrr  achzrdds ajjee  annhehjwwqyx.. iAAlondgg ccwwme  aac akssokddrr ihp  qq ddpknscnbeexide her,, zbbeetyddqoolhgenjedp ummiss xnwuufeeoyxsways."

 Input text: "What I found personally to be true was that it's easier to manipulate people rather than technology."
Output text: "Wphxoggm Wnnaati  boodundc updrsoonnnslllyufppfbgctrndr  wsg waadwd  ggghhoarr  tohatt kitz''fxasijzd teiwoovahmquuateppddoolljjattheo  iteab  efhnnoioggm.."

 Input text: "There is no great genius without some touch of madness."
Output text: "TThssrrzeieequuss nmitggrrwwqqtt bbsbe wtghzlxt oomme  nsomp  mlpyydhh  f madtbbdjy."


#### 100% Probability for each type of error(1.00%)):
 Input text: "Little miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and frightened miss muffet away."
Output text: "Lyupgcrgovdm bjykjwbeb bjlyhtcgerlgc telwjrx vkpje kkzjl hzr pwd nythrrvcbrgya.k nrawhgukibeyh rnlsytj hntrxen qfxyfdercdg jsfjwsj mqfbsfz bsfbksdgd.......m hAsoupejbvj idvsxjuwp zwx ozo bxdlvkxeowgtt;b seqgxpi uslbalp nafsnyu ocdpyshbs zvgrtaskexoda zuqradd.a pqmbqxi izpbcxa fcmdikfybglgadlberoci ijduxzjzt wnqjadwvodegv gwfaazzty:c"

 Input text: "What I found personally to be true was that it's easier to manipulate people rather than technology."
Output text: "Wxncsern eWgjfsuyv lIf egckijthkfc qlhrwtjdtpabfqekoorgu grykc yglkl ovmso pgqdi ermfmydro qqowgdi oecspxi krmyvzpgq eglbwwdrv kuhfh'xzr udaqpwqkxrydj ggmik cyalm qnpwvhfowlzhbpysjfidh docwppilrogdr herqhfmgaritw ugwnpwrhq pghdgxjbtbcpeolkshjuw.......t"

 Input text: "There is no great genius without some touch of madness."
Output text: "Tiyfwntorq vovwf zkaxt wbwpa ubrtnwcsfgu avjrlbooiypdc aefkyfijkizjagy bawlojwdy fzaiunwwr hrvktyvfkut nllcl dluda pkysgxghdsddedr:g"

### How to use this code:
Pass your string and probabilities to the RealisticTypingTyposForAITypists() function (see line 322-390 for definition)

    Example: RealisticTypingTyposForAITypists("Text to add typos to", 0.01, 0.01, 0.01, 0.01, 0.01, 0.01);

### Recommendations
For text that NEEDs to look like a human wrote it, keep the probability values low (around 0.01% or less), especially if the text is short!

For longer text, you should occasionally turn the probabilities up or down a little and try not to always use the exact same probability every time (e.g. always sticking with the default of 0.01%) because the error rate of your text can be analyzed over time and it would be weird if your text is always approximately the same across dozens of or even hundreds of text samples. I've tested this against several automated AI vs Human authentication systems and have found that it works well when the probabilities are kept low and varied slightly over time.

*/

/////////////////////////
////    FUNCTIONS    ////
/////////////////////////

// MissTypeLetter(char, float probability)
// char is the character to be miss typed
// probability is the probability that the character will be miss typed between 0 and 1 (1 = 100%)
function MissTypeLetter($input_char, $probability = 0.01){ // default probability is 1.0%

    // The frequently miss typed characters substitution array for a qwerty keyboard
    // these assume that the user is using a qwerty keyboard and they pressed a close key to the intended key
    $qwerty_substitution = array(
        'a' => array('q','w','s','z'),
        'b' => array('v','g','h','n'),
        'c' => array('x','d','f','v'),
        'd' => array('s','e','r','f','c','x'),
        'e' => array('w','s','d','r'),
        'f' => array('d','r','t','g','v','c'),
        'g' => array('f','t','y','h','b','v'),
        'h' => array('g','y','u','j','n','b'),
        'i' => array('u','j','k','o'),
        'j' => array('h','u','i','k','m','n'),
        'k' => array('j','i','o','l','m'),
        'l' => array('k','o','p'),
        'm' => array('n','j','k'),
        'n' => array('b','h','j'),
        'o' => array('i','k','l','p'),
        'p' => array('o','l'),
        'q' => array('w','a','s'),
        'r' => array('e','d','f','t'),
        's' => array('a','w','e','d','x','z'),
        't' => array('r','f','g','y'),
        'u' => array('y','h','j','i'),
        'v' => array('c','f','g','b', ''),
        'w' => array('q','a','s','e'),
        'x' => array('z','s','d','c', ''),
        'y' => array('t','g','h','u'),
        'z' => array('a','s','x')
    );

    // Is the input character capitalized?
    $is_capitalized = ctype_upper($input_char);

    // If the input character is in the substitution array, then miss type it
    if (array_key_exists($input_char, $qwerty_substitution)) {
        // Get the array of possible miss typed characters
        $possible_miss_types = $qwerty_substitution[$input_char];

        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then miss type the character
        if ($random_number < $probability) {
            // Get a random index from the array of possible miss typed characters
            $random_index = array_rand($possible_miss_types);

            // Get the miss typed character
            $miss_typed_char = $possible_miss_types[$random_index];

            // If the input character was capitalized, then capitalize the miss typed character
            if ($is_capitalized) {
                $miss_typed_char = strtoupper($miss_typed_char);
            }

            // Return the miss typed character
            return $miss_typed_char;
        }
    }

    return $input_char; // Return the input character if it was not miss typed
}

// MissTypeNumber(char, float probability)
// char is the number to be miss typed
// probability is the probability that the character will be miss typed between 0 and 1 (1 = 100%)
function MissTypeNumber($input_char, $probability = 0.01){ // default probability is 1.0%
    if(is_numeric($input_char)){

        // The frequently miss typed numbers substitution array
        // "Fat fingered" numbers are usually off by one or two keys
        $number_substitution = array(
            '0' => array('9', /* ( */ '-' /* hahahahahaha your value is now negative and smaller by a factor of 10 
                                 or potentially mal formed a subtraction problem */,
                         '('),
            '1' => array('2', '!', 'l', '`', '~'),
            '2' => array('1','3', '@'),
            '3' => array('2','4', '#'),
            '4' => array('3','5', '$'),
            '5' => array('4','6', '%'),
            '6' => array('5','7', '^'),
            '7' => array('6','8', '&'),
            '8' => array('7','9', '*'),
            '9' => array('8','0', ')', '*', '('),
        );

        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then miss type the character
        if ($random_number < $probability) {
            // Get the array of possible miss typed numbers
            $possible_miss_types = $number_substitution[$input_char];

            // Return the miss typed number
            return $possible_miss_types[array_rand($possible_miss_types)];
        }
    }
    return $input_char; // Return the input character if it was not miss typed
}

// MissTypePunctuation(char, float probability)
// char is the punctuation char to be miss typed
// probability is the probability that the punctuation char will be miss typed between 0 and 1 (1 = 100%)
function MissTypePunctuation($input_char, $probability = 0.01){ // default probability is 1.0%

    // The frequently miss typed punctuation substitution array
    $punctuation_substitution = array(
        '.' => array('..', '...', '....', ',', '!', '?', ';', ':', ' '),
        ',' => array('.', '!', '?', ';', ':', ' '),
        '!' => array('.', '?', ';', ':', ' ', '!!', '!!!', '!?!?!', '?!?!', '?!?!?', '?!?!?!', '?!?!?!?', '?!?!?!?!', '?!?!?!?!?'),
        '?' => array('.', '!', ';', ':', ' ', '??', '???', '???!?!', '?!?!', '?!?!?', '?!?!?!', '?!?!?!?', '?!?!?!?!', '?!?!?!?!?'),
        ';' => array('.', ',', '!', '?', ':', ' '),
        ':' => array('.', ',', '!', '?', ';', ' ')
    );

    // If the input character is in the substitution array, then miss type it
    if (array_key_exists($input_char, $punctuation_substitution)) {
        // Get the array of possible miss typed punctuation characters
        $possible_miss_types = $punctuation_substitution[$input_char];

        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then miss type the punctuation character
        if ($random_number < $probability) {
            // Get a random index from the array of possible miss typed punctuation characters
            $random_index = array_rand($possible_miss_types);

            // Get the miss typed punctuation character
            $miss_typed_char = $possible_miss_types[$random_index];

            // Return the miss typed punctuation character
            return $miss_typed_char;
        }
    }
    
    return $input_char; // Return the input character if it was not miss typed

}

// DoubleWord(word, float probability)
// word is the word to be double typed
// probability is the probability that the word will be doubled between 0 and 1 (1 = 100%)
function DoubleWord($word, $probability = 0.01){ // default probability is 1.0%

    // The frequently doubled words substitution array
    // Ever run across a word that was doubled?  It's probably one of these
    $double_words = array(
        'the', 'of', 'and', 'a', 'to', 'too', 'in', 'is', 'you', 
        'that', 'it', 'he', 'was', 'for', 'on', 'are', 'as', 
        'with', 'his', 'I', 'at', 'by', 'this', 'from', 'or', 
        'have', 'an', 'but', 'not', 'what', 'all', 'were', 'when', 
        'where', 'their', 'which', 'him', 'has', 'her', 'if', 
        'said', 'one', 'into', 'be', 'me', 'them', 
        'some', 'just', 'she', 'get', 'who', 'go', 'see', 'make'
    );

    // If the word is in the substitution array
    if (in_array(strtolower($word), $double_words)) {
        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then double the word
        if ($random_number < $probability) {
            // return the doubled word
            return $word . " " . $word;
        }
    }
    
    return $word; // return the input word if it was not doubled
}

// AddCharacter(string of chars, float probability)
// output_sentence is a string of chars to add a character to
// probability is the probability that the char will be added between 0 and 1 (1 = 100%)
function AddCharacter(&$output_sentence, $add_character_probability = 0.01){ // default probability is 1.0%
    // Get a random number between 0 and 1
    $random_number = mt_rand() / mt_getrandmax();

    // If the random number is less than the probability, then add a character
    if ($random_number < $add_character_probability) {
        // Get a random lowercase character
        $random_character = chr(mt_rand(97, 122));

        // Concatenate the random character to the output string
        $output_sentence .= $random_character;
    }
}

// RemoveCharacter(string of chars, float probability)
// output_sentence is a string of chars to remove a character from
// probability is the probability that the char will be removed between 0 and 1 (1 = 100%)
function RemoveCharacter(&$output_sentence, $remove_character_probability = 0.01){ // default probability is 1.0%
        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then remove a character
        if ($random_number < $remove_character_probability) {
            // Remove the last character from the output string
            $output_sentence = substr($output_sentence, 0, -1);
        }
}

// RealisticTypingTyposForAITypists(input_sentence, 
//     double_word_probability, 
//     miss_type_character_probability, 
//     miss_type_number_probability, 
//     miss_type_punctuation_probability,
//     double_character_probability, 
//     add_character_probability, 
//     remove_character_probability)
// input_sentence is a string of chars we want to add realistic typos to
// double_word_probability is the probability that a word will be doubled between 0 and 1 (1 = 100%)
// miss_type_character_probability is the probability that a character will be miss typed between 0 and 1 (1 = 100%)
// miss_type_number_probability is the probability that a number will be miss typed between 0 and 1 (1 = 100%)
// miss_type_punctuation_probability is the probability that a punctuation character will be miss typed between 0 and 1 (1 = 100%)
// double_character_probability is the probability that a character will be doubled between 0 and 1 (1 = 100%)
// add_character_probability is the probability that a character will be added between 0 and 1 (1 = 100%)
// remove_character_probability is the probability that a character will be removed between 0 and 1 (1 = 100%)
function RealisticTypingTyposForAITypists($input_sentence, 
             $double_word_probability = 0.01, 
             $miss_type_character_probability = 0.01, 
             $miss_type_number_probability = 0.01,
             $miss_type_punctuation_probability = 0.01,
             $double_character_probability = 0.01,
             $add_character_probability = 0.01,
             $remove_character_probability = 0.01){ 

    // Double the words
    $words = explode(" ", $input_sentence);
    $output_words = array();
    foreach ($words as $key => &$word) {
        $output_words[] = DoubleWord($word, $double_word_probability);
    }
    unset($words);
    $input_sentence = implode(" ", $output_words);
    unset($output_words);

    // Split string into array of characters
    $input_sentence = str_split($input_sentence);
    $output_sentence = "";
    // Loop through array of characters
    foreach ($input_sentence as $character) {
        
        // Miss type the character or number or punctuation
        $miss_typed_character = MissTypeLetter($character, $miss_type_character_probability);
        $miss_typed_character = MissTypeNumber($miss_typed_character, $miss_type_number_probability);
        $miss_typed_character = MissTypePunctuation($miss_typed_character, $miss_type_punctuation_probability);

        // Concatenate the miss typed character to the output string
        $output_sentence .= $miss_typed_character;

        // Get a random number between 0 and 1
        $random_number = mt_rand() / mt_getrandmax();

        // If the random number is less than the probability, then double the character
        if ($random_number < $double_character_probability) {
            // Concatenate the miss typed character to the output string
            $output_sentence .= $miss_typed_character;
        }

        // Remove a character
        RemoveCharacter($output_sentence, $remove_character_probability);

        // Add a character
        AddCharacter($output_sentence, $add_character_probability);
    }
    $input_sentence = $output_sentence;
    unset($output_sentence);

    return $input_sentence;
}



/////////////////////////
////    VARIABLES    ////
/////////////////////////

// The probability that a word will be doubled (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$double_word_probability = 0.01;

// The probability that a character will be miss typed (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$miss_type_character_probability = 0.01;

// The probability that a number will be miss typed (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$miss_type_number_probability = 0.01;

// The probability that a punctuation character will be miss typed (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$miss_type_punctuation_probability = 0.01;

// The probability that a character will be doubled (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$double_character_probability = 0.01;

// The probability that a character will be added (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$add_character_probability = 0.01;

// The probability that a character will be removed (1 = 100%, 0 = 0%, default is 0.01 (1.0%))
$remove_character_probability = 0.01;

/////////////////////////
////    EXAMPLES     ////
/////////////////////////

// The string to add realistic typos to
$input_sentence = "Little miss muffet sat on a tuffet, eating her curds and whey. Along came a spider, who sat down beside her, and frightened miss muffet away.";
echo $input_sentence. PHP_EOL;
// Add realistic typos to the string
echo RealisticTypingTyposForAITypists($input_sentence, $double_word_probability, $miss_type_character_probability, $miss_type_number_probability, $miss_type_punctuation_probability, $double_character_probability, $add_character_probability, $remove_character_probability);

echo PHP_EOL . PHP_EOL;

// The string to add realistic typos to
$input_sentence = "What I found personally to be true was that it's easier to manipulate people rather than technology.";
echo $input_sentence. PHP_EOL;
// Add realistic typos to the string
echo RealisticTypingTyposForAITypists($input_sentence, $double_word_probability, $miss_type_character_probability, $miss_type_number_probability, $miss_type_punctuation_probability, $double_character_probability, $add_character_probability, $remove_character_probability);

echo PHP_EOL . PHP_EOL;

// The string to add realistic typos to
$input_sentence = "There is no great genius without some touch of madness.";
echo $input_sentence. PHP_EOL;
// Add realistic typos to the string
echo RealisticTypingTyposForAITypists($input_sentence, $double_word_probability, $miss_type_character_probability, $miss_type_number_probability, $miss_type_punctuation_probability, $double_character_probability, $add_character_probability, $remove_character_probability);
