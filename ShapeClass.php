<html>
  <head>
    <title>The Shape of Things to Come</title>
  </head>
  <body>
    <p>
      <?php
        class Shape 
        {
            public $hasSides = true;
            public $numOfSides;
        }
        
        class Square extends Shape 
        {
            $numOfSides = 4;
        }
        
        $square = new Square();
        
        if ( property_exists($square,"hasSides") )
        {
          echo "I have " . $square->numOfSides . " sides!";
        }
      ?>
    </p>
  </body>
</html>