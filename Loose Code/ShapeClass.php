<html>
  <head>
    <title>The Shape of Things to Come</title>
  </head>
  <body>

<?php
class Shape 
{
    public $has_sides = true;
    public $num_of_sides;
    public $name;
}

class Triangle extends Shape{
    function __construct(){
        $this->name = 'Triangle';
        $this->num_of_sides = 3;
    }
}

class Square extends Shape{
   function __construct(){
        $this->name = 'Square';
        $this->num_of_sides = 4;
    }  
}

class Pentagon extends Shape{
	function __construct(){
		$this->name = 'Pentagon';
		$this->num_of_sides = 5;
	}
}

class Hexagon extends Shape{
	function __construct(){
		$this->name = 'Hexagon';
		$this->num_of_sides = '6';
	}
}

class Heptagon extends Shape{
	function __construct(){
		$this->name = 'Heptagon';
		$this->num_of_sides = 7;
	}
}

class Octagon extends Shape{
	function __construct()
	{
		$this->name = 'Octagon';
		$this->num_of_sides = 8;
	}
}

class Nonagon extends Shape{
	function __construct(){
		$this->name = 'Nonagon';
		$this->num_of_sides = 9;
	}
}

class Decagon extends Shape{
	function __construct(){
		$this->name = 'Decagon';
		$this->num_of_sides = 10;
	}
}



function Test($obj){
    if ( property_exists($obj,"has_sides") ){
        echo "<p>A $obj->name has $obj->num_of_sides sides!</p>" . PHP_EOL;
    }
}


// Instantiate for testing
$triangle = new Triangle(); 
$square = new Square();
$pentagon = new Pentagon();
$hexagon = new Hexagon();
$heptagon = new Heptagon();
$octagon = new Octagon();
$nonagon = new Nonagon();
$decagon = new Decagon();

// Run Tests
Test($triangle);
Test($square);
Test($pentagon);
Test($hexagon);
Test($heptagon);
Test($octagon);
Test($nonagon);
Test($decagon);
?>

  </body>
</html>