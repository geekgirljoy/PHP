<?php

class man{}

$Aristotle = new man();
$Aristotle->hair = array('color'=>'brown'); // Aristotle possesses the hair property with the color value brown 
$Aristotle->mortal = NULL; // Aristotle possesses the mortal property
$Aristotle->philosopher = NULL; // Aristotle possesses philosopher property
$Aristotle->likes_garum = NULL; // Aristotle possesses likes_garum property

$Euclid = new man();
$Euclid->mortal = NULL; // Euclid possesses the mortal property
$Euclid->mathematician = NULL; // Euclid possesses mathematician property

$Plato = new man();
$Plato->hair = array('color'=>'black'); // Plato possesses the hair property with the color value black
$Plato->mortal = NULL; // Plato possesses the mortal property
$Plato->philosopher = NULL; // Plato possesses philosopher property
$Plato->likes_garum = NULL; // Plato possesses likes_garum property

$Socrates = new man();
$Socrates->hair = array('color'=>'white'); // Socrates possesses the hair property with the color value white
$Socrates->mortal = NULL; // Socrates possesses the mortal property
$Socrates->philosopher = NULL; // Socrates possesses philosopher property
$Socrates->baker = NULL; // Socrates possesses baker property
$Socrates->hates_garum = NULL; // Socrates possesses hates_garum property

$men = array($Aristotle, $Euclid, $Plato, $Socrates);

///////////////////////////////////////////////
// Un-comment to have one or more non mortal men
///////////////////////////////////////////////
// unset($Aristotle->{"mortal"});
// unset($Euclid->{"mortal"});
// unset($Plato->{"mortal"});
// unset($Socrates->{"mortal"});



//////////////////////////////////
// Are all men mortal?          //
//////////////////////////////////

// Assume all men are mortal
$all_men_are_mortal = true;

// Expand to all corners of existence and examine all men there among them...
foreach($men as $man){
    // ...and if a man is found who is not mortal
    if(!property_exists($man, "mortal")){
        // ...then that man shall never die
        $all_men_are_mortal = false;
    }
}
if($all_men_are_mortal == true){
    echo "All men are mortal.\n";
}else{
    echo "Not all men are mortal.\n";
}
/*
    All men are mortal.
*/

//////////////////////////////////
// Is Socrates Mortal?          //
//////////////////////////////////
echo "Socrates is a " . get_class($Socrates) . ".\n"; 

// All men are mortal and Socrates is immortal
if($all_men_are_mortal == true && !property_exists($Socrates, "mortal")){
    echo "However, Socrates is not mortal.\n";
}
// All men are mortal and Socrates is mortal
elseif($all_men_are_mortal == true){
    echo "Therefore, Socrates is mortal.\n";
}
// All men are not mortal and Socrates is mortal
elseif($all_men_are_mortal == false && property_exists($Socrates, "mortal")){
    echo "However, Socrates is mortal.\n";
}
// All men are not mortal and Socrates is not mortal
elseif($all_men_are_mortal == false && !property_exists($Socrates, "mortal")){
    echo "Therefore, Socrates is not mortal.\n";
}
else{
    echo "However, it is unknown if Socrates is mortal or not.\n";
}

/*
    Socrates is a man.
    Therefore, Socrates is mortal. 
*/

//////////////////////////////////
// What color is Socrates hair? //
//////////////////////////////////

// Does Socrates have hair?
if(property_exists($Socrates, "hair")){
    
    // Is the color known
    if(array_key_exists('color', $Socrates->hair)){
        echo 'Socrates hair color is ' . $Socrates->hair['color'] . ".\n";
    }
    else{ // Unknown color
        echo "Socrates has hair but the color is unknown.\n";
    }
}
else{ // Unknown if Socrates has hair
    echo "It is unknown what color or even if Socrates has hair.\n";
}
/*
    Socrates hair color is white.
*/



//////////////////////////////////
// What profession is Socrates? //
//////////////////////////////////

 
$known_professions = array('butcher', 'baker', 'candlestick_maker', 'mathematician', 'philosopher');

// Socrates attributes and properties
$Socrates_professions = array_keys(get_object_vars($Socrates));

// For all Socrates attributes and properties
foreach($Socrates_professions as $key=>$p){
    
    // If property/attribute is not a profession
    if(array_search($p, $known_professions) == false){
        unset($Socrates_professions[$key]); // remove
    }
}
// If any of Socrates_professions are known
if(count($Socrates_professions) > 0){
    echo "Socrates professions are " . implode(', ', $Socrates_professions) . ".\n";
}
else{ // No known professions
    echo "It is unknown what Socrates profession is.\n";
}
/*
    Socrates professions are philosopher, baker.
*/



//////////////////////////////////
// Does Socrates like Garum?    //
//////////////////////////////////

// Does Socrates possess the likes_garum property
if(property_exists($Socrates, "likes_garum")){
    echo "Socrates likes garum.\n";
}
// Does Socrates possess the hates_garum property
elseif(property_exists($Socrates, "hates_garum")){
    echo "Socrates hates garum.\n";
}
else{ // Unknown
    echo "It is unknown if Socrates likes or hates garum.\n";
}
/*
    Socrates hates garum.
*/
