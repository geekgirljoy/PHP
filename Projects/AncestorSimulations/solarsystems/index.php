<?php

// Turn off all error reporting because
// sometimes we will divide by zero...
// we want this to be OK and therefor
// keep on trucking! (http://www.urbandictionary.com/define.php?term=keep%20on%20trucking)
error_reporting(0);


set_time_limit(86400); // 24 Hours Adjust as needed


function MinMax($value, $min, $max, $size){
    return abs(($value - $min) / ($max - $min) * $size);
}


function RandomFloat($big){
    return mt_rand(0, $big) . "." . mt_rand(0,99);
}

// Get the file extension 
function GetFileExtension($image){
    $path_data = pathinfo('images/' . $image);
    return strtolower($path_data['extension']);
}

// Load an image resource
function LoadImage($image){
    $ext = GetFileExtension($image);
    if($ext == 'jpg' || $ext == 'jpeg'){$image = imageCreateFromJpeg('images/' . $image);}
    elseif($ext == 'png'){$image = imageCreateFromPng('images/' . $image);}
    elseif($ext == 'bmp'){$image = imageCreateFromBmp('images/' . $image);}
    else{return null;}
    return $image;
}

// Buffer Images
function EncodeImage($image){
    
    global $images, $buffered;
    ob_start(); // Start the buffer
    imagegif($image); // Output image buffer as a gif encoded still
    $images[]=ob_get_contents(); // add the gif still to the images array
    //$buffered[]=$delay; // Delay in the animation.
    $buffered[]= (1); // Delay in the animation (ms * delay in seconds)
    ob_end_clean(); // Stop the buffer
}
 
// Create Gif
function CreateGif($num_images){
    global $images, $buffered;
    
    // Do something with each image
    for($i = 1; $i < $num_images; $i++)
    {
        $image = LoadImage("$i.png");
        EncodeImage($image); // Buffer image
        imagedestroy($image); // Free memory
    }
    // Generate the animation
    $gif = new GIFEncoder($images,$buffered,0,0,0,0,0,'bin');
    
    // Save the gif
    $animation_file = fopen('orbit.gif', 'w');
    fwrite($animation_file, $gif->GetAnimation());
    fclose($animation_file);
}


$delta_time = 0.1; // 0.1 // 0.03
if(isset($_POST["epochs"])){$simulations = $_POST["epochs"];}
else{$simulations = 210;}


if(isset($_POST["zoom"])){$high = $_POST["zoom"];}
else{$high = 6;}
$low = $high * -1;






if(isset($_POST['enable-elemental-simulation'])){
	////
	// Meet the elements
	////
	$chemical_elements = array('Hydrogen', 'Helium', 'Lithium', 'Beryllium', 'Boron', 'Carbon', 'Nitrogen', 'Oxygen', 'Fluorine', 'Neon', 'Sodium', 'Magnesium', 'Aluminium', 'Silicon', 'Phosphorus', 'Sulfur', 'Chlorine', 'Argon', 'Potassium', 'Calcium', 'Scandium', 'Titanium', 'Vanadium', 'Chromium', 'Manganese', 'Iron', 'Cobalt', 'Nickel', 'Copper', 'Zinc', 'Gallium', 'Germanium', 'Arsenic', 'Selenium', 'Bromine', 'Krypton', 'Rubidium', 'Strontium', 'Yttrium', 'Zirconium', 'Niobium', 'Molybdenum', 'Technetium', 'Ruthenium', 'Rhodium', 'Palladium', 'Silver', 'Cadmium', 'Indium', 'Tin', 'Antimony', 'Tellurium', 'Iodine', 'Xenon', 'Caesium', 'Barium', 'Lanthanum', 'Cerium', 'Praseodymium', 'Neodymium', 'Promethium', 'Samarium', 'Europium', 'Gadolinium', 'Terbium', 'Dysprosium', 'Holmium', 'Erbium', 'Thulium', 'Ytterbium', 'Lutetium', 'Hafnium', 'Tantalum', 'Tungsten', 'Rhenium', 'Osmium', 'Iridium', 'Platinum', 'Gold', 'Mercury', 'Thallium', 'Lead', 'Bismuth', 'Polonium', 'Astatine', 'Radon', 'Francium', 'Radium', 'Actinium', 'Thorium', 'Protactinium', 'Uranium', 'Neptunium', 'Plutonium', 'Americium', 'Curium', 'Berkelium', 'Californium', 'Einsteinium', 'Fermium', 'Mendelevium', 'Nobelium', 'Lawrencium', 'Rutherfordium', 'Dubnium', 'Seaborgium', 'Bohrium', 'Hassium', 'Meitnerium', 'Darmstadtium', 'Roentgenium', 'Copernicium', 'Nihonium', 'Flerovium', 'Moscovium', 'Livermorium', 'Tennessine', 'Oganesson');

	// initialize unique element spawn probability "weights" for this solar system
	$element_weights = array();
	$number_of_elements = count($chemical_elements); // count the elements
	for($i = 0; $i < $number_of_elements; $i++){
		array_push($element_weights, mt_rand(0, $number_of_elements));
	}
	// combine the element names as keys and the weights as values
	$chemical_elements = array_combine($chemical_elements, $element_weights);
}








