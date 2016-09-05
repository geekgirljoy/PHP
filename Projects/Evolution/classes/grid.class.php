<?php
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