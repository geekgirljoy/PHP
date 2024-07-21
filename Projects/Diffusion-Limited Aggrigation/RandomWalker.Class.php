<?php
class RandomWalker{
    // Dimensions of the aggregation space
    private $x_pos;
    private $y_pos;
    private $value;
    private $step = 1;

    public function __construct($x_pos = 0, $y_pos = 0, $value = 1){
        $this->x_pos = $x_pos;
        $this->y_pos = $y_pos;
        $this->value = $value;
        $this->step = 1;
    }

    public function Move($width, $height){
        $direction = rand(0, 7);

        switch($direction){
            case 0:
                $this->x_pos++; // Move east
                break;
            case 1:
                $this->x_pos--; // Move west
                break;
            case 2:
                $this->y_pos++; // Move south
                break;
            case 3:
                $this->y_pos--; // Move north
                break;
            case 4:
                $this->x_pos++; // Move southeast
                $this->y_pos++;
                break;
            case 5:
                $this->x_pos--; // Move southwest
                $this->y_pos++;
                break;
            case 6:
                $this->x_pos++; // Move northeast
                $this->y_pos--;
                break;
            case 7:
                $this->x_pos--; // Move northwest
                $this->y_pos--;
                break;
        }

        // Check if the walker is out of bounds and correct it
        if($this->x_pos < 0){
            $this->x_pos = 0;
        }elseif($this->x_pos >= $width){
            $this->x_pos = $width - 1;
        }
        if($this->y_pos < 0){
            $this->y_pos = 0;
        }elseif($this->y_pos >= $height){
            $this->y_pos = $height - 1;
        }
    }

    function __destruct(){
        //echo "Random walker destroyed!";
    }

    public function GetX(){
        return $this->x_pos;
    }

    public function GetY(){
        return $this->y_pos;
    }

    public function GetValue(){
        return $this->value;
    }

}

// Example usage:
// $walker = new RandomWalker(0, 0, 0.67);