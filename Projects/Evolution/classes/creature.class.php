<?php
/* Creature Class */
class Creature {
	public $name;      /* The name of this specific creature. */
	public $gender;    /* The biological sex of this specific creature. 
	                   // 0 asexual
					   // 1 female
					   // 2 male
					   */
	public $spawnMethod;/* The biological sex of this specific creature. 
	                   // 0 True Spawn 'mitosis'
					   // 1 Sex - egg
					   // 2 Sex - gestation
					   // 3 UNUSED MULTISTAGED (Think Aliens Xenomorph)
					   */
					   
	public $vision;    /* in terms of blocks 'grid positions' 0 means can't see and a positive intiger means that it can see for n # of steps from onself */
	public $xPos;      /* X grid position */
	public $yPos;      /* Y grid position */
	public $zPos;      /* Z grid position */
	public $hunger;    /* 0 - 100 */
	public $zDirection;   /* z direction. */ /* 0 = don't move, 1 = up, -1 = down */
	public $xYDirection;  /* x & y direction. */   /* 
   // 123
   // 456 ( 5 = don't move / no motion for direction / stand still
   // 789
   */
   
	/* What happens when a new creature is made: */
	function __construct($param) {
		if(isset($param['name'])){ $this->name = $param['name']; }
		if(isset($param['gender'])){ $this->gender = $param['gender']; }
		if(isset($param['spawnMethod'])){ $this->spawnMethod = $param['spawnMethod']; }
		if(isset($param['vision'])){ $this->vision = $param['vision']; }
		if(isset($param['xPos'])){ $this->xPos = $param['xPos']; }
		if(isset($param['yPos'])){ $this->yPos = $param['yPos']; }
		if(isset($param['zPos'])){ $this->zPos = $param['zPos']; }
		if(isset($param['hunger'])){ $this->hunger = $param['hunger']; }
		if(isset($param['xYDirection'])){ $this->xYDirection = $param['xYDirection']; }
		if(isset($param['zDirection'])){ $this->zDirection = $param['zDirection']; }
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
	    // 456 ( 5 = don't move / no motion for direction / stand still
		// 789
		// XY
		if(isset($this->xYDirection)){
			if($this->xYDirection == 1){$this->xPos--; $this->yPos--;}
			if($this->xYDirection == 2){$this->yPos--;}
			if($this->xYDirection == 3){$this->xPos++; $this->yPos--;}
			if($this->xYDirection == 4){$this->xPos--;}
			if($this->xYDirection == 5){} // stand still - No Movment
			if($this->xYDirection == 6){$this->xPos++;}
			if($this->xYDirection == 7){$this->xPos--; $this->yPos++;}
			if($this->xYDirection == 8){$this->yPos++;}
			if($this->xYDirection == 9){$this->xPos++; $this->yPos++;}
		}
	    
		// Z
		if(isset($this->zDirection)){
			if($this->zDirection == -1){$this->zPos--;}
			if($this->zDirection == 0){} /* 0 = don't move, 1 = up, -1 = down */
			if($this->zDirection == 1){$this->zPos++;}
        }
		
		return  $output .  $this->xPos . ", " . $this->yPos . ", " . $this->zPos . ". "; /* Report Activity */
	}
	
	
	function spawn() { /* reproduce*/
	   
	    // 0 True Spawn 'mitosis'
		if ($this->spawnMethod == 0){
			// create new of this critter + noevolve || evolve
		}
		elseif ($this->spawnMethod == 1){// 1 egg gestation
		    // if $this->gender == 0 //asexual
			    // lay fertilized eggs
			// if $this->gender == 1 //female
			    // lay unfertilized eggs
			// if $this->gender == 2 //male
			    // lay fertilize eggs present in n radius
		
		    //(TODO: ADD EGG CLASS)
		}
		elseif ($this->spawnMethod == 2){// 2 sex gestation
		    // if $this->gender == 0 //asexual
			    // become pregnant by self
			// if $this->gender == 1 //female
			    // become pregnant by male x
			// if $this->gender == 2 //male
			    // impregnant female y
				
			//(TODO: ADD VIRTUAL WOMB)
		}
		elseif ($this->spawnMethod == 3){// 3 UNUSED MULTISTAGED (Think Aliens Xenomorph)
			// Lay n# of face hugger eggs which spawn a 'facehugger' that finds a suitable host then parasitically gestates and spawns a new creature + noevolve || evolve
		}
		 
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