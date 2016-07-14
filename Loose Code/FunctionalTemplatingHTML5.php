<?php
/*
Author: Joy Harvel
Name: Functional Templating - All HTML 5 Elements
Description:Creates functions for creating HTML elements via function calls
Note: Incomplete and unoptimized
ToDo:
[ ] Add All HTML 5 Elements with required attributes
[ ] Convert params to array of key value pairs and check for required params
[x] Add setting for error reporting (X required param was missing from Y element with the ID of NNNN)
[ ] Add error reporting to all functions
[ ] Add Global Attributes & Event Attributes as params


Example:

<?php
// Area Map Example
$area_arr = array(AREA('area-1', 'CSSClass', '0,0,10,10'), AREA('area-2', 'CSSClass', '0,10,10,20'));
$page = MAP('my-map', 'my-map', 'CSSClass' 0, $area_arr);
$page .= '<img src="image.png" usemap="#my-map">';

echo $page;

?>


 
*/




define('INDENT', '    '); // 4 spaces
define('RPTERR', false); // true/false - Error Report Toggle
 
/*
<a></a>

A('home-btn', 'btn btn-primary', 'Visit My Site', 0, 'JoyHarvel.com');

*/ 
function A($id, $class, $html, $indent = 0, $href = '#', $hreflang = 'en', $target='_self', $download = false){
	$output = str_repeat(INDENT, $indent);
    $output .= "<a id='$id' class='$class' href='$href' hreflang='$hreflang' target='$target'";
	if($download == true){ $output .= ' download';}
	$output .= ">$html</a>" . PHP_EOL;
	return $output;
}


/*
<abbr></abbr>

ABBR('elem-1234', 'CSSClass', 'ASAP', 'As Soon As Possible');

*/ 
function ABBR($id, $class, $html, $title, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<abbr id='$id' class='$class' title='$title'>$html</abbr>" . PHP_EOL;
	return $output;
}


/*
<area></area>

$area_arr = array(AREA('area-1', 'CSSClass', '0,0,10,10'), AREA('area-2', 'CSSClass', '0,10,10,20'));
echo MAP('my-map', 'my-map', 'CSSClass' 0, $area_arr);
echo '<img src="image.png" usemap="#my-map">';

*/ 
function AREA($id, $class, $coords, $shape = 'rect', $href = '#', $alt = "Link", $target = '_self'){
	$output = "<area id='$id' class='$class' shape='$shape' coords='$coords' href='$href' alt='$alt' target='$target'>" . PHP_EOL;
	return $output;
}


/*
<article></article>

ARTICLE( 'ID', 'CSSClass', 'ASAP', 'As Soon As Possible');

*/ 
function ARTICLE($id, $class, $html, $title, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<article id='$id' class='$class' title='$title'>$html</article>" . PHP_EOL;
	return $output;
}


/*
<aside></aside>

ASIDE('ID', 'CSSClass', 'Aside from the content around this');

*/ 
function ASIDE($id, $class, $html, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<aside id='$id' class='$class'>$html</aside>" . PHP_EOL;
	return $output;
}



/*
<audio></audio>

AUDIO('ID', 'CSSClass', array());

*/ 
function AUDIO($id, $class, $sources, $indent = 0, $controls = true){
	$output = str_repeat(INDENT, $indent);
    $output .= "<audio id='$id' class='$class'";
	if($controls == true){ $output .= ' controls';}
	$output .= ">" . PHP_EOL;
	foreach($sources as $source){
		$output .= str_repeat(INDENT, $indent + 1) . $source . PHP_EOL;
	}
	$output .= "Your browser does not support the audio tag.</audio>" . PHP_EOL;
	
	return $output;
}

/*
<b></b>

*/
function B($id, $class, $html, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<b id='$id' class='$class'>$html</b>" . PHP_EOL;
	return $output;
}


/*
<base>

BASE('home-btn', 0, 'JoyHarvel.com');

*/ 
function BASE($id, $indent = 0, $href = '#', $target = '_self'){
	$output = str_repeat(INDENT, $indent);
    $output .= "<base id='$id' href='$href' target='$target'>" . PHP_EOL;

	return $output;
}


