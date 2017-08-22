<?php

set_time_limit(300); // 5 Minutes adjust as needed
ini_set('memory_limit', '3G'); // 3 GB Adjust as needed

function RandomFloat(){
    return '0.'. mt_rand(0,9999);
}

function MinMax($value, $min, $max, $size){
    return abs(($value - $min) / ($max - $min) * $size);
}

function vignette($im){
    $width = imagesx($im);
    $height = imagesy($im);

    for($row = 0; $row < $width; ++$row){
        for($col = 0; $col < imagesy($im); ++$col){  
            $index = imagecolorat($im, $row, $col);
            $rgb = imagecolorsforindex($im, $index);
            $sharp = 1; // 0 - 10 small is sharpnes, 
            $level = 0.7; // 0 - 1 small is brighter    
            $l = sin((pi() + RandomFloat()) / $width * $row) * sin((pi() +  RandomFloat()) / $height * $col);
            $l = pow($l, $sharp); 
            $l = 1 - $level * (1.2 - $l);
            $rgb['red'] *= $l;
            $rgb['green'] *= $l;
            $rgb['blue'] *= $l;
            $color = imagecolorallocate($im, $rgb['red'], $rgb['green'], $rgb['blue']);
            imagesetpixel($im, $row, $col, $color);  
        }
    }
    return(true);
}

if(isset($_POST["galaxy-type"])){$galaxy_type = $_POST["galaxy-type"];}
else{$galaxy_type = 'spiral';}


if(isset($_POST["exponent"])){$exponent = $_POST["exponent"];}
else{$exponent = 9;}

$size = pow(2, $exponent);

if(isset($_POST["apply-gaussian"])){$apply_gaussian = $_POST["apply-gaussian"];}
else{$apply_gaussian = false;}

if(isset($_POST["apply-colorize"])){$apply_colorize = $_POST["apply-colorize"];}
else{$apply_colorize = false;}

if(isset($_POST["red"])){$red_number = $_POST["red"];}
else{$red_number = mt_rand(0,255);}

if(isset($_POST["green"])){$green_number = $_POST["green"];}
else{$green_number = mt_rand(0,255);}

if(isset($_POST["blue"])){$blue_number = $_POST["blue"];}
else{$blue_number = mt_rand(0,255);}

if(isset($_POST["apply-greyscale"])){$apply_greyscale = $_POST["apply-greyscale"];}
else{$apply_greyscale = false;}

if(isset($_POST["apply-negate"])){$apply_negate = $_POST["apply-negate"];}
else{$apply_negate = false;}

if(isset($_POST["apply-vignette"])){$apply_vignette = $_POST["apply-vignette"];}
else{$apply_vignette = false;}


if(isset($_POST["number-of-stars"])){$number_of_stars = $_POST["number-of-stars"];}
else{$number_of_stars = 300000;}

$a = 0.9759 + RandomFloat();
$b = 0.1759; // ~nautilus shell
$steps = 5; 
$radius = 3 * pi()* $steps;
$max_spread = 0.3;
$min_star_position = -76458.735624534;
$max_star_position = 102693.535433 ;

// Image Resource
$galaxy = imagecreatetruecolor($size, $size);

// Colors
$white = imagecolorallocate($galaxy, 255, 255, 255);
$yellow = imagecolorallocate($galaxy, 255,255,0);
$red = imagecolorallocate($galaxy, 255,0,0);
$blue = imagecolorallocate($galaxy, 0,0,255);
$black = imagecolorallocate($galaxy, 0, 0, 0);
$dark_grey = imagecolorallocate($galaxy, 50, 50, 50);

