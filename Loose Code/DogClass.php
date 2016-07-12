<!DOCTYPE html>
<html>
	<head>
	  <title>Dog Class</title>
	</head>
	<body>
      <p>
        <?php
        class Dog
        {
            public $numLegs = 4;
            public $name;
            
            public function __construct($name)
            {
                $this->name = $name;
            }
            
            public function bark()
            {
                return "Woof!";
            }
            public function greet()
            {
                return "Hello, my name is " . $this->name;
            }
        }
        
        $dog1 = new Dog("Barker");
        $dog2 = new Dog("Amigo");
        
        echo $dog1->bark();
        echo "<br/>";
        echo $dog2->greet();
        
        ?>
      </p>
    </body>
</html>