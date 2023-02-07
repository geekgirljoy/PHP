<?php

// A class to represent a 3D vector
class Vector3{

    // 3D vectors have 3d coordinates
    public $x;
    public $y;
    public $z;

    // A function to construct the vector
    public function __construct($x = 0, $y = 0, $z = 0){
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    // A function to echo the vector in a readable format
    public function Echo(){
        return "Vector3(x: {$this->x}, y: {$this->y}, z: {$this->z})";
    }

    // A function to set the vector
    public function Set($x, $y, $z){
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    // A function to add two vectors together
    public function Add(Vector3 $v){
        return new Vector3($this->x + $v->x, $this->y + $v->y, $this->z + $v->z);
    }

    // A function to subtract another vector from this one
    public function Subtract(Vector3 $v){
        return new Vector3($this->x - $v->x, $this->y - $v->y, $this->z - $v->z);
    }

    // A function to multiply this vector by another
    public function Multiply(Vector3 $v){
        return new Vector3($this->x * $v->x, $this->y * $v->y, $this->z * $v->z);
    }

    // A function to divide this vector by another
    public function Divide(Vector3 $v){
        return new Vector3($this->x / $v->x, $this->y / $v->y, $this->z / $v->z);
    }

    // A function to get the magnitude (length) of the vector
    public function Magnitude(){
        return sqrt($this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
    }

    // A function to get the normalized vector
    // This is a vector with the same direction as the original, but with a magnitude of 1
    public function Normalize(){
        $m = $this->Magnitude();
        return new Vector3($this->x / $m, $this->y / $m, $this->z / $m);
    }

    // A function to get the dot product
    public function Dot(Vector3 $v){
        return $this->x * $v->x + $this->y * $v->y + $this->z * $v->z;
    }

    // A function to get the cross product of this vector and another
    public function Cross(Vector3 $v){
        return new Vector3($this->y * $v->z - $this->z * $v->y, $this->z * $v->x - $this->x * $v->z, $this->x * $v->y - $this->y * $v->x);
    }

    // A function to get the angle between this vector and another
    public function Angle(Vector3 $v){
        return acos($this->Dot($v) / ($this->Magnitude() * $v->Magnitude()));
    }

    // A function to get the distance between this vector and another
    public function Distance(Vector3 $v){
        return sqrt(pow($this->x - $v->x, 2) + pow($this->y - $v->y, 2) + pow($this->z - $v->z, 2));
    }
}

// Create a new set of vectors
echo "Creating a new set of vectors" . PHP_EOL;
$v1 = new Vector3(1, 2, 3);
$v2 = new Vector3(0, 0, 0);

// Echo the vectors
echo "V1 = " . $v1->Echo() . PHP_EOL;
echo "V2 = " . $v2->Echo() . PHP_EOL;

// Set v2
echo "Setting V2 to (4, 5, 6)" . PHP_EOL;
$v2->Set(4, 5, 6);
echo "V2: " . $v2->Echo() . PHP_EOL;

// Add the two vectors together
echo "Adding V2 to V1" . PHP_EOL;
$v3 = $v1->Add($v2);
echo "V3: " . $v3->Echo() . PHP_EOL;

// Subtract v2 from v1
echo "Subtracting V2 from V1" . PHP_EOL;
$v4 = $v1->Subtract($v2);
echo "V4: " . $v4->Echo() . PHP_EOL;

// Multiply one vector by another
echo "Multiplying V2 by V1" . PHP_EOL;
$v5 = $v1->Multiply($v2);
echo "V5: " . $v5->Echo() . PHP_EOL;

// Divide one vector by another
echo "Dividing V1 by V2" . PHP_EOL;
$v6 = $v1->Divide($v2);
echo "V6: " . $v6->Echo() . PHP_EOL;

// Get the magnitude of v1
echo "Getting the magnitude of V1" . PHP_EOL;
$m = $v1->Magnitude();
echo "Magnitude: " . $m . PHP_EOL;

// Get the normalized vector
echo "Getting the normalized vector of V1" . PHP_EOL;
$v7 = $v1->Normalize();
echo "V7: " . $v7->Echo() . PHP_EOL;

// Get the dot product of two vectors
echo "Getting the dot product of V1 and V2" . PHP_EOL;
$d = $v1->Dot($v2);
echo "Dot Product: " . $d . PHP_EOL;

// Get the cross product of two vectors
echo "Getting the cross product of V1 and V2" . PHP_EOL;
$v8 = $v1->Cross($v2);
echo "V8: " . $v8->Echo() . PHP_EOL;

// Get the angle between two vectors
echo "Getting the angle between V1 and V2" . PHP_EOL;
$a = $v1->Angle($v2);
echo "Angle: " . $a . PHP_EOL;

// Get the distance between two vectors
echo "Getting the distance between Vector1 and Vector2" . PHP_EOL;
$d = $v1->Distance($v2);
echo "Distance: " . $d . PHP_EOL;

// A poem about vectors
$heredoc_poem = <<<EOT

Vectors in mathematics, a tool we employ,
To describe motion, direction, and Joy,
With a magnitude and direction, it's said,
A line from the origin, to its end, is what we've read.

A scalar may tell us size, that's true,
But a vector gives us more, it's not just a few,
It points us in a direction, with speed,
It's the difference between position A and B indeed.

From physics to engineering, they're everywhere,
In forces, velocities, they do their share,
Computing sum, difference, and scalar multiplication,
Vectors help us solve complex calculations.

So here's to the vectors, that make our work light,
With their lines and arrows, they guide us right,
In the world of mathematics, they're a treasure trove,
A tool we'll always have, as our minds do evolve.
EOT;

echo $heredoc_poem; // Oh Vector! My Vector!

?>