////
// Create Solar System
////
if(isset($_POST["exponent"])){$exponent = $_POST["exponent"];}
else{$exponent = 9;}

$img_size = pow(2, $exponent) + 1;


if(isset($_POST["number-of-bodies"])){$number_of_orbital_bodies = $_POST["number-of-bodies"];}
else{$number_of_orbital_bodies = 9;}



//////////////////////////////////////////////////////////
// Set to use via command line
//////////////////////////////////////////////////////////
$exponent = 10;
$img_size = pow(2, $exponent) + 1;
$high = 24;
$low = $high * -1;
$simulations = 1;
$number_of_orbital_bodies = 128;

/////////////////////////////////////////////////////////




$system = imagecreatetruecolor($img_size, $img_size);
$space_black = imagecolorallocate($system, 0, 0, 0);






////
// Define Sun
////
//$sun_size=mt_rand(8,30); // Size
$sun_size = 75; // Size ////////////////////////////////////////////////////////////////////////////
$sun_x = $img_size/2; // center the sun on x
$sun_y = $img_size/2; // center the sun on y
$sun_yellow = imagecolorallocate($system, 255, 255, 0); // Color

$planets = array();

// generate system
for($i = 0; $i < $number_of_orbital_bodies; $i++){


    ////
    // Define Planets
    ////
    $au_from_sun=RandomFloat(1+$i); // AU from Sun
    //$size=RandomFloat(8); // Size
    $size=RandomFloat(0); // Size
    $color = imagecolorallocate($system, mt_rand(50, 255), mt_rand(50, 255), mt_rand(50, 255)); // Color
    //$vy = RandomFloat(1); // Velocity
    $vy = 1; // Velocity
    $vx = 0;              // Velocity    
    $x = $au_from_sun; // Initial x position
    $y = 0; // Initial y position


    // randomly flip spawn quadrant
	if(isset($_POST['flip-y'])){ 
		//if(mt_rand(0,1) == 1){
			$y = $y / -1;
		//}
	}
    if(isset($_POST['flip-y'])){
		//if(mt_rand(0,1) == 1){
			$x = $x / -1;
		//}
    }
	
	
    // randomly shift to half
	if(isset($_POST['shift-y'])){
		//if(mt_rand(0,1) == 1){
			// position is in 
			if($y + $y/2 > $img_size){
				$y -= $y/2;
			}else{
				$y += $y/2;
			}
		//}
	}
	if(isset($_POST['shift-x'])){
		//if(mt_rand(0,1) == 1){
			// position is in 
			if($x + $x/2 > $img_size){
				$x -= $x/2;
			}else{
				$x += $x/2;
			}
		//}
	}

    $r = sqrt(pow($x,2) + pow($y,2)); // Orbital radius at this position
    $a =  ($au_from_sun * 0.00002) / pow($r, 2);
    $ax = -$a * $x / $r; // Divide the force for the angle between x & y
    $ay = -$a * $y / $r; // Divide the force for the angle between x & y
    // Normalize positions to be within the image bounds
    $row = round(MinMax($y, $low, $high, $img_size));
    $col = round(MinMax($x, $low, $high, $img_size));
       
	$body_elements = array();
	if(isset($_POST['enable-elemental-simulation']) && $_POST['enable-elemental-simulation'] == true){
		// Add Elements
		$number_of_elements_to_spawn = mt_rand(10,15);
		for($elem = 0; $elem < $number_of_elements_to_spawn; $elem++){

			//select an element
			$select_element = mt_rand(1,array_sum($chemical_elements));

			// Find the selected element
			$num = 0;
			foreach($chemical_elements as $value=>$weight){
				if(($num += $weight) >= $select_element){
					//echo "$weight $value" . PHP_EOL;
					
					// push element onto the orbital body
					array_push($body_elements, $value);
					break;
				}
			}
		}
	}
		
		
		
		
    // plot planet
    imagefilledellipse ( $system, $row, $col, $size, $size, $color);
    
    array_push($planets, array(
       'au'=>$au_from_sun,
       'size'=>$size,
       'color'=>$color,
       'vy'=>$vy,
       'vx'=>$vx,
       'x'=>$x,
       'y'=>$y,
       'r'=>$r,
       'a'=>$a,
       'ax'=>$ax,
       'ay'=>$ay,
       'row'=>$row,
       'col'=>$col,
       'plot'=>true,
	   'motion'=>true, 
	   'elements'=>$body_elements
	   ));
}







 if(isset($_POST['enable-solar-nebula'])){ 

	$a = 0.9759 + RandomFloat(0);
	$b = 0.1759;
	$steps = 7; 
	$radius = 0.8 * pi()* $steps;
	$max_spread = 0.7;
	$lower_disk_radius = -6;
	$higher_disk_radius = 6;
    
	
	for($i = 0; $i < 200000; $i++){

		// Nebula
		
		// Debris size
		$size = mt_rand(0,6);
		if($size == 0){
			$size = "0.0" . mt_rand(1,9); // 31.855 Kilometers - 286.695 Kilometers in Diameter
		}                                 // 19.7937793 Miles - 178.144014 Miles in Diameter
		
		elseif($size == 1){
			$size = "0.00" . mt_rand(1,9); // 3.1855 Kilometers - 28.6695 Kilometers in Diameter
		}                                  // 1.97937793 Miles - 17.8144014 Miles in Diameter
		
		elseif($size == 2){ 
			$size = "0.000" . mt_rand(1,9); // 318.55 Meters - 2.86695 Kilometers in Diameter
		}                                   // 348.370516208 Yards - 1.78144014 Miles in Diameter
		
		elseif($size == 3){
			$size = "0.0000" . mt_rand(1,9); // 31.855 Meters - 286.695 Meters in Diameter
		}                                    // 34.837051619 Yards - 313.53346457 Yards in Diameter
		
		elseif($size == 4){
			$size = "0.00000" . mt_rand(1,9); // 3.1855 Meters - 28.6695 Meters in Diameter
		}                                     // 3.48370516185 Yards - 31.3533464567 Yards in Diameter
		
		elseif($size == 5){
			$size = "0.000000" . mt_rand(1,9); // 0.00031855 - 0.00286695 Kilometers in Diameter
		}                                      // 1.04511155 Feet - 9.406003937008 Feet in Diameter

		elseif($size == 6){
			$size = "0.0000000" . mt_rand(1,9); // 3.1855 Centimeters - 28.6695 Centimeters in Diameter
		}                                       // 1.25413386 Inches - 11.28720472 Inches in Diameter
		

		
		
		
		  $angle = $radius * RandomFloat(3); // Pick a random point in the Spiral
		  $row = $a * exp($b * $angle) * cos($angle);
		  $row = $row + ($max_spread * $row * RandomFloat(0)) - ($max_spread * $row * RandomFloat(0));
		  $col = $a * exp($b * $angle) * sin($angle); 
		  $col = $col + ($max_spread * $col * RandomFloat(0)) - ($max_spread * $col * RandomFloat(0));

		  // Flip a coin to determine which arm 
		  // the star should be on.
		  if (mt_rand(0, 1) == 1){
			  // if heads put it on the second arm
			  // by inverting the values
			  $row = ($row/-1);
			  $col = ($col/-1);
		  } 

		  // Normalize positions to be within the image bounds
		  $row = MinMax($row, $lower_disk_radius, $higher_disk_radius, $img_size);
		  $col = MinMax($col, $lower_disk_radius, $higher_disk_radius, $img_size);

		  
		$body_elements = array();
		if(isset($_POST['enable-elemental-simulation']) && $_POST['enable-elemental-simulation'] == true){
			// Add Elements
			$number_of_elements_to_spawn = mt_rand(1,3);
			for($elem = 0; $elem < $number_of_elements_to_spawn; $elem++){

				//select an element
				$select_element = mt_rand(1,array_sum($chemical_elements));

				// Find the selected element
				$num = 0;
				foreach($chemical_elements as $value=>$weight){
					if(($num += $weight) >= $select_element){
						//echo "$weight $value" . PHP_EOL;
						
						// push element onto the orbital body
						array_push($body_elements, $value);
						break;
					}
				}
			}
		}
		
		$color = imagecolorallocate($system, mt_rand(10, 50), mt_rand(10, 50), mt_rand(10, 50));
		imagefilledellipse ( $system, round($row), round($col), (float)$size, (float)$size, $color);
		
		
		array_push($planets, array(
	   'au'=>$row+$col,
	   'size'=>$size,
	   'color'=>$color,
	   'vy'=>0,
	   'vx'=>0,
	   'x'=>$col,
	   'y'=>$row,
	   'r'=>$radius,
	   'a'=>$angle,
	   'ax'=>0,
	   'ay'=>0,
	   'row'=>$row,
	   'col'=>$col,
	   'plot'=>true,
	   'motion'=>false,
	   'elements'=>$body_elements 
	   ));

	}
 }



