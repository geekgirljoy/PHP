<?php
/*
Author: Joy Harvel
Name: Dynamic Functional Templating 
Description:A function for creating HTML elements
Note: Incomplete and unoptimized

*/

define('INDENT', '    '); // 4 spaces

function CreateHTMLElement($params)
{
	$output = "";
	if (isset($params['element']))
	{
		if(isset($params['indent'])){ $output .= str_repeat(INDENT, $params['indent']); }
		$output .= "<" . $params['element'];
		if(isset($params['id'])){$output .= " id='" . $params['id'] . "'";}
        //
		$output .= ">";
		if(isset($params['content'])){ $output .= $params['content']; }
		$output .= "</" . $params['element'] . ">" . PHP_EOL;
	}
	else {$output = "No Element Specifide USE: 'element'=>'p'";} 
	return $output;
}

echo CreateHTMLElement(array(
	'element'=>'p',
	'id'=>'my-paragraph',
	'indent'=>1,
	'content'=>'This is a paragraph.'
	));


?>