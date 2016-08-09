<?php
/* 
    Spider.php 

	Crawl a website and obtain it's header data along with the title and body data.
*/


/*
    Clean($string)
	
    1. Replace white space characters with a single space ' '

    Use Regex preg_replace \s+ to match any white space character [\r\n\t\f ]
    Quantifier: + Between one and unlimited times, as many times as possible, giving back as needed [greedy]

	
    2. Strip whitespace (or other characters) from the beginning and end of a string using trim(). 
    
	trim() will strip these characters:

    " " (ASCII 32 (0x20)), an ordinary space.
    "\t" (ASCII 9 (0x09)), a tab.
    "\n" (ASCII 10 (0x0A)), a new line (line feed).
    "\r" (ASCII 13 (0x0D)), a carriage return.
    "\0" (ASCII 0 (0x00)), the NUL-byte.
    "\x0B" (ASCII 11 (0x0B)), a vertical tab.
   

    3. Replace HTML Special Chars and return.
   
    htmlspecialchars() will convert these characters:
   
    & (ampersand)    &amp;
    " (double quote)    &quot; when ENT_NOQUOTES
    ' (single quote)    &#039; (for ENT_HTML401) or &apos; (for ENT_XML1, ENT_XHTML or ENT_HTML5), but only when ENT_QUOTES is set
    < (less than)    &lt;
    > (greater than)    &gt;
   
    return the results
*/
function Clean($string) {
	$string = preg_replace('/\s+/', ' ', $string);
	$string = trim($string);
	return htmlspecialchars($string);
}

/*
    CrawlPage($url)
	
	returns an associative array with the following keys:
	'head', 'title', 'body'
*/
function CrawlPage($url) {
	$webpage = file_get_contents($url);
	
	if($webpage) {

		/* Extract Head */
		if (preg_match ("/<head\>(.*)<\/head>/siU", $webpage, $match)) {
			$page_data['head'] = Clean($match[1]);
		}
		/* Extract Title */
		if (preg_match ("/<title\>(.*)<\/title>/siU", $webpage, $match)) {
			$page_data['title'] = Clean($match[1]);
		}
		/* Extract Body */
		if (preg_match ("/<body.*\>(.*)<\/body>/siU", $webpage, $match)) {
			$page_data['body'] = Clean($match[1]);
		}
	}else {
		die("Unable to open $url" . PHP_EOL);
	}
	
	return $page_data;
}

/*/////////////////////////////////////////////////////////////////*/
/* Crawl a Page */
$crawl_data = CrawlPage('http://www.joyharvel.com/');
var_dump($crawl_data);

?>
