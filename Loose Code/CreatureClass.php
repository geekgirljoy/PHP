<html>
  <head>
    <title>Evolution</title>
  </head>
  <body>
    <p>
<?php

////////////////////////////
class Grid 
{
    public $width = 0;  // x	
	public $height = 0; // y
	public $depth = 0;  // z
	
	function __construct($param)
	{
		if(isset($param['width'])){ $this->width = $param['width']; }
		if(isset($param['height'])){ $this->height = $param['height']; }
		if(isset($param['depth'])){ $this->zPos = $param['depth']; }
		echo "New Map Created! <br/>";
	}
}


class Creature 
{
	public $name;
	public $gender;    
	public $xPos;      // x grid position
	public $yPos;      // y grid position
	public $zPos;      // z grid position
	public $hunger;    // 0 - 100
	public $direction; // 123
	                   // 456 ( 5 = don't move / stand still
					   // 789

					   
	public $can_see = false;

	function __construct($param)
	{
		if(isset($param['name'])){ $this->name = $param['name']; }
		if(isset($param['gender'])){ $this->gender = $param['gender']; }
		if(isset($param['xPos'])){ $this->xPos = $param['xPos']; }
		if(isset($param['yPos'])){ $this->yPos = $param['yPos']; }
		if(isset($param['zPos'])){ $this->zPos = $param['zPos']; }
		if(isset($param['hunger'])){ $this->hunger = $param['hunger']; }
		if(isset($param['direction'])){ $this->direction = $param['direction']; }
		echo "New Creature Born! <br/>";
	}

	public function eat($food) 
	{
	    $this->hunger += $food;
		if($this->hunger > 100){ $this->hunger = 100; }
		return $this->name . " is eating... Nom Nom Nom! My hunger is now " . $this->hunger . ". ";
	}
	
	public function move() 
	{
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
		return  $output .  $this->xPos . ", " . $this->yPos . ", " . $this->zPos . ". ";
	}

	// Currently Random
	public function think() 
	{
		$output = $this->name . " is thinking. ";
		$random_action = mt_rand ( 0 , 1 );
		$output .= $this->name . " Has decided to ";
		
		if($random_action == 0){ $output .= "move. " . $this->move(); }
		if($random_action == 1){ $output .= "eat. " . $this->eat(mt_rand ( 1 , 100 )); }
		
		return $output;
	}
}

class Food
{
	public $satiety = 50; // 0 - 100
	public $xPos = 0;      // x grid position
	public $yPos = 0;      // y grid position
	public $zPos = 0;      // z grid position
   
	function __construct($name)
	{
	  //$this->name = $name;
	}
}
////////////////////////////
$new_map = new Grid( array('width'=>mt_rand ( 256 , 512 ), 'height'=>mt_rand ( 256 , 512 ), 'depth'=>mt_rand ( 256 , 512 )) );


$number_of_creatures = 5;
$Creatures = array();

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
								  'hunger'=>mt_rand ( 50 , 100 ), // for random hunger level between 50 - 100 on start
								  //'hunger'=>100,                // Hunger is always 100 at birth
								  'direction'=>mt_rand ( 1 , 9 )
								 )
	);

	array_push($Creatures, $new_creature );
}

echo "<br/>";

echo "Testing Creatures.<br/><br/>";
foreach ($Creatures as $Creature) 
{
	/* 
	*/
    // Test Creature Class
	if (is_a($Creature, "Creature")) { echo "I'm a Creature. <br/>"; }
	
	// Properties
	if (property_exists($Creature, "name")) { echo "My name is " . $Creature->name . ". <br/>";}
	if (property_exists($Creature, "gender")) { echo "My gender is " . $Creature->gender . ". <br/>";}
	if (property_exists($Creature, "xPos")) { echo "My xPos is " . $Creature->xPos . ". <br/>";}
	if (property_exists($Creature, "yPos")) { echo "My yPos is " . $Creature->yPos . ". <br/>";}
	if (property_exists($Creature, "zPos")) { echo "My zPos is " . $Creature->zPos . ". <br/>";}
	if (property_exists($Creature, "hunger")) { echo "My hunger level is " . $Creature->hunger . ". <br/>";}
	if (property_exists($Creature, "direction")) { echo "My direction is " . $Creature->direction . ". <br/>";}

	// Methods
	if (method_exists($Creature, "eat")){ echo $Creature->eat(10); }
	if (method_exists($Creature, "move")){ echo $Creature->move(); }
	if (method_exists($Creature, "think")){ echo $Creature->think(); }
	echo "<br/><br/>";
	
}
echo "All creatures tested.<br/><br/>";



?>
    </p>
  </body>
</html>