<?php
// Use the AggregationSpace class
require_once('AggregationSpace.Class.php');


function CreateImage($agg, $width, $height, $completion_density, $i){
    // Create a new image
    $im = imagecreatetruecolor($width, $height);

    // Set a black background
    $bg = imagecolorallocate($im, 0, 0, 0);

    imagefilledrectangle($im, 0, 0, $width, $height, $bg);

    // Draw the aggregation space
    for($y = 0; $y < $height; $y++){
        for($x = 0; $x < $width; $x++){
            if($agg[$y][$x] > 0){
				 $value = floor($agg[$y][$x] * 255);
				 $color = imagecolorallocate($im, $value, $value, $value);
                imagesetpixel($im, $x, $y, $color);
            }
        }
    }

    // Output the image to a file
    imagepng($im, 'aggregation_space_'.$i.'_'.$completion_density.'.png');
}


// Create a new aggregation space
$aggregation_space = new AggregationSpace($width = 512, $height = 512, $completion_density = 0.05);

$report_every = 500; // Report every 500 Aggregation Cycles
$i = 0;
$seed_points = [];

// Generate a single seed point at the center of the aggregation space
$seed_points[] = [ceil($width / 2)-1, ceil($height / 2)-1];

// Generate 8 random seed aggregation points
//for($i = 0; $i < 8; $i++){
//    $seed_points[] = [rand(0, $width - 1), rand(0, $height - 1)];
//}

// Create the seed_points in our aggregation space
$aggregation_space->CreateSeedAggregationPoints($seed_points);

// Draw first frame
$agg = $aggregation_space->GetAggregationSpace();
CreateImage($agg, $width, $height, $aggregation_space->CalculateAggregationSpaceDensity(), $i);

// The Diffuion-Limited Aggregation Cycle:
do{
    $aggregation_space->AggregationCycle(); // Jiggle and stick
    $i++;
	
    // Reporting
    if($i % $report_every == 0){
        echo PHP_EOL . $i . PHP_EOL;
		
	// Not useful on large arrays
        //$aggregation_space->PrintAggregationSpace();
        //$aggregation_space->PrintRandomWalkerSpace();
		
        echo PHP_EOL . $aggregation_space->CalculateAggregationSpaceDensity() . ' of ' . $completion_density . PHP_EOL;
		
	// Draw current frame
        $agg = $aggregation_space->GetAggregationSpace();
        CreateImage($agg, $width, $height, $aggregation_space->CalculateAggregationSpaceDensity(), $i);
    }
}while($aggregation_space->CalculateAggregationSpaceDensity() < $completion_density);

// Draw last frame
$agg = $aggregation_space->GetAggregationSpace();
CreateImage($agg, $width, $height, $aggregation_space->CalculateAggregationSpaceDensity(), $i);
