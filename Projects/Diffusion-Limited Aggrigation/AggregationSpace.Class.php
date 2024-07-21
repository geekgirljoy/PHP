<?php

// Use the random walker class
require_once('RandomWalker.Class.php');

class AggregationSpace{
    // Dimensions of the aggregation space
    private $width;
    private $height;
    private $aggregation_space; // 2D array
    private $random_walker_space; // 2D array
    private $max_random_walkers = 1;
    private $random_walkers = [];
    private $completion_density = 0.25;

    public function __construct($width = 9, $height = 9, $completion_density = 0.25){
        $this->width = $width;
        $this->height = $height;
        $this->completion_density = $completion_density;

        // Populate the aggregation and random walker 2D spaces with zeros
        $this->aggregation_space = array_fill(0, $this->height, array_fill(0, $this->width, 0));
        $this->random_walker_space = array_fill(0, $this->height, array_fill(0, $this->width, 0));

        // The the maximum number of random walkers for the aggregation space to 7% of the total number of cells (rounded up to the nearest whole number)
        $this->max_random_walkers = ceil(($width * $height) * 0.07);
        
        // Create random walkers
        $this->CreateWalkers();
    }

	// For Seeding the aggregation_space with aggregation points for the walkers to stick to
    public function CreateSeedAggregationPoints($seed_points){
        // Add the seed points to the aggregation space
        foreach($seed_points as $point){
            $this->aggregation_space[$point[1]][$point[0]] = rand() / getrandmax();
        }
    }

	// Create Walkers
    public function CreateWalkers(){
        // Create random walkers by picking random x and y positions and adding them to the random walkers array
        do{
            $this->random_walkers[] = new RandomWalker(rand(0, $this->width - 1), rand(0, $this->height - 1), rand() / getrandmax());
        }while(count($this->random_walkers) < $this->max_random_walkers);
    }

	// An AggregationCycle is where Walkers move and try to aggregate
    function AggregationCycle(){
        // Move Walkers randomly 1 step as though subject to Brownian motion
        foreach($this->random_walkers as $walker){
            $walker->Move($this->width, $this->height);
        }

        // Update the random walker space - Yeah.... I could probably make this more efficient by moving the walkers within the space instead of dumping it and rebuilding every AggregationCycle(), but I'm being a lazy and fu..[radio edit] my contribution to entropy and the heat death of the universe!
        $this->random_walker_space = array_fill(0, $this->height, array_fill(0, $this->width, 0)); // Clear the previous random walker space
        foreach($this->random_walkers as $walker){
            $this->random_walker_space[$walker->GetY()][$walker->GetX()] = $walker->GetValue();
        }

        // Update the aggregation space by checking for N,S,E,W & NE, NW, SE, SW neighbors > 0
        // If a neighbor is > 0, set the current cell to 1 and remove the walker
        foreach($this->random_walkers as $key=>$walker){
            $x = $walker->GetX();
            $y = $walker->GetY();

            // Check for neighbors
            $north = $y - 1;
            $south = $y + 1;
            $east = $x + 1;
            $west = $x - 1;

            // Check if the neighbors are out of bounds
            if($north < 0){
                $north = 0;
            }
            if($south >= $this->height){
                $south = $this->height - 1;
            }
            if($east >= $this->width){
                $east = $this->width - 1;
            }
            if($west < 0){
                $west = 0;
            }

            // Check if the neighbors are > 0
            if($this->aggregation_space[$north][$x] > 0 // North
			|| $this->aggregation_space[$north][$east] > 0 // North East
			|| $this->aggregation_space[$y][$east] > 0  // East
			|| $this->aggregation_space[$south][$east] > 0 // South East
			|| $this->aggregation_space[$south][$x] > 0 // South
			|| $this->aggregation_space[$south][$west] > 0 // South West
			|| $this->aggregation_space[$y][$west] > 0  // West
			|| $this->aggregation_space[$north][$west] > 0 // North West
			){
                // Set the current cell to walker value
                $this->aggregation_space[$y][$x] = $walker->GetValue();
                
				// Remove the walker
                unset($this->random_walkers[$key]);
            }
        }

        $this->CreateWalkers(); // Create new walkers if any were removed
    }

