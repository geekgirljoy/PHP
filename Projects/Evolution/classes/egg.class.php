<?php
/*////////////////////////*/
/* egg */
class Egg {
    public $parents = array();
	public $xPos;      /* x grid position */
	public $yPos;      /* y grid position */
	public $zPos;      /* z grid position */
	
	/* What happens when a new egg is made: */
	function __construct($param)	{
		if(isset($param['mother'])){ $this->parents['mother'] = $param['mother']; }
		if(isset($param['father'])){ $this->parents['father'] = $param['father']; }
		if(isset($param['xPos'])){ $this->xPos = $param['xPos']; }
		if(isset($param['yPos'])){ $this->yPos = $param['yPos']; }
		if(isset($param['zPos'])){ $this->zPos = $param['zPos']; }
		echo "New egg layed! Location: (X:" . $this->xPos . ")(Y:" . $this->yPos . ")(Z:" . $this->zPos . ")<br/>"; /* Report Activity */
	}
}