// Draw Sun
imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow);





// Output image
imagepng($system, "images/0.png");
// free memory
imagedestroy($system);


for($i = 0; $i < $simulations; $i++){
    ////
    // Solar System
    ////
    $system = imagecreatetruecolor($img_size, $img_size);
    
      
    foreach($planets as $key=>&$planet){
		
		
        if($planet['plot'] == true && $planet['motion'] != false){
            ////
            // Planet
            ////

            $planet['vx'] = $planet['vx'] + $planet['ax'] * $delta_time; // New velocity
            $planet['vy'] = $planet['vy'] + $planet['ay'] * $delta_time; // New velocity
			
            $planet['x'] = $planet['x'] + $planet['vx'] * $delta_time; // New position
            $planet['y'] = $planet['y'] + $planet['vy'] * $delta_time; // New position
            $planet['r'] = sqrt(pow($planet['x'],2) + pow($planet['y'],2)); // Orbital radius at this position
            $planet['a'] =  $planet['au'] / pow($planet['r'], 2); // Acceleration / angle
            $planet['ax'] = -$planet['a'] * $planet['x'] / $planet['r']; // Divide the force for the angle between x & y
            $planet['ay'] = -$planet['a'] * $planet['y'] / $planet['r']; // Divide the force for the angle between x & y
            // Normalize positions to be within the image bounds
            $planet['row'] = MinMax($planet['y'], $low, $high, $img_size);
            $planet['col'] = MinMax($planet['x'], $low, $high, $img_size);
			
			
            // Plot Planet
            imagefilledellipse ($system, $planet['row'], $planet['col'], $planet['size'], $planet['size'], $planet['color']);
            
            // planet went out of bounds
            /*
             _____
           .|     |.
            |  *  |
            |_____|
                .  */
            if($planet['row'] <= 0 + ($planet['size']/2) + 5 || $planet['col'] <= 0 + ($planet['size']/2) + 5 || $planet['row'] >= $img_size - ($planet['size']/2) + 5 || $planet['col'] >= $img_size - ($planet['size']/2) + 5){
                $planet['color'] = $space_black;
                $planet['plot'] = false;
            }
            // if planet got too close to sun
            // as defind by the the center point of the sun
			// sourrounded by a box of:
			// the radius of the sun + n pixels
            /*
             _______
            |       |
            |  [*]  |
            |_______|
            */
            if( ($planet['row'] >= $sun_x - ($sun_size/2)+5) && ($planet['row'] <= $sun_x + ($sun_size/2)+5) && ($planet['col'] >= $sun_y - ($sun_size/2)+ 5) && ($planet['col'] <= $sun_y + ($sun_size/2)+5))
            {
                $planet['color'] = $space_black;
                $planet['plot'] = false;
            }
            
            
            // orbital body other than the sun collision handeling
            /*
             ________
            |        |
            |  >..<  |
            |________|
            */
            // for all the planets 
            foreach($planets as $key2=>&$planet2){
                if($planet2['plot'] == true){
                    if($key != $key2){ // that are not this planet
                        
						
                        // deturmine the larger of the two
                        if($planet['size'] > $planet2['size']){ // planet is bigger than planet 2
                            
                            // then check for collisions
                            if(($planet2['row'] >= $planet['row'] - ($planet['size']/2)+5) && ($planet2['row'] <= $planet['row'] + ($planet['size']/2)+5)
                              && ($planet2['col'] >= $planet['col'] - ($planet['size']/2) + 5) && ($planet2['col'] <= $planet['col'] + ($planet['size']/2)+5))
                            {
                                // remove smaller planet
                                $planet2['color'] = $space_black;
                                $planet2['plot'] = false;
                                
                                // add the mass of the
                                // small orbital body to
                                // the larger orbital body
                                $planet['size'] = $planet['size'] + $planet2['size'];
								
								// Planet may not be larger than our arbitrarily sized sun
                                if ($planet['size'] > $sun_size){$planet['size'] = $sun_size; }
								
								if(isset($_POST['enable-elemental-simulation']) && $_POST['enable-elemental-simulation'] == true){
									// transfer elements
									$planet['elements'] = array_merge($planet['elements'], $planet2['elements']);
									$planet2['elements'] = null; // free up space in array
				                }

                            }
                        }else{// planet2 is bigger than planet 1
                            
                            // then check for collisions
                            if(($planet['row'] >= $planet2['row'] - ($planet2['size']/2)+5) && ($planet['row'] <= $planet2['row'] + ($planet2['size']/2)+5)
                              && ($planet['col'] >= $planet2['col'] - ($planet2['size']/2) + 5) && ($planet['col'] <= $planet2['col'] + ($planet2['size']/2)+5))
                            {
                                // remove smaller planet
                                $planet['color'] = $space_black;
                                $planet['plot'] = false;
                                
                                
                                // add the mass of the
                                // small orbital body to
                                // the larger orbital body
                                $planet2['size'] = $planet2['size'] + $planet['size'];
                                
								// Planet may not be larger than our arbitrarily sized sun
                                if ($planet2['size'] > $sun_size){$planet2['size'] = $sun_size; }
								
								if(isset($_POST['enable-elemental-simulation']) && $_POST['enable-elemental-simulation'] == true){
									// transfer elements
									$planet2['elements'] = array_merge($planet2['elements'], $planet['elements']);
									$planet['elements'] = null; // free up space in array
								}
                            }
                        }
                    }
                }
            }
        }
		 // motion = false
		 // this is stationary mass
		elseif($planet['plot'] == true){ // motion = false
		     imagefilledellipse ($system, $planet['row'], $planet['col'], $planet['size'], $planet['size'], $planet['color']);
		}
    }
	
	////
    // Sun
    ////
    // Plot Sun
    imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow );
	
	
    
    // Output Solar System
    imagepng($system, "images/" . ($i + 1) . ".png");
    // Free Memory
    imagedestroy($system);
}


