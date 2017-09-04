<?php
set_time_limit(3000); // Adjust as needed


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
if(isset($_POST["epocs"])){$simulations = $_POST["epocs"];}
else{$simulations = 210;}


if(isset($_POST["zoom"])){$high = $_POST["zoom"];}
else{$high = 6;}
$low = $high * -1;


////
// Create Solar System
////
if(isset($_POST["exponent"])){$exponent = $_POST["exponent"];}
else{$exponent = 9;}

$img_size = pow(2, $exponent) + 1;


if(isset($_POST["number-of-bodies"])){$number_of_orbital_bodies = $_POST["number-of-bodies"];}
else{$number_of_orbital_bodies = 9;}

$system = imagecreatetruecolor($img_size, $img_size);
$space_black = imagecolorallocate($system, 0, 0, 0);


////
// Define Sun
////
$sun_size=mt_rand(8,30); // Size
$sun_x = $img_size/2; // center the sun on x
$sun_y = $img_size/2; // center the sun on y
$sun_yellow = imagecolorallocate($system, 255, 255, 0); // Color
@imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow);


$planets = array();
// generate system
for($i = 0; $i < $number_of_orbital_bodies; $i++){

    ////
    // Define Planets
    ////
    $au_from_sun=RandomFloat(2+$i); // AU from Sun
    $size=RandomFloat(8); // Size
    $color = imagecolorallocate($system, mt_rand(50, 255), mt_rand(50, 255), mt_rand(50, 255)); // Color
    $vy = RandomFloat(1); // Velocity
    $vx = 0;              // Velocity    
    $x = $au_from_sun; // Initial x position
    $y = $au_from_sun; // Initial y position


    // randomly flip spawn quadrant
    if(mt_rand(0,1) == 1){
        $y = $y / -1;
    }
    if(mt_rand(0,1) == 1){
        $x = $x / -1;
    }
    
    // randomly shift to half
    if(mt_rand(0,1) == 1){
        // position is in 
        if($y + $y/2 > $img_size){
            $y -= $y/2;
        }else{
            $y += $y/2;
        }
    }
    if(mt_rand(0,1) == 1){
        // position is in 
        if($x + $x/2 > $img_size){
            $x -= $x/2;
        }else{
            $x += $x/2;
        }
    }

    $r = sqrt(pow($x,2) + pow($y,2)); // Orbital radius at this position
    $a =  ($au_from_sun * 0.00002) / pow($r, 2);
    $ax = -$a * $x / $r; // Divide the force for the angle between x & y
    $ay = -$a * $y / $r; // Divide the force for the angle between x & y
    // Normalize positions to be within the image bounds
    $row = round(MinMax($y, $low, $high, $img_size));
    $col = round(MinMax($x, $low, $high, $img_size));
        
    // plot planet
    @imagefilledellipse ( $system, $row, $col, $size, $size, $color);
    
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
       'plot'=>true));
}


// Output image
imagepng($system, "images/0.png");
// free memory
imagedestroy($system);


for($i = 0; $i < $simulations; $i++){
    ////
    // Solar System
    ////
    $system = imagecreatetruecolor($img_size, $img_size);
    
    ////
    // Sun
    ////
    // Plot Sun
    @imagefilledellipse ( $system, $sun_y, $sun_x, $sun_size, $sun_size, $sun_yellow );
    
    foreach($planets as $key=>&$planet){
        if($planet['plot'] == true){
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
            @imagefilledellipse ($system, $planet['row'], $planet['col'], $planet['size'], $planet['size'], $planet['color']);
            
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
                            }
                        }
                    }
                }
            }
        }
    }
    
    // Output Solar System
    imagepng($system, "images/" . ($i + 1) . ".png");
    // Free Memory
    imagedestroy($system);
}

include('GIFEncoder.class.php'); // GIFEncoder class
$images;
$buffered;
@CreateGif($simulations);


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
                <input type="range" id="exponent" name="exponent" min="8" max="10" value="<?php echo $exponent; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
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
                
                
                <label for="epocs">Epocs <span id="epocs-number"><?php echo $simulations; ?></span></label>    
                <input type="range" id="epocs" name="epocs" min="10" max="1500" value="<?php echo $simulations; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
                <label for="number-of-bodies">Number of Bodies <span id="number-of-bodies-number"><?php echo $number_of_orbital_bodies; ?></span></label>    
                <input type="range" id="number-of-bodies" name="number-of-bodies" min="3" max="1000" value="<?php echo $number_of_orbital_bodies; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
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
            $remaining_orbits = 0;

            foreach($planets as &$planet){
                if($planet['plot'] == true){
                    $remaining_orbits++; 
                }
            }
            echo "$remaining_orbits Remaining Orbits ";
        ?>
    </body>
</html>
