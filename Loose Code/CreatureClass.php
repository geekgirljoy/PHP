<?php

set_time_limit(86400); /* Do not allow this script to run longer than 24 hours. */

/*////////////////////////*/
/* The Grid is the 'play' area or 'world space'. */
class Grid {
    public $width = 0;  /* X Pos. */
	public $height = 0; /* Y Pos. */
	public $depth = 0;  /* Z Pos. */
	
	/* What happens when a new Grid is made: */
	function __construct($param) {
		if(isset($param['width'])){ $this->width = $param['width']; }    /* If a width was provided scale the grid. */
		if(isset($param['height'])){ $this->height = $param['height']; } /* If a height was provided scale the grid. */
		
		if(isset($param['depth'])){ $this->zPos = $param['depth']; } /* If a depth was provided scale the grid.
		                                                             // * Including depth > 0 makes the Grid a 3D Space.
																	 // * Excluding a depth or setting it to 0 makes the Grid a 2D Plane.
		                                                             */
		echo "New Map Created! <br/>"; /* Report Activity */
	}
}

/* Creature Class */
class Creature {
	public $name;      /* The name of this specific creature. */
	public $gender;    /* The biological sex of this specific creature. 
	                   // 0 asexual
					   // 1 female
					   // 2 male
					   */
	public $xPos;      /* X grid position */
	public $yPos;      /* Y grid position */
	public $zPos;      /* Z grid position */
	public $hunger;    /* 0 - 100 */
	
	public $direction; /* 
	                   // 123
	                   // 456 ( 5 = don't move / stand still
					   // 789
					   */
					   
	public $can_see = false; /* Convert to a floating point so there can be levels of visual ability */

	/* What happens when a new creature is made: */
	function __construct($param) {
		if(isset($param['name'])){ $this->name = $param['name']; }
		if(isset($param['gender'])){ $this->gender = $param['gender']; }
		if(isset($param['xPos'])){ $this->xPos = $param['xPos']; }
		if(isset($param['yPos'])){ $this->yPos = $param['yPos']; }
		if(isset($param['zPos'])){ $this->zPos = $param['zPos']; }
		if(isset($param['hunger'])){ $this->hunger = $param['hunger']; }
		if(isset($param['direction'])){ $this->direction = $param['direction']; }
		echo "New Creature Born! Location: (X:" . $this->xPos . ")(Y:" . $this->yPos . ")(Z:" . $this->zPos . ")<br/>"; /* Report Activity */
	}

	/* what happens when a creature eats */
	public function eat($food) {
	    $this->hunger += $food;
		if($this->hunger > 100){ $this->hunger = 100; }
		return $this->name . " is eating... Nom Nom Nom! My hunger is now " . $this->hunger . ". "; /* Report Activity */
	}
	
	/* what happens when a creature moves */
	public function move() {
		$output = $this->name . " is moving from " . $this->xPos . ", " . $this->yPos . ", " . $this->zPos . " to ";
		// 123
	    // 456 ( 5 = don't move / stand still
		// 789
	    if($this->direction == 1){$this->xPos--; $this->yPos--;}
		if($this->direction == 2){$this->yPos--;}
		if($this->direction == 3){$this->xPos++; $this->yPos--;}
		if($this->direction == 4){$this->xPos--;}
		if($this->direction == 5){} // stand still
		if($this->direction == 6){$this->xPos++;}
		if($this->direction == 7){$this->xPos--; $this->yPos++;}
		if($this->direction == 8){$this->yPos++;}
		if($this->direction == 9){$this->xPos++; $this->yPos++;}
		return  $output .  $this->xPos . ", " . $this->yPos . ", " . $this->zPos . ". "; /* Report Activity */
	}

	/* what happens when a creature thinks - Currently Random */
	public function think() {
		$output = $this->name . " is thinking. ";
		
		/* Add checks to creature state and surrounding area here */
		
		/* Is food present? Am I hungry? Prefer Eat Response */
		/* Is enemy present? Prefer Fight/Flight Response */
		/* Am I in a Pack/Herd?  Move With Herd Response*/
		/* Move Response */
		
		$random_action = mt_rand ( 0 , 1 ); /* replace with evaluation of state and preference */
		$output .= $this->name . " Has decided to ";
		
		if($random_action == 0){ $output .= "move. " . $this->move(); }
		if($random_action == 1){ $output .= "eat. " . $this->eat(mt_rand ( 1 , 100 )); }
		
		return $output; /* Report Activity */
	}
}

