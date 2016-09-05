<?php

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