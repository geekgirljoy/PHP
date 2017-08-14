<?php 

set_time_limit(300); // 5 Minutes adjust as needed
ini_set('memory_limit', '3G'); // 3 GB Adjust as needed


// https://github.com/geekgirljoy/PHP/blob/master/Loose%20Code/SigmoidFunction.php
function sigmoid($t){
    return 1 / (1 + exp(-$t));
}


// Roughness Level
$min_roughness = -4;
$max_roughness = 4;

// Water Level
if(isset($_POST["water-level"])){$water_level = $_POST["water-level"];}
else{$water_level = -0.3;}

if(isset($_POST["snow-level"])){$snow_level = $_POST["snow-level"];}
else{$snow_level = 2;}



// Terrain Type
if(isset($_POST["terrain-type"])){$terrain_type = $_POST["terrain-type"];}
else{$terrain_type = 'lush';}





// Step 1. Determine the grid $exponent size
if(isset($_POST["exponent"])){$exponent = $_POST["exponent"];}
else{$exponent = 6;}



// Step 2. Raise 2 to the power of $exponent
// because we start counting with 0 we don't add 1
// this is the length of the rows and columns
$size =  pow(2, $exponent);

// Step 3. Create a $terrain array of (row $size, col $size) 
// and populate with nulls so we can check if the position 
// value has been set yet
$terrain = array_fill(0, $size+1, array_fill(0, $size+1, NULL));

// Step 4. Set the four corner points of $terrain
// to initial random values within the acceptable roughness range.
$a = $terrain[0][0] = mt_rand($min_roughness, $max_roughness);
$b = $terrain[0][$size] = mt_rand($min_roughness, $max_roughness);
$c = $terrain[$size][0] = mt_rand($min_roughness, $max_roughness);
$d = $terrain[$size][$size] = mt_rand($min_roughness, $max_roughness);
$average = $a + $b + $c + $d;

// Step 5. Set Center (Diamond Step)
$row = $size/2;
$col = $size/2;
$e = $terrain[$row][$col] = ( $average + mt_rand($min_roughness, $max_roughness)) / 5;



// Step 6. Alternate between the diamond and square walks until all array values have been set.
$chunk_size = $size;
for($level = 1; ($chunk_size / $level) > 0.1; $level++){
	for($row_offset = 0; $row_offset <= $size; $row_offset+=$chunk_size){
		for($col_offset = 0; $col_offset <= $size; $col_offset+=$chunk_size){
			
			// Do (Square Step)
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset - $chunk_size/2][$col_offset])){
				$terrain[$row_offset - $chunk_size/2][$col_offset] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$a = $terrain[$row_offset - $chunk_size/2][$col_offset];
			
            // if the position is not already set then set it
			if(!isset($terrain[$row_offset][$col_offset - $chunk_size/2])){
				$terrain[$row_offset][$col_offset - $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$b = $terrain[$row_offset][$col_offset - $chunk_size/2];
			
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset][$col_offset + $chunk_size/2])){
				$terrain[$row_offset][$col_offset + $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$c = $terrain[$row_offset][$col_offset + $chunk_size/2];
			
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset + $chunk_size/2][$col_offset])){
				$terrain[$row_offset + $chunk_size/2][$col_offset] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$d = $terrain[$row_offset + $chunk_size/2][$col_offset];
			
			// Computer the average height of $a + $b + $c + $d
			$average = $a + $b + $c + $d;
						
			// Set Center (Diamond Step)
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2])){
				$terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$e = $terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2];
		}
	}

	// Reduce the chunk size
	$chunk_size = $chunk_size/2;
}


$rows = $size;
$cols = $size;
$image = imagecreatetruecolor($rows, $cols); // Create the image resource