	// I make a 2D array linearly bigger
    public function LinearUpscale($initial_array) {
        $initial_rows = count($initial_array);
        $initial_cols = count($initial_array[0]);
        $upscaled_rows = $initial_rows * 2;
        $upscaled_cols = $initial_cols * 2;
    
        // Initialize the upscaled array with zeros
        $upscaled_array = array_fill(0, $upscaled_rows, array_fill(0, $upscaled_cols, 0));
    
        // Fill the upscaled array
        for ($i = 0; $i < $initial_rows; $i++) {
            for ($j = 0; $j < $initial_cols; $j++) {
                // Fill the corresponding 2x2 block in the upscaled array
                $upscaled_array[$i * 2][$j * 2] = $initial_array[$i][$j];
                $upscaled_array[$i * 2][$j * 2 + 1] = $initial_array[$i][$j];
                $upscaled_array[$i * 2 + 1][$j * 2] = $initial_array[$i][$j];
                $upscaled_array[$i * 2 + 1][$j * 2 + 1] = $initial_array[$i][$j];
            }
        }

        return $upscaled_array;
    }

	// I make a 2D array linearly smaller
    public function LinearDownScale($initial_array) {
        $upscaled_rows = count($initial_array);
        $upscaled_cols = count($initial_array[0]);
        $downscaled_rows = $upscaled_rows / 2;
        $downscaled_cols = $upscaled_cols / 2;
    
        // Initialize the original array
        $downscaled_array = array_fill(0, $downscaled_rows, array_fill(0, $downscaled_cols, 0));
    
        // Fill the original array
        for ($i = 0; $i < $downscaled_rows; $i++) {
            for ($j = 0; $j < $downscaled_cols; $j++) {
                // Calculate the average of the corresponding 2x2 block in the upscaled array
                $sum = $initial_array[$i * 2][$j * 2] +
                       $initial_array[$i * 2][$j * 2 + 1] +
                       $initial_array[$i * 2 + 1][$j * 2] +
                       $initial_array[$i * 2 + 1][$j * 2 + 1];
                $downscaled_array[$i][$j] = $sum / 4;
            }
        }
    
        return $downscaled_array;
    }

	// Need to check the density if the aggregation_space? Use CalculateAggregationSpaceDensity()
    public function CalculateAggregationSpaceDensity(){
                
        // Number of rows
        if($this->height == 0){
            return 0;
        }
        
        // Number of columns
        if($this->width == 0){
            return 0;
        }
    
        // Sum of all values in the aggregation space
        $total_sum = 0;
        foreach($this->aggregation_space as $row){
            $total_sum += array_sum($row);
        }

        // Calculate the density of an aggregation space
        $total_cells = $this->height * $this->width; // Total number of cells in the aggregation space
        $density = $total_sum / $total_cells; // Average density
        return $density; // Return the average density
    }

	// I'm not useful on large aggregation spaces
    public function PrintAggregationSpace(){
        // Print the aggregation space
        echo PHP_EOL;
        foreach($this->aggregation_space as $row){
            foreach($row as $cell){
                echo $cell . ' ';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

	// I'm not useful on large aggregation spaces
    public function PrintRandomWalkerSpace(){
        // Print the random walker space
        echo PHP_EOL;
        foreach($this->random_walker_space as $row){
            foreach($row as $cell){
                echo $cell . ' ';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

	// I may use this in the future to do fun cool things... we'll see
    function gradient($n, $factor = 1){
        return 1-(1/(1+($n*$factor))); // gradient
    }

	// Need to get the actual aggregation_space 2D array but it sucks that I made it a private class property? Use GetAggregationSpace()
    function GetAggregationSpace(){
        return $this->aggregation_space;
    }
}

// Example usage:
// $aggregation_space = new AggregationSpace();
// $aggregation_space = new AggregationSpace($width = 9, $height = 9, $completion_density = 0.25);