if(isset($_POST['output-gif'])){ 

	include('GIFEncoder.class.php'); // GIFEncoder class
	$images;
	$buffered;
	CreateGif($simulations);
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ancestor Simulations Solar System Generator</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body style="background-color:black; color:white;">
    
    
    
    
     <div id="menu-container" width="300px" height="500px">
          <ul id="menu-toggle" width="300px" height="500px">
            <form id="solar-system-generator" action="#" method="POST">
            
                <label for="exponent">Solar System Size <span id="exponent-number"><?php echo $exponent . ' (' . $img_size . 'x' . $img_size .')'; ?></span></label>    
                <input type="range" id="exponent" name="exponent" min="8" max="12" value="<?php echo $exponent; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
                <label for="zoom">Zoom</label>    
                <select id="zoom" name="zoom">
                    <option value="1" <?php if($high == '1'){echo 'selected';}?>>Close up of the Sun</option>
                    <option value="3" <?php if($high == '3'){echo 'selected';}?>>Inner Orbits</option>
                    <option value="6" <?php if($high == '6'){echo 'selected';}?>>Medium Orbits</option>
                    <option value="12" <?php if($high == '12'){echo 'selected';}?>>Large Orbits</option>
                    <option value="24" <?php if($high == '24'){echo 'selected';}?>>Greater Orbits</option>
                    <option value="48" <?php if($high == '48'){echo 'selected';}?>>Legendary Orbits</option>
                    <option value="96" <?php if($high == '96'){echo 'selected';}?>>Epic Orbits</option>
                </select>
                
                
                <label for="epochs">Epochs <span id="epochs-number"><?php echo $simulations; ?></span></label>    
                <input type="range" id="epochs" name="epochs" min="10" max="10000" value="<?php echo $simulations; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
                <label for="number-of-bodies">Number of Bodies <span id="number-of-bodies-number"><?php echo $number_of_orbital_bodies; ?></span></label>    
                <input type="range" id="number-of-bodies" name="number-of-bodies" min="3" max="6000" value="<?php echo $number_of_orbital_bodies; ?>" onchange="SettingsSliderChange(this.id)"><br><br>
				
				<label for="enable-solar-nebula">Generate Solar Nebula</label>
				<input type="checkbox" name="enable-solar-nebula" value="1" <?php if(isset($_POST['enable-solar-nebula'])){ echo 'checked';} ?>><br><br>
				
				<label for="enable-solar-nebula">Enable Elemental Simulation</label>
				<input type="checkbox" name="enable-elemental-simulation" value="1" <?php if(isset($_POST['enable-elemental-simulation'])){ echo 'checked';} ?>><br><br>
				
				<label for="flip-x">Flip X</label>   
				<input type="checkbox" name="flip-x" value="1" <?php if(isset($_POST['flip-x'])){ echo 'checked';} ?>>
				<label for="flip-x">Flip Y</label>   
				<input type="checkbox" name="flip-y" value="1" <?php if(isset($_POST['flip-y'])){ echo 'checked';} ?>>
				<label for="flip-x">Shift X</label>   
				<input type="checkbox" name="shift-x" value="1" <?php if(isset($_POST['shift-x'])){ echo 'checked';} ?>>
				<label for="flip-x">Shift Y</label>
				<input type="checkbox" name="shift-y" value="1" <?php if(isset($_POST['shift-y'])){ echo 'checked';} ?>>
				
				

				<br><br>
				<label for="output-gif">Output GIF</label>
				<input type="checkbox" name="output-gif" value="1" <?php if(isset($_POST['output-gif'])){ echo 'checked';} ?>>
				
				
				
				
                
                <input type="submit" value="Generate">
            </form>
            <a href="orbit.gif" download>
            <button>Save</button>
            </a>
            <script>
            // Slider changed update value
            function SettingsSliderChange(element) {
                var val = document.getElementById(element).value;
                if(element == 'exponent'){
                    var px = Math.pow(2, val) + 1;
                    var size = " (" + px + "x" + px + ")";
                    document.getElementById(element + "-number").innerHTML = val + size;
                }
                else{
                    document.getElementById(element + "-number").innerHTML = val;
                }
            }
            
            </script>
          </ul>
        </div>
    
    
        <img src="orbit.gif" alt="orbit">
        <hr>
        <?php
		/////////////
		// Report
		/////////////
		
            $remaining_orbits = 0;
			
			$report = "";
			
            //$file = fopen("elements.txt", "w");
            foreach($planets as  $key=>&$planet){
				
                if($planet['plot'] == true){
                    $remaining_orbits++; 
                }
				
				if($planet['plot'] == true && $planet['motion'] != false){
					$report .= "Planet " . $key  . " Elements <br>" . PHP_EOL;
					$E = array_count_values($planet['elements']);
					
					$report .= "Number of Elements Present: " . count($E) . "<br>" .PHP_EOL;
					
					 foreach($E as  $elem=>&$ekey){
						 $report .= ($ekey / count($E) * 100) . "% $elem<br>" . PHP_EOL;
						// fwrite($file, ($ekey / count($E) * 100) . "% $elem<br>" . PHP_EOL);
					 }
					
					
					//print_r($E);
					$report .= "<br><br>" . PHP_EOL;

				}
				
            }
			//fclose($file);
            echo "$remaining_orbits Remaining Objects <br> $report";

			
			
        ?>
    </body>
</html>