// Create Image of Galaxy
for($i = 0; $i < $number_of_stars; $i++){
  $angle = $radius * RandomFloat(); // Pick a random point in the Spiral

   if($galaxy_type == 'spiral'){// Spiral Galaxy
       $row = $a * exp($b * $angle) * cos($angle);
       $row = $row + ($max_spread * $row * RandomFloat()) - ($max_spread * $row * RandomFloat());
       $col = $a * exp($b * $angle) * sin($angle);
       $col = $col + ($max_spread * $col * RandomFloat()) - ($max_spread * $col * RandomFloat());
              
       if($i > $number_of_stars * 0.6){
          $radius = 6 * pi()* $steps; // increse radius and spread out
      }
   }
   elseif($galaxy_type == 'quasar'){// Quasar Galaxy
      if($a != 1){
          $a = mt_rand(1, 2) + RandomFloat();
          $b = 0.2;
          $max_spread = RandomFloat();
      }
      
      $row = $a * exp($b * $angle) * cosh($angle);
      $row = $row + ($max_spread * $row * RandomFloat()) - ($max_spread * $row * RandomFloat());
      $col = $a * exp($b * $angle) * sinh($angle); 
      $col = $col + ($max_spread * $col * RandomFloat()) - ($max_spread * $col * RandomFloat());
  }
  elseif($galaxy_type == 'globular'){// Globular/Elliptical Galaxy
      if($max_spread != 1){     
          $a = mt_rand(1, 2) + RandomFloat();
          $b = 0.2;      
          $max_spread = 1;
          $radius = 6 * pi()* $steps;
      }
      
      $row = $a * exp($b * $angle) * cos($angle);
      $row = $row + ($max_spread * $row * RandomFloat()) - ($max_spread * $row * RandomFloat());
      $col = $a * exp($b * $angle) * sin($angle); 
      $col = $col + ($max_spread * $col * RandomFloat()) - ($max_spread * $col * RandomFloat());
  }
  elseif($galaxy_type == 'irregular'){// Irregular Galaxy
      if($max_spread != 1){     
          $a = 8 + RandomFloat();
          $b = 0.2;      
          $max_spread = 1.3;
          $radius = 6 * pi()* $steps;
      }
      
      $row = $a * exp($b * $angle) * cos($angle);
      $row = $row + ($max_spread * $row * RandomFloat()) - ($max_spread * $row * RandomFloat());
      $col = $a * exp($b * $angle) * sin($angle); 
      $col = $col + ($max_spread * $col * RandomFloat()) - ($max_spread * $col * RandomFloat());
  }
    
  // Flip a coin to deturmine which arm 
  // the star should be on.
  if (mt_rand(0, 1) == 1){
      // if heads put it on the second arm
      // by inverting the values
      $row = ($row/-1);
      $col = ($col/-1);
  } 

  // Normalize positions to be within the image bounds
  $row = MinMax($row, $min_star_position, $max_star_position, $size);
  $col = MinMax($col, $min_star_position, $max_star_position, $size);

  
  $colors = array($white, $white, $white, $dark_grey, $yellow, $red, $blue);
  @imagesetpixel($galaxy,round($row),round($col), $colors[mt_rand(0,6)]); // Plot the star position
}

if($apply_gaussian == true){
    imagefilter($galaxy, IMG_FILTER_GAUSSIAN_BLUR); // blur
}
if($apply_colorize == true){
    @imagefilter($galaxy, IMG_FILTER_COLORIZE, $red_number, $green_number, $blue_number); // Shift colors
}
if($apply_greyscale == true){
    @imagefilter($galaxy,  IMG_FILTER_GRAYSCALE); // grey scale
}
if($apply_negate == true){
    @imagefilter($galaxy, IMG_FILTER_NEGATE); // inverse colors
}
if($apply_vignette == true){
    @vignette($galaxy); // vignette
}


// Output image
imagepng($galaxy, "galaxy.png");

