<?php

class /*Aw Geez Rick*/Roll{
    public array $dice = [];
    public int $total = 0;
    public float $average = 0.0;
    public int $lowest_roll = 0;
    public int $highest_roll = 0;
	
	public function __construct(){ /* Nothing special here */ }
	
	public function ComputeData(){
		// No dice rolls made
		if (empty($this->dice)){
            return;
        }
		
		$this->total = array_sum($this->dice);
		$this->average = $this->total / count($this->dice);
		$this->lowest_roll = min($this->dice);
		$this->highest_roll = max($this->dice);
	}
}

class /*Slice and */Dice{

	private int $low;
	private int $high;
	private int $number_of_die;
	private ?Roll $last_roll = null;

	public function __construct($low=1, $high=6, $number_of_die = 1){
		$this->low = $low;
		$this->high = $high;
		$this->number_of_die = $number_of_die;
	}
	
	private function validate(): void{
        if ($this->high < $this->low){
            throw new InvalidArgumentException("High must be greater than or equal to low.");
        }
        if ($this->number_of_die < 1){
            throw new InvalidArgumentException("Must roll at least one die.");
        }
    }
	
	function Roll(){
		$this->validate();
		
		$this->last_roll = new Roll();
		
		for($i=0; $i < $this->number_of_die; $i++){
			$this->last_roll->dice[] = random_int($this->low, $this->high);
		}
		
		// Compute data about the roll
		$this->last_roll->ComputeData();
		
		return $this->last_roll;
	}
	
	public function GetLastRoll(): array{
		return $this->last_roll;
	}
	
	public static function FromNotation(string $notation = '1d6'): self{
		
		// Like '1d6'
		preg_match('/^(\d+)d(\d+)([+-]\d+)?$/', $notation, $matches, PREG_OFFSET_CAPTURE);

		if (count($matches) <= 1) {
			// Like 1d(-2..3) or 1d(-10..-8) or 7d(from..too)
			preg_match('/^(\d+)d\((-?\d+)\.\.(-?\d+)\)$/', $notation, $matches, PREG_OFFSET_CAPTURE);
			
			if (count($matches) <= 1) {
				throw new InvalidArgumentException(
					"Invalid Notation String"
				);
			}
			$number_of_die = (int) $matches[1][0];
			$low = (int) $matches[2][0];
			$high = (int) $matches[3][0];
		}
		else{// Like '1d6'
			$number_of_die = (int) $matches[1][0];
			$low = 1;
			$high = (int) $matches[2][0];
		}
		$dice = new self($low, $high, $number_of_die);

		return $dice;
	}
}

// GURPS LIKE (3 dice with values 1 to 6 ) = [1,2,3,4,5,6]
$three_d_six = new Dice(1, 6, 3);
print_r($three_d_six->Roll());

// DND LIKE (1 dice with values 1 to 20 ) = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
$one_d_twenty = new Dice(1, 20);
print_r($one_d_twenty->Roll());


// CUSTOM DICE FROM NOTATION USING STATIC FACTORY:

// 1 die with values 1 to 10 = [1,2,3,4,5,6,7,8,9,10]
$notation_dice_1 = Dice::FromNotation("1d10");
print_r($notation_dice_1->Roll());

// 4 dice with values 1 to 8  = [1,2,3,4,5,6,7,8]
$notation_dice_2 = Dice::FromNotation("4d8");
print_r($notation_dice_2->Roll());

// 1 die with values -10 to 8 = [-10,-9,-8,-7,-6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6,7,8]
$notation_dice_3 = Dice::FromNotation("1d(-10..8)");
print_r($notation_dice_3->Roll());

// 1 dice with values -6 to -3 = [-6,-5,-4,-3]
$notation_dice_4 = Dice::FromNotation("1d(-6..-3)");
print_r($notation_dice_4->Roll());

?>
