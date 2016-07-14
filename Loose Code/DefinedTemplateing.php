<?php

define('HTML', '<html>' . PHP_EOL);
define('html', '</html>' . PHP_EOL);
define('HEAD', '<head>' . PHP_EOL);
define('head', '</head>' . PHP_EOL);
define('TITLE', '<title>');
define('title', '</title>' . PHP_EOL);
define('BODY', '<body>' . PHP_EOL);
define('body', '</body>' . PHP_EOL);
define('H1', '<h1>');
define('h1', '</h1>' . PHP_EOL);
define('DIV', '<div>' . PHP_EOL);
define('div', '</div>' . PHP_EOL);
define('P', '<p>');
define('p', '</p>' . PHP_EOL);

$page_title = "Defined Templateing";
$page_header = "Defined Templateing";
$page_paragraph = "This page implements a defined templateing model.";


$element_arr = [HTML , HEAD , TITLE, $page_title, title, head , BODY , DIV, H1, $page_header, h1, P, $page_paragraph, p, div, body , html];

foreach($element_arr as $element){
	echo $element;
}

?>