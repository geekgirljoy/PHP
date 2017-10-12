<?php

function UpdateWorld($world_array, $world_size, $generation){
    $world_array_prev = $world_array;
    
    /* Create Image */
    if($GLOBALS['save_images'] == true){
        // Image ///////////////////////////////////
        $image = imagecreatetruecolor($world_size, $world_size); /* New Image */
        $dead = imagecolorallocate($image, 0, 0, 0);  /* Allocate Black as the Dead color */
        $alive = imagecolorallocate($image, 0, 176, 80); /* Allocate Alive color */
        ////////////////////////////////////////////
    }
    

    for($row = 0; $row < $world_size; $row++){
        for($col = 0; $col < $world_size ; $col++){
            
             /* Get Neighbourhood Values*/
             /*
             NW N NE 
             W [@] E
             SW S SE 
             */             
             
            // NW
            /* If this is the first row & col in world_array */
            /* Wrap around and set $NW to the last row & col value in array */
            /* Otherwise $NW = one row up and to the left */
            if($row == 0){$r = $world_size - 1;}
            else{$r = $row - 1;}
            if($col == 0){$c = $world_size - 1;}
            else{$c = $col - 1;}
            $NW = $world_array_prev[$r][$c];
                    
            // N
            /* If this is the first row in world_array */
            /* Wrap around and set $N to row value in array */
            /* Otherwise $N = one row up  */
            if($row == 0){$r = $world_size - 1;}
            else{$r = $row - 1;}
            $N = $world_array_prev[$r][$col];
             
            // NE
            if($row == 0){$r = $world_size - 1;}
            else{$r = $row - 1;}
            if($col == $world_size - 1){$c = 0;}
            else{$c = $col + 1;}
            $NE = $world_array_prev[$r][$c];            
            
            // W
            if($col == 0){$c = $world_size - 1;}
            else{$c = $col - 1;}
            $W = $world_array_prev[$row][$c];        
            
            // E
            if($col == $world_size - 1){$c = 0;}
            else{$c = $col + 1;}
            $E = $world_array_prev[$row][$c];    
            
            // SW
            if($row == $world_size - 1){$r = 0;}
            else{$r = $row + 1;}
            if($col == 0){$c = $world_size - 1;}
            else{$c = $col - 1;}
            $SW = $world_array_prev[$r][$c];
            
            // S
            if($row == $world_size - 1){$r = 0;}
            else{$r = $row + 1;}
            $S = $world_array_prev[$r][$col];
            
            // SE
            if($row == $world_size - 1){$r = 0;}
            else{$r = $row + 1;}
            if($col == $world_size - 1){$c = 0;}
            else{$c = $col + 1;}
            $SE = $world_array_prev[$r][$c];
             
             
            $neighbours = ($NW + $N + $NE + $W + $E + $SW + $S + $SE);
            $new_value = 0;
            
            // if alive apply survival rules
            if($world_array[$row][$col] == 1){
                foreach($GLOBALS['survival_rules'] as $rule){
                    if($neighbours == $rule){
                        $new_value = 1;
                        break; // stop checking
                    }
                }
            }else{ // if dead apply birth rules
                foreach($GLOBALS['birth_rules'] as $rule){
                    if($neighbours == $rule){
                        $new_value = 1;
                        break; // stop checking
                    }
                }
            }
            $world_array[$row][$col] = $new_value;
            
                        
            /* Draw Image */
            if($GLOBALS['save_images'] == true){
                if($new_value == 1){
                    imagesetpixel($image, $row, $col, $alive); /* Set Pixel */
                    
                }else{
                    imagesetpixel($image, $row, $col, $dead); /* Set Pixel */
                }
            }
        }
    }
    
    /* Save Image */
    if($GLOBALS['save_images'] == true){
        imagepng($image, "images/$generation.png"); /* Output Image */
        imagedestroy($image);/* Free memory */
    }
    return $world_array;
}
/////////////////////////////////////////////////////////////////////////////////////



// World Setup ///////////////////////////////////
$exponent = 9;
$world_size = pow(2, $exponent) + 1; // 513
$world = array_fill(0, $world_size, array_fill(0, $world_size, 0));
$number_of_generations = 1000;

// Number of neighbors required for a cellular mitosis "cell birth"
$birth_rules = array(3);

// Number of neighbors required for cell to remain alive
$survival_rules = array(2, 3);

$save_images = true;

//// pick 1 ////////////////////////////////
// 1 = random
// 2 = glider wall
$generate_seed = 1;
////////////////////////////////////////////

if($generate_seed == 1){
    $max_number_of_random_cells_to_generate = ($world_size * $world_size) / 2;
    $number_of_cells = mt_rand($world_size, $max_number_of_random_cells_to_generate);
    for($i = 0; $i <= $number_of_cells; $i++){
        $r = mt_rand(0, $world_size);
        $c = mt_rand(0, $world_size);
        $world[$r][$c] = 1;
    }
}elseif($generate_seed == 2){
    for($i = 1; $i < ($world_size / 2); $i++ ){
        // Glider
        $world[4][2 + ($i * 5)] = 1;
        $world[4][3 + ($i * 5)] = 1;
        $world[4][4 + ($i * 5)] = 1;
        $world[3][4 + ($i * 5)] = 1;
        $world[2][3 + ($i * 5)] = 1;
    }
}


///// Output image of Seed /////////////////////////////////////////////////////////
$image = imagecreatetruecolor($world_size, $world_size); /* New Image */
$dead = imagecolorallocate($image, 0, 0, 0);  /* Allocate Black as the Dead color */
$alive = imagecolorallocate($image, 0, 176, 80); /* Allocate Alive color */    
for($row = 0; $row < $world_size; $row++){    
    for($col = 0; $col < $world_size ; $col++){
        if($world[$row][$col] == 1){
            imagesetpixel($image, $row, $col, $alive); /* Set Pixel */
        }
        else{
            imagesetpixel($image, $row, $col, $dead); /* Set Pixel */
        }
    }
}
imagepng($image, "images/0.png"); /* Output Image */
imagedestroy($image);/* Free memory */
/////////////////////////////////////////////////////////////////////////////////////

    

///// Proceed for all generations /////////////////////////////////////////////////////////    
for($generation = 1; $generation < $number_of_generations; $generation++){
    $world = UpdateWorld($world, $world_size, $generation);
}
echo PHP_EOL . "Game Complete!" . PHP_EOL;