for ($row = 0; $row < $rows; $row++) {
	for ($col = 0; $col < $cols; $col++) {
		
	  $value =  sigmoid($terrain[$row][$col])*255;
	  
	  // ground
	  if($terrain[$row][$col] > $water_level && $terrain[$row][$col] < $snow_level){
		  if($terrain_type == 'moon'){$color = imagecolorallocate($image, $value, $value , $value);}
		  elseif($terrain_type == 'lush'){$color = imagecolorallocate($image, 0, $value , 0);}
		  elseif($terrain_type == 'desert'){$color = imagecolorallocate($image, $value, $value/2 , $value/4);}
		  elseif($terrain_type == 'alien'){$color = imagecolorallocate($image, $value, $value/2 , $value/1);}
      }
	  elseif($terrain[$row][$col] >= $snow_level){
		  $color = imagecolorallocate($image, 255-$value/3, 255-$value/3,255-$value/3);
      }
	  // water
	  else{
		  if($terrain_type != 'moon'){ $color = imagecolorallocate($image, 0 , 0, $value); }
		  else{$color = imagecolorallocate($image, $value, $value , $value);}
	  }
      imagesetpixel($image, $row, $col, $color); // Plot the current terrain position
	  
	}
}

imagejpeg($image , "terrain.jpg"); // Save the image 
imagedestroy($image); // Free memory


?>

<html>
<head>
<title>Ancestor Simulations Generating Planet Terrain</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="menu-container" width="300px" height="500px">
  <ul id="menu-toggle" width="300px" height="500px">
	<form action="#" method="POST">
	
	    <label for="exponent">Map Size <span id="exponent-number"><?php echo $exponent . ' (' . $size . 'x' . $size .'px)'; ?></span></label>	
		<input type="range" id="exponent" name="exponent" min="2" max="12" value="<?php echo $exponent; ?>" onchange="SettingsSliderChange(this.id)"><br>
		
		<label for="terrain-type">Terrain Color Palette</label><br>
		<select id="terrain-type" name="terrain-type">
			<option value="moon" <?php if($terrain_type == 'moon'){echo 'selected';}?>>Moon</option>
			<option value="lush" <?php if($terrain_type == 'lush'){echo 'selected';}?>>Lush</option>
			<option value="desert" <?php if($terrain_type == 'desert'){echo 'selected';}?>>Desert</option>
			<option value="alien" <?php if($terrain_type == 'alien'){echo 'selected';}?>>Alien</option>
		</select>
		
		<label for="water-level">Water</label><br>
		<select id="water-level" name="water-level" >
			<option value="-4" <?php if($water_level == -4){echo 'selected';}?>>None</option>
			<option value="-0.7" <?php if($water_level == -0.7){echo 'selected';}?>>Small Lakes</option>
			<option value="-0.3" <?php if($water_level == -0.3){echo 'selected';}?>>Lakes</option>
			<option value="-0.1" <?php if($water_level == -0.1){echo 'selected';}?>>Large Lakes</option>
			<option value="0.5" <?php if($water_level == 0.5){echo 'selected';}?>>Big Islands</option>
			<option value="1" <?php if($water_level == 1){echo 'selected';}?>>Small Islands</option>
			<option value="4" <?php if($water_level == 4){echo 'selected';}?>>Water World</option>
		</select>
		
		<label for="snow-level">Snow</label><br>
		<select id="snow-level" name="snow-level" >
			<option value="2" <?php if($snow_level == 2){echo 'selected';}?>>None</option>
			<option value="1" <?php if($snow_level == 1){echo 'selected';}?>>Little Snow Capped Peaks</option>
			<option value="0.7" <?php if($snow_level == 0.7){echo 'selected';}?>>Small Snow Capped Peaks</option>
			<option value="0.5" <?php if($snow_level == 0.5){echo 'selected';}?>>Large Snow Capped Peaks</option>
			<option value="0.3" <?php if($snow_level == 0.3){echo 'selected';}?>>Winter Wonderland!</option>
		</select>
		
		<input type="submit" value="Generate">
	</form>
	<a href="terrain.jpg" download>
	<button>Save</button>
	</a>
	<script>
	function SettingsSliderChange(element) {
		var val = document.getElementById(element).value;
		var px = Math.pow(2, val) + 1;
		var size = " (" + px + "x" + px + "px" + ")";
		document.getElementById(element + "-number").innerHTML = val + size;
		
	}
	</script>
  </ul>
</div>

<img src="terrain.jpg">
</body>
</html>