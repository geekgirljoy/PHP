<?php
/* 
	Spider.php 

	Crawl a website and obtain it's header data along with the title and body data.
*/

/*/////////////////////////////////////////////////////////////////*/
/* Begin Functions                                                 */
/*/////////////////////////////////////////////////////////////////*/


	/*////////////////////////////////////////////////*/
	/* Clean($string)                                 */
	/*////////////////////////////////////////////////*/
	/*    1. Replace white space characters with a single space ' '
	//
	//    Use Regex preg_replace \s+ to match any white space character [\r\n\t\f ]
	//    Quantifier: + Between one and unlimited times, as many times as possible, giving back as needed [greedy]
	//
	//	
	//    2. Strip whitespace (or other characters) from the beginning and end of a string using trim(). 
	//    
	//    trim() will strip these characters:
	//
	//    " " (ASCII 32 (0x20)), an ordinary space.
	//    "\t" (ASCII 9 (0x09)), a tab.
	//    "\n" (ASCII 10 (0x0A)), a new line (line feed).
	//    "\r" (ASCII 13 (0x0D)), a carriage return.
	//    "\0" (ASCII 0 (0x00)), the NUL-byte.
	//    "\x0B" (ASCII 11 (0x0B)), a vertical tab.
	//   
	//
	//    3. Replace HTML Special Chars and return.
	//   
	//    htmlspecialchars() will convert these characters:
	//   
	//    & (ampersand)    &amp;
	//    " (double quote)    &quot; when ENT_NOQUOTES
	//    ' (single quote)    &#039; (for ENT_HTML401) or &apos; (for ENT_XML1, ENT_XHTML or ENT_HTML5), but only when ENT_QUOTES is set
	//    < (less than)    &lt;
	//    > (greater than)    &gt;
	//   
	//    return the results
	*/
	function Clean($data) {
		if(is_string($data)){
			$data = preg_replace('/\s+/', ' ', $data);
			$data = trim($data);
			return htmlspecialchars($data);
		}
		elseif(is_array($data)){
			$array_length = count($data);
			for($i = 0; $i < $array_length; $i++){
				unset($data[$i][3]);
				unset($data[$i][1]);
				unset($data[$i][0]);
				unset($data[$i][0]);

				$data[$i][2] = preg_replace('/\s+/', ' ', $data[$i][2]);
				$data[$i][2] = trim($data[$i][2]);
				$data[$i][2] = htmlspecialchars($data[$i][2]);
			}
			return $data;
		}
	}

	/*////////////////////////////////////////////////*/
	/* CrawlPage($url)                                */
	/*////////////////////////////////////////////////*/
	/*
	//	returns an associative array with the following keys:
	//	'head', 'title', 'body' 'urls'
	*/
	function CrawlPage($url) {
		$webpage = file_get_contents($url);
		
		if($webpage) {
			
			if (preg_match ("/<head\>(.*)<\/head>/siU", $webpage, $match)) { /* Extract Head */
				$page_data['head'] = Clean($match[1]);
			}
			elseif (preg_match ("/<title\>(.*)<\/title>/siU", $webpage, $match)) { /* Extract Title */
				$page_data['title'] = Clean($match[1]);
			}
			elseif (preg_match ("/<body.*\>(.*)<\/body>/siU", $webpage, $match)) {/* Extract Body */
				$page_data['body'] = Clean($match[1]);
			}
			if(preg_match_all("/<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>/siU", $webpage, $matches, PREG_SET_ORDER)) {/* Extract All Hyperlinks */
			  $page_data['urls'] = Clean($matches);
			}
			
		}else {
			LogError("Unable to open $url");
		}
		
		return $page_data;
	}

	/*////////////////////////////////////////////////*/
	/* LogError($err)                                 */
	/*////////////////////////////////////////////////*/
	/*
	// Log an error to the text file log output.
	*/
	function LogError($err) {
		/* write out errors */	
	}

    /*////////////////////////////////////////////////*/
	/* UpdateDatabase($data, $connection)             */
	/*////////////////////////////////////////////////*/
	/*
	// Update a record
	*/
	function UpdateDatabase($data, $connection) {
		/* output results to page */
		//var_dump($data);
		
		
	//	try {
	//		$query = $db->query('SELECT `url` FROM `spider`.`urls`');	/* query all urls from db using pdo*/ 
	//		$num_of_urls = $query->rowCount();							/* $num_of_urls is an integer of now many urls there are */ 
	//		$urls = $query->fetchAll(PDO::FETCH_ASSOC);				 	/* $urls is an array of all known urls */
	//	} catch(PDOException $ex) { /* unable to connect to db */
	//		echo "An Error occured! Unable to Query the Database for URLs.";	/* issue user message */
	//		LogError($ex->getMessage()); 										/* log error */
	//	}

	}
	
/*/////////////////////////////////////////////////////////////////*/
/* End Functions                                                   */
/*/////////////////////////////////////////////////////////////////*/



/*/////////////////////////////////////////////////////////////////*/
/* Begin Spider                                                    */
/*/////////////////////////////////////////////////////////////////*/

	$start = microtime(true); 

	/*////////////////////////////////////////////////*/
	/* Begin Connect to DB                            */
	/*////////////////////////////////////////////////*/
	$db = new PDO('mysql:host=localhost;dbname=spider;charset=utf8mb4', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	/* exception mode */
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);			/* disable prepare emulation */

	try {
		$query = $db->query('SELECT `url` FROM `spider`.`urls`');	/* query all urls from db using pdo*/ 
		$num_of_urls = $query->rowCount();							/* $num_of_urls is an integer of now many urls there are */ 
		$urls = $query->fetchAll(PDO::FETCH_ASSOC);				 	/* $urls is an array of all known urls */
	} catch(PDOException $ex) { /* unable to connect to db */
		echo "An Error occured! Unable to Query the Database for URLs.";	/* issue user message */
		LogError($ex->getMessage()); 										/* log error */
	}
	/*////////////////////////////////////////////////*/
	/* End Connect to DB                              */
	/*////////////////////////////////////////////////*/

	
	/*////////////////////////////////////////////////*/
	/* Begin Crawl                                    */
	/*////////////////////////////////////////////////*/	
		foreach($urls as $url) {
			/* Crawl then Insert data into database */
			UpdateDatabase(CrawlPage($url['url']), $db);
		}
	/*////////////////////////////////////////////////*/
	/* End Crawl                                      */
	/*////////////////////////////////////////////////*/
	
	
	/*////////////////////////////////////////////////*/
	/* Begin Report                                   */
	/*////////////////////////////////////////////////*/
		echo "<b>Total Number of URLs Crawled:</b> $num_of_urls <br>" . PHP_EOL;
				
		$end = (microtime(true) - $start);
		if($end > 60){
			round($end = $end /60, 4);
			$end .= ' Minutes<br>';
		}
		else{
			$end = round($end, 4) . ' Seconds<br>';
		}
		
		echo "<b>Execution Time:</b> " . $end . "<br>" . PHP_EOL;
	/*////////////////////////////////////////////////*/
	/* End Report                                     */
	/*////////////////////////////////////////////////*/
	
	
/*/////////////////////////////////////////////////////////////////*/
/* End Spider                                                      */
/*/////////////////////////////////////////////////////////////////*/
?>