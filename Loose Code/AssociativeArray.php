<html>
  <head>
    <title>Associative Array</title>
  </head>
  <body>
    <p>
      <?php
      $my_array = array(
	  	       array('Name', 'Asteroid Miner 99'),
                       array('Fule', 300201),
                       array('Oxygen', 10034)                       
                      );
    echo '<h3>Echoing my associative array:</h3>' . PHP_EOL;
	
    for($i = 0; $i < sizeof($my_array); $i++){
        foreach($my_array[$i] as $key=>$value){
	    echo $value; 
	}
        echo '<br/>' . PHP_EOL;
    }
	
	//print_r($my_array);
	//var_dump($my_array);
     
      ?>
    </p>
  </body>
</html>
