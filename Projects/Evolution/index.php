<?php

set_time_limit(86400); /* Do not allow this script to run longer than 24 hours. */

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');
?>

<html>
  <head>
    <title>Evolution</title>
  </head>
  <body>
    <p>
	
<?php


/* Create map */
$new_map = new Grid( array('width'=>256, 'height'=>256, 'depth'=>256) );


$number_of_creatures = 5;
$number_of_epochs = 500000;
$Creatures = array();
$AsexualCreatures = array();
$FemaleCreatures = array();
$MaleCreatures = array();

/* Create all the creatures */
for($i=0;$i< $number_of_creatures; $i++)
{
	$gender = mt_rand ( 0 , 2 );
	
	$spawnMethod = mt_rand ( 0 , 2 );
	$vision = mt_rand ( mt_rand ( 0 , 4 ) , mt_rand ( 5 , 10 ) );
	$new_creature = new Creature( 
							array(
								  'name'=>substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6),
								  'gender'=>$gender,
								  'spawnMethod'=>$spawnMethod,
								  'vision'=>$vision,
								  'xPos'=>mt_rand ( 0 , $new_map->width ),
								  'yPos'=>mt_rand ( 0 , $new_map->height ),
								  'zPos'=>mt_rand ( 0 , $new_map->depth ),
								  'xYDirection'=>mt_rand ( 1 , 9 ),
								  'zDirection'=>mt_rand ( -1 , 1 ),
								  'hunger'=>mt_rand ( 50 , 100 ), /* Random hunger level between 50 - 100 on start */
								  /* 'hunger'=>100 ,  */          /* Hunger is always 100 at birth */
								  
								 )
	);

	array_push($Creatures, $new_creature );
	if ($gender == 0) {array_push($AsexualCreatures, $new_creature);}
	if ($gender == 1) {array_push($FemaleCreatures, $new_creature);}
	if ($gender == 2) {array_push($MaleCreatures, $new_creature);}
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
		if (property_exists($Creature, 'gender')) { 
		echo 'My gender is ';
			if($Creature->gender == 0){echo "asexual";}
			elseif($Creature->gender == 1){echo "female";}
			elseif($Creature->gender == 2){echo "male";}
			echo '<br/>';
		}
		if (property_exists($Creature, 'spawnMethod')) { 
		echo 'My spawnMethod is ';
			if($Creature->gender == 0){echo "True Spawn 'mitosis'";}
			elseif($Creature->gender == 1){echo "Sex - Egg";}
			elseif($Creature->gender == 2){echo "Sex - Gestation";}
			echo '<br/>';
		}		
		if (property_exists($Creature, 'vision')) { echo 'My vision is ' . $Creature->vision . '. <br/>';}
		if (property_exists($Creature, 'xPos')) { echo 'My xPos is ' . $Creature->xPos . '. <br/>';}
		if (property_exists($Creature, 'yPos')) { echo 'My yPos is ' . $Creature->yPos . '. <br/>';}
		if (property_exists($Creature, 'zPos')) { echo 'My zPos is ' . $Creature->zPos . '. <br/>';}
		if (property_exists($Creature, 'hunger')) { echo 'My hunger level is ' . $Creature->hunger . '. <br/>';}
		if (property_exists($Creature, 'xYDirection')) {   
	        echo 'My XY direction is ' . $Creature->xYDirection . ' (';

		   // 123
		   // 456 ( 5 = don't move / stand still
		   // 789
			switch( $Creature->xYDirection ){
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
            echo "<br/>";			
	    }
        
		if (property_exists($Creature, 'zDirection')) {   
	        echo 'My Z direction is ' . $Creature->zDirection . ' (';
            /* 0 = don't move, 1 = up, -1 = down */
			switch( $Creature->zDirection ){
				case 0:
					 echo "&#9746;";
					break;
				case 1:
					 echo "&#8593;";
					break;
				default:
					 echo "&#8595;";
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

$number_of_eggs = 3;
$Eggs = array();
$number_of_females = count($FemaleCreatures) - 1;
$number_of_males = count($MaleCreatures) - 1;

if ($number_of_females > 0 && $number_of_males > 0){
	for($i=0;$i< $number_of_eggs; $i++)
	{
		$Mother = $FemaleCreatures[mt_rand ( 1 , $number_of_females)];
		$Father = $MaleCreatures[mt_rand ( 1 , $number_of_males)];
		$new_egg = new Egg( 
			array(
				  'mother'=>$Mother,
				  'father'=>$Father,
				  'xPos'=>$Mother->xPos,
				  'yPos'=>$Mother->yPos,
				  'zPos'=>$Mother->zPos,
				 )
		);

		array_push($Eggs, $new_egg);
	}
}
else{
	echo "There are no males or female creatures to lay eggs.<br/><br/>";
}





/* Place all the creatures on map here*/

/* Run through $number_of_epochs and chart each creature / species progress here */



?>
    </p>
  </body>
</html>