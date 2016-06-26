<?php

class StrawNeckedIbis
{
// Static property with visibility
public static $numberOfBirds = 0;
// Method with visibility
public function __construct()
{
static::$numberOfBirds++;
}
}
?>