/* food */
class Food {
	public $satiety;   /* 1 - 100 */
	public $xPos;      /* x grid position */
	public $yPos;      /* y grid position */
	public $zPos;      /* z grid position */
   
    /* What happens when a new food source is made: */
	function __construct($param)	{
		if(isset($param['satiety'])){ $this->satiety = $param['satiety']; }
		if(isset($param['xPos'])){ $this->xPos = $param['xPos']; }
		if(isset($param['yPos'])){ $this->yPos = $param['yPos']; }
		if(isset($param['zPos'])){ $this->zPos = $param['zPos']; }
		echo "New Food Source! Location: (X:" . $this->xPos . ")(Y:" . $this->yPos . ")(Z:" . $this->zPos . ")<br/>"; /* Report Activity */
	}
}



?>

<html>
  <head>
    <title>Evolution</title>
  </head>
  <body>
    <p>
	
<?php


/* Create map */
$new_map = new Grid( array('width'=>mt_rand ( 256 , 512 ), 'height'=>mt_rand ( 256 , 512 ), 'depth'=>mt_rand ( 256 , 512 )) );


$number_of_creatures = 5;
$number_of_epochs = 500000;
$Creatures = array();

/* Create all the creatures */
for($i=0;$i< $number_of_creatures; $i++)
{
	$gender = mt_rand ( 0 , 2 );
	if($gender == 0){$gender = "asexual";}
	elseif($gender == 1){$gender = "female";}
	if($gender == 2){$gender = "male";}
	$new_creature = new Creature( 
							array(
								  'name'=>substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6),
								  'gender'=>$gender,
								  'xPos'=>mt_rand ( 0 , $new_map->width ),
								  'yPos'=>mt_rand ( 0 , $new_map->height ),
								  'zPos'=>mt_rand ( 0 , $new_map->depth ),
								  'direction'=>mt_rand ( 1 , 9 ),
								  'hunger'=>mt_rand ( 50 , 100 ), /* Random hunger level between 50 - 100 on start */
								  /* 'hunger'=>100 ,  */          /* Hunger is always 100 at birth */
								  'direction'=>mt_rand ( 1 , 9 )
								 )
	);

	array_push($Creatures, $new_creature );
}

echo "<br/>";

/* Test all the creatures */
echo "Testing Creatures.<br/><br/>";
foreach ($Creatures as $Creature) 
{
	/* 
	*/
    // Test Creature Class
	if (is_a($Creature, "Creature")) 
	{ 
		echo "I'm a Creature.<br/>"; 
		// Properties
		if (property_exists($Creature, 'name')) { echo 'My name is ' . $Creature->name . '. <br/>';}
		if (property_exists($Creature, 'gender')) { echo 'My gender is ' . $Creature->gender . '. <br/>';}
		if (property_exists($Creature, 'xPos')) { echo 'My xPos is ' . $Creature->xPos . '. <br/>';}
		if (property_exists($Creature, 'yPos')) { echo 'My yPos is ' . $Creature->yPos . '. <br/>';}
		if (property_exists($Creature, 'zPos')) { echo 'My zPos is ' . $Creature->zPos . '. <br/>';}
		if (property_exists($Creature, 'hunger')) { echo 'My hunger level is ' . $Creature->hunger . '. <br/>';}
		if (property_exists($Creature, 'direction')) {   
	        echo 'My direction is ' . $Creature->direction . ' (';
			
			
		   // 123
		   // 456 ( 5 = don't move / stand still
		   // 789
			switch( $Creature->direction ){
				case 1:
					 echo "&#8598;";
					break;
				case 2:
					 echo "&#8593;";
					break;
				case 3:
					 echo "&#8599;";
					break;
				case 4:
					 echo "&#8592;";
					break;
				case 5:
					 echo "&#9746;";
					break;
				case 6:
					 echo "&#8594;";
					break;
				case 7:
					 echo "&#8601;";
					break;
				case 8:
					 echo "&#8595;";
					break;
				case 9:
					 echo "&#8600;";
					break;
			}			
	    }
        echo "). <br/>";
		// Methods
		if (method_exists($Creature, "eat")){ echo $Creature->eat(10); }
		if (method_exists($Creature, "move")){ echo $Creature->move(); }
		if (method_exists($Creature, "think")){ echo $Creature->think(); }
	}
	
	echo "<br/><br/>";
	
}
echo "All creatures tested.<br/><br/>";


/* Place all the creatures on map here*/

/* Run through $number_of_epochs and chart each creature / species progress here */



?>
    </p>
  </body>
</html>