/*
<bdi><bdi>

*/
function BDI($id, $class, $html, $indent = 0){
	$output = str_repeat(INDENT, $indent);
    $output .= "<bdi id='$id' class='$class'>$html</bdi>" . PHP_EOL;

	return $output;
}


/*
<bdo></bdo>
*/
function BDO($id, $class, $html, $indent = 0, $dir = 'rtl'){
	$output = str_repeat(INDENT, $indent);
    $output .= "<bdo id='$id' class='$class' dir='$dir'>$html</bdo>" . PHP_EOL;

	return $output;
}

/*
<blockquote></blockquote>
*/
function BLOCKQUOTE($id, $class, $html, $cite = '', $indent = 0 ){
	$output = str_repeat(INDENT, $indent);
    $output .= "<blockquote id='$id' class='$class' cite='$dir'>$html</blockquote>" . PHP_EOL;

	return $output;
}





/*
<body></body>
*/
function BODY($html){
	return "<body>" . PHP_EOL . $html .  PHP_EOL . '</body>';
}

/*
<br>
*/
function BR($indent = 0 ){
	$output = str_repeat(INDENT, $indent);
    $output .= "<br>" . PHP_EOL;

	return $output;
}



/*
<button>
<canvas>
<caption>
<center>
<cite>
<code>
<col>
<colgroup>
*/
/*
COMMENT 

COMMENT('Your comment here');

*/ 
function COMMENT($comment = '...'){
	return "<!--$comment-->" . PHP_EOL;
}
/*
<datalist>
<dd>
<del>
<details>
<dfn>
<dialog>
<dir>
<div>
<dl>
<dt>
*/
/*
DOCTYPE 

DOCTYPE();

*/ 
function DOCTYPE($type = 'html'){
	return "<DOCTYPE $type>" . PHP_EOL;
}
/*
<em>
<embed>
<fieldset>
<figcaption>
<figure>
<font>
<footer>
<form>
<frame>
<frameset>
<h1> - <h6>
<head>
<header>
<hr>
*/
/*
HTML

HTML('HTML Markup');

*/ 
function HTML($html, $lang = 'en-US'){
	return "<html lang='$lang'>" . PHP_EOL . $html .  PHP_EOL . '</html>';
}


/*
<i></i>
*/
function I($id, $class, $html, $indent = 0){
	$output = str_repeat(INDENT, $indent);
    $output .= "<i id='$id' class='$class'>$html</i>" . PHP_EOL;

	return $output;
}




/*

<iframe>
<img>
<input>
<ins>
<kbd>
<keygen>
<label>
<legend>
<li>
<link>
<main>
*/ 

/*
Area / Image Map

$area_arr = array(AREA('area-1', 'CSSClass', '0,0,10,10'), AREA('area-2', 'CSSClass', '0,10,10,20'));
echo MAP('my-map', 'my-map', 'CSSClass' 0, $area_arr);
echo '<img src="image.png" usemap="#my-map">';
*/ 
function MAP($name, $id, $class, $indent = 0, $areas = array()){
	$output = str_repeat(INDENT, $indent);
	$output .= "<map name='$name' id='$id' class='$class'>" . PHP_EOL;
	
	foreach($areas as $area){
		$output .= str_repeat(INDENT, $indent + 1) . $area;
	}
	$output .= str_repeat(INDENT, $indent) . "</map>" . PHP_EOL;
	
	return $output;
}

/*
<mark>
<menu>
<menuitem>
<meta>
<meter>
<nav>
<noframes>
<noscript>
<object>
<ol>
<optgroup>
<option>
<output>
<p>
<param>
<pre>
<progress>
<q>
<rp>
<rt>
<ruby>
<s>
<samp>
<script>
<section>
<select>
<small>
<source>
<span>
<strike>
<strong>
<style>
<sub>
<summary>
<sup>
<table>
<tbody>
<td>
<textarea>
<tfoot>
<th>
<thead>
<time>
<title>
<tr>
<track>
<tt>
<u>
<ul>
<var>
<video>
<wbr>
*/


?>