// free memory
imagedestroy($galaxy);
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Ancestor Simulations Generating Galaxies</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

        <div id="menu-container" width="300px" height="500px">
          <ul id="menu-toggle" width="300px" height="500px">
            <form id="galaxy-generator" action="#" method="POST">
            
                <label for="exponent">Galaxy Size <span id="exponent-number"><?php echo $exponent . ' (' . $size . 'x' . $size .')'; ?></span></label>    
                <input type="range" id="exponent" name="exponent" min="2" max="13" value="<?php echo $exponent; ?>" onchange="SettingsSliderChange(this.id)"><br>
                
                <label for="galaxy-type">Galaxy Type</label><br>
                <select id="galaxy-type" name="galaxy-type">
                    <option value="spiral" <?php if($galaxy_type == 'spiral'){echo 'selected';}?>>Spiral</option>
                    <option value="quasar" <?php if($galaxy_type == 'quasar'){echo 'selected';}?>>Quasar</option>
                    <option value="globular" <?php if($galaxy_type == 'globular'){echo 'selected';}?>>Globular/Elliptical</option>
                    <option value="irregular" <?php if($galaxy_type == 'irregular'){echo 'selected';}?>>Irregular</option>
                </select>

                <label for="number-of-stars">Number of Stars <span id="number-of-stars-number"><?php echo $number_of_stars; ?></span></label>    
                <input type="range" id="number-of-stars" name="number-of-stars" min="1000" max="9000000" value="<?php echo $number_of_stars; ?>" onchange="SettingsSliderChange(this.id)"><br>

                <h4>Post Processing</h4>
                <label for="apply-gaussian">Apply Gaussian Blur</label><br>
                <select id="apply-gaussian" name="apply-gaussian">
                    <option value="0" <?php if($apply_gaussian == false){echo 'selected';}?>>No</option>
                    <option value="1" <?php if($apply_gaussian == true){echo 'selected';}?>>Yes</option>
                </select>
                
                <label for="apply-colorize">Apply Colorize</label><br>
                <select id="apply-colorize" name="apply-colorize" onchange="ToggleDisplayColorize()">
                    <option value="0" <?php if($apply_colorize == false){echo 'selected';}?>>No</option>
                    <option value="1" <?php if($apply_colorize == true){echo 'selected';}?>>Yes</option>
                </select>
                
                <div id="colorize" <?php if($apply_colorize == true){echo 'style="display:block"';}?>><br>
                    <div id="colorize-color" style="background-color:rgb(<?php echo "$red_number, $green_number, $blue_number"; ?>);"></div><br><br>
                    
                    <label for="green">Red <span id="red-number"><?php echo $red_number; ?></span></label>    
                    <input type="range" id="red" name="red" min="0" max="255" value="<?php echo $red_number; ?>" onchange="SettingsSliderChange(this.id)"><br>
                    
                    <label for="green">Green <span id="green-number"><?php echo $green_number; ?></span></label>    
                    <input type="range" id="green" name="green" min="0" max="255" value="<?php echo $green_number; ?>" onchange="SettingsSliderChange(this.id)"><br>
                    
                    <label for="blue">Blue <span id="blue-number"><?php echo $blue_number; ?></span></label>    
                    <input type="range" id="blue" name="blue" min="0" max="255" value="<?php echo $blue_number; ?>" onchange="SettingsSliderChange(this.id)"><br>
                </div>
                
                <label for="apply-greyscale">Convert to Grey Scale</label><br>
                <select id="apply-greyscale" name="apply-greyscale">
                    <option value="0" <?php if($apply_greyscale == false){echo 'selected';}?>>No</option>
                    <option value="1" <?php if($apply_greyscale == true){echo 'selected';}?>>Yes</option>
                </select>
                
                <label for="apply-negate">Invert Colors</label><br>
                <select id="apply-negate" name="apply-negate">
                    <option value="0" <?php if($apply_negate == false){echo 'selected';}?>>No</option>
                    <option value="1" <?php if($apply_negate == true){echo 'selected';}?>>Yes</option>
                </select>

                <label for="apply-vignette">Apply Vignette</label><br>
                <select id="apply-vignette" name="apply-vignette">
                    <option value="0" <?php if($apply_vignette == false){echo 'selected';}?>>No</option>
                    <option value="1" <?php if($apply_vignette == true){echo 'selected';}?>>Yes</option>
                </select>

                <input type="submit" value="Generate">
            </form>
            <a href="galaxy.png" download>
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
                else if(element == 'red' || element == 'green' || element == 'blue'){
                    var red = document.getElementById('red').value;
                    var green = document.getElementById('green').value;
                    var blue = document.getElementById('blue').value;
                    
                    document.getElementById('colorize-color').style.backgroundColor = "rgb("+ red + "," + green + "," + blue + ")";
                    if(element == 'red'){ document.getElementById("red-number").innerHTML = red;};
                    if(element == 'green'){ document.getElementById("green-number").innerHTML = green;};
                    if(element == 'blue'){ document.getElementById("blue-number").innerHTML = blue;};
                }
                else{
                    document.getElementById(element + "-number").innerHTML = val;
                }
            }
            
            // Show / Hide colorize div
            function ToggleDisplayColorize(){
                if(document.getElementById('apply-colorize').selectedIndex == 1){
                    document.getElementById('colorize').style.display = 'block';
                }
                else{
                    document.getElementById('colorize').style.display = 'none';
                }
            }
            </script>
          </ul>
        </div>

        <img id="galaxy" class="dragme" src="galaxy.png" alt="galaxy">

    </body>
</html>
