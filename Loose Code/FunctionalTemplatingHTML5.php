<?php
//
// Functional Templating - All HTML 5 Elements
// Incomplete and unoptimized
//

define('INDENT', '    '); // 4 spaces
 
/*
Hyperlink

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
Abbreviation 

ABBR('elem-1234', 'CSSClass', 'ASAP', 'As Soon As Possible');

*/ 
function ABBR($id, $class, $html, $title, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<abbr id='$id' class='$class' title='$title'>$html</abbr>" . PHP_EOL;
	return $output;
}


/*
Area / Image Map

$area_arr = array(AREA('area-1', 'CSSClass', '0,0,10,10'), AREA('area-2', 'CSSClass', '0,10,10,20'));
echo MAP('my-map', 'my-map', 'CSSClass' 0, $area_arr);
echo '<img src="image.png" usemap="#my-map">';

*/ 
function AREA($id, $class, $coords, $shape = 'rect', $href = '#', $alt = "Link", $target = '_self'){
	$output = "<area id='$id' class='$class' shape='$shape' coords='$coords' href='$href' alt='$alt' target='$target'>" . PHP_EOL;
	return $output;
}
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
Article 

ARTICLE( 'ID', 'CSSClass', 'ASAP', 'As Soon As Possible');

*/ 
function ARTICLE($id, $class, $html, $title, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<abbr id='$id' class='$class' title='$title'>$html</abbr>" . PHP_EOL;
	return $output;
}


/*
Aside 

ASIDE('ID', 'CSSClass', 'Aside from the content around this');

*/ 
function ASIDE($id, $class, $html, $indent = 0){
	$output = str_repeat(INDENT, $indent);
	$output .= "<aside id='$id' class='$class'>$html</aside>" . PHP_EOL;
	return $output;
}

/*
<audio>
<b>
<base>
<basefont>
<bdi>
<bdo>
<big>
<blockquote>
<body>
<br>
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
<i>
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
<map>
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