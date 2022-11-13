<?php

// This code takes an "image", "quantizes" it, and then through a series of arcane ritules, 
// bizarre incantations, a few voodoo dolls and some mathmagical freaky deeky,
// plus a little spatial manipulation thrown in for good fun..
// it creates a mesh of triangles that can be used to render an image in 3D space... it's magic! Poof!
// Careful of the pixie dust though, it's a bit itchy and it gets everywhere!

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Dont judge me for this... code be heavy mkay! You can'tz haz expectz me to shlep 
// all the cod3z all over the place all the timez! Download the includez and put them 
// in the same folder as this file (OR WHEREVER YOU WANT) if you wanna be all like not hot linky and stuff.
// requires allow_url_include=On in php.ini
// consiquently uhhhh... you can't run this on a shared host... probably... but doing this is considered "bad" form anyway sooo... yeah.
// Anywho... include all the things:
include "https://raw.githubusercontent.com/geekgirljoy/PHP/master/Projects/ReadWrite3DSTLObjects/Facet.Class.php";
include "https://raw.githubusercontent.com/geekgirljoy/PHP/master/Projects/ReadWrite3DSTLObjects/Vertex.Class.php";
// Look its gonna error, deep breaths my boo!! That's ohkay! :) We included the Facet and Vertex classes above ;)
@include "https://raw.githubusercontent.com/geekgirljoy/PHP/master/Projects/ReadWrite3DSTLObjects/STLObject.Class.php";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// This is the image we want to convert to a mesh... ain't it somthin' fiercely purty? 
$name = 'CalderaCrater'; // What an impact+explosion/collapse+implosion!
$im = imagecreatefrompng($name . '.png'); // Boom goes the dynamite!

// What size is our Vooodoo doll? We have to tailor it's clothes to fit!
// You did get a vooodoo doll right? DAMNIT! I told you to get one! YOU NEVER LISTEN TO ME!
// GO BACK AND START OVER! Also, you might want to dispose of the gremlin.. 
// can't keep them things around for too long before they start to get all... well... gremlin-y 
// and transmogrify into something less cute and cuddly and more.. like...
// a 5 night's at freddy's remix of I hope it die's in a fire! https://youtu.be/AibtyCAhyQE
// and... you won't really care if this is what it desires.. or not.. I'm just saying.. I'm just saying!
$width = imagesx($im);
$height = imagesy($im);

// This is the number of colors we want to quantize to... 255 is the max.. duhm... er... i thinx...
$colors = 16;

// Anyway...
// If you stick a needle in the eye of our voodoo image just like this... squish it down a bit... nice and tight.. ZAP!
// The image will be quantized down to the number of colors you specify.
// Convert to palette-based with no dithering or you'll get a gremlin... and we don't want that!
// They are WAAAAAYYY more work to care for than a guinea pig and lest we forget the trantula incident of 2012... I never will!
imagetruecolortopalette($im, false, $colors);

// Create an array to hold all the deliciously creamy image data
$data = array();

// Loop through the image and add the crema de delicias color index to the array
for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {

        // Like SOOOOoooo yummies! Sacramento muy perfecto! Just como en las películas!
        $z = imagecolorat($im, $x, $y); // This is the color index for this pixel, 
                                        // it now represents the "z" value of the vertex in 3D space, oh yeah!

        //$data[$x][$y] = $z;// Just let's that shit fly right into the array!
                             // Screw normalizing it or anything... we like it RAW!!!!!!!!!!!!!!!!!!!!! Mmmmmm... RAWR!

        // Normalize between 0 and 1
        $data[$x][$y] = $z / $colors; // $z divided by the number of colors
                                      // This is done so that the color index is between 0 and 1

        // Normalize between -1 and 1
        //$data[$x][$y] = ($z / $colors) * 2 - 1; // $z divided by the number of colors times 2 and minus 1 
                                                  // This is done so that the color index is between -1 and 1

        // Normalize between -1 and 0
        //$data[$x][$y] = ($z / $colors) - 1; // $z divided by the number of colors minus 1
                                              // This is done so that the color index is between -1 and 0
    }
}

