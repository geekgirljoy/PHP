<?php
<?php
// Instructions:
// Update the $url_array with the pages you want to crawl then run from command line.

// References:
// mkdir() - http://php.net/manual/en/function.mkdir.php
// count() - http://php.net/manual/en/function.count.php
// file_get_contents() - http://php.net/manual/en/function.file-get-contents.php
// fopen() - http://php.net/manual/en/function.fopen.php
// fwrite() - http://php.net/manual/en/function.fwrite.php
// fclose() - http://php.net/manual/en/function.fclose.php
// basename() - http://php.net/manual/en/function.basename.php
// mt_rand() - http://php.net/manual/en/function.mt-rand.php
// sleep() - http://php.net/manual/en/function.sleep.php


// List of URLs to Crawl
$url_array = array('http://www.sitename.com/page1.html',
                     'http://www.sitename.com/page2.html',
                     'http://www.sitename.com/page3.html'
                     // add more links here as needed
                     );


@mkdir('crawled/', 0777, true); // quietly make a subfolder called 'crawled'


// Loop Through $url_array
foreach($url_array  as $key=>$page){

    // Do Crawl	
	echo  'Crawling (' . $key . ' of ' . count($url_array) . ')' . $page . PHP_EOL;
    $data = file_get_contents($page);
 
    // Save a clone of the crawled page in the crawled subfolder 
    $file = fopen('crawled/' . basename($page), 'w');
    fwrite($file, $data);
    fclose($file);        
    
    // Wait	- DO NOT REMOVE
    // This keeps your spider from looking like a bot
    // It makes it look like you are spending a few minutes reading each
    // page like a person would. It keeps the spider from using excessive
    // resources which will get you blacklisted.
	$sleep = mt_rand(150, 300); // Between 2.5 & 5 Minutes
	echo 'Sleeping for ' . $sleep . PHP_EOL;
	while($sleep > 0){
		sleep(1);
		$sleep-=1; // take one second away
		echo $sleep . ' seconds until next crawl.' . PHP_EOL;
	}
}

echo 'Program Complete'  . PHP_EOL;
