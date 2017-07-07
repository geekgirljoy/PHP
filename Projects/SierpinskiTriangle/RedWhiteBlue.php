<?php
set_time_limit(300); // 5 Minutes Adjust as needed
ini_set('memory_limit', '2G'); // 2 GB Adjust as needed


$images;
$buffered;

$density = 1000000; // Higher density will plot more points but is costly on large images
$x = 4000; // Reset $x
$y = 4000; // Reset $y

$inset = 10;
$points[0] = array('x' => $x / 2, 'y' =>  $inset); // Top
$points[1] = array('x' =>   $inset, 'y' => $y - 0); // Left
$points[2] = array('x' => $x - $inset, 'y' => $y - 0); // Right
$image = imagecreatetruecolor($x, $y); // Create the image resource 

$red = imagecolorallocate($image, 255, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$blue = imagecolorallocate($image, 0, 0, 255);

for ($i = 1; $i < $density; $i++) { // Higher density will plot more points but is costly on large images

  if($x < 4000 / 3){$color = $red;}
  elseif($x > ((4000 / 3)) && $x < ((4000 / 3)*2) ){$color = $white;}
  else{$color = $blue;}

  imagesetpixel($image, round($x),round($y), $color); // Plot the current position
  $a = mt_rand(0, 2); // Randomly select any one of the 3 vertex points for next the iteration
  
  // Move half the distance from your current position 
  // to the selected vertex for next the iteration
  $x = ($x + $points[$a]['x']) / 2;
  $y = ($y + $points[$a]['y']) / 2;
}

imagejpeg($image , "RedWhiteBlue.jpg"); // Save the image 

imagedestroy($image); // Free memory

?>
