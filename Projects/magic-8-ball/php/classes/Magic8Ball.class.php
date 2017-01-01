<?php
/*
*    Magic8Ball.class.php
 *
*    Joy Harvel
 *
*    09/18/2016
 *
*/
class Magic8Ball{
	public $answer;
    function __construct($total) {
        $this->answer = mt_rand( 0 , $total);
    }
}
?>