// Behold the inner sanctum of... the Cult of the Forge of the Tempered Mesh of Triangles!
// That's right acolytes! We are going to forge a mesh of triangles from the image data...
// or something... I dunno... I'm not a real wizard or anything... it's just an analogy... get off my back dammit!
// Uh... wipe your feet on the mat before you come in... I don't want to have to clean up a mess after.
// I'm not fortunate enough to be able to afford a valcano to dispose o unwanted leftovers in like some people's evil lair... 
// More like Mola Ram Dhanavaan! am I right?!?! That guy was a real jerk! 
// And... that joke works on so many levels! :-P
$my_3D_stl_object = new STLObject(); // Create new STL Object
$my_3D_stl_object->SetName('CalderaCrater');   // A mantle fit to protect the heart of any mesh 

// Loop through the X and Y coordinates data, and create a vertex at each point
// and then create a facet between the vertex and the vertex to the right and the vertex below it
// this will create a mesh of triangles that will be used to create the 3D image
for ($y = 0; $y < $height - 1; $y++) {
    for ($x = 0; $x < $width - 1; $x++) {

        // KAALEE MAAN MUJHE SHAKTI DO!!!!!!!

        // Lord Shiva creates a vertex at the current X and Y coordinates
        $x1 = $x;
        $y1 = $y;
        // Goddess Kaali's eyes glow with power and fill the vertex with energy
        $z1 = $data[$x][$y];

        // Lord Shiva creates a vertex at the current X + 1 and Y coordinates
        $x2 = $x + 1;
        $y2 = $y;
        // Goddess Kaali's eyes glow with power and fill the vertex with energy
        $z2 = $data[$x + 1][$y];

        // Lord Shiva creates a vertex at the current X and Y + 1  coordinates
        $x3 = $x;
        $y3 = $y + 1;
        // Goddess Kaali's eyes glow with power and fill the vertex with energy
        $z3 = $data[$x][$y + 1];

        // Lord Shiva creates a vertex at the current X + 1 and Y + 1 coordinates
        $x4 = $x + 1;
        $y4 = $y + 1;
        // Goddess Kaali's eyes glow with power and fill the vertex with energy
        $z4 = $data[$x + 1][$y + 1];
        
        // Lord Shiva calculates the normal vector for the first triangle facet
        $i = ($y2 - $y1) * ($z3 - $z1) - ($z2 - $z1) * ($y3 - $y1);
        $j = ($z2 - $z1) * ($x3 - $x1) - ($x2 - $x1) * ($z3 - $z1);
        $k = ($x2 - $x1) * ($y3 - $y1) - ($y2 - $y1) * ($x3 - $x1);

        // Lord Shiva calculates the normal vector for the second triangle facet
        $l = ($y4 - $y3) * ($z2 - $z3) - ($z4 - $z3) * ($y2 - $y3);
        $m = ($z4 - $z3) * ($x2 - $x3) - ($x4 - $x3) * ($z2 - $z3);
        $n = ($x4 - $x3) * ($y2 - $y3) - ($y4 - $y3) * ($x2 - $x3);

        // Goddess Kaali crushes the first crystalized triangle facet under her foot
        $my_3D_stl_object->AddFacet($i, $j, $k,
            array(array($x1, $y1, $z1),
                array($x2, $y2, $z2),
                array($x3, $y3, $z3))
        );

        // Goddess Kaali crushes the second crystalized triangle facet under her foot
        $my_3D_stl_object->AddFacet($l, $m, $n,
            array(array($x3, $y3, $z3),
                array($x4, $y4, $z4),
                array($x2, $y2, $z2))
        );
    }
}

// At last... we have the Mesh of the Triangles of the Forge of the Tempered of the Cult of the CalderaCrater! Hmmm.. we'lll have to work on that name...
// But it's guaranteed to prevent all unauthorized attempts to remove your heart so your soul can be stolen by Mola Ram 
// and sacraficed to black mother Kali Ma, without asking... or your next 3D mesh is free!
$my_3D_stl_object->ExportSTLFile($name.'.stl'); // Export CalderaCrater.stl

// Man.. you know what?? I fucking love math! It's like magic!