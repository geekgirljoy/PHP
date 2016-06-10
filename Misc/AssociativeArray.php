<html>
  <head>
    <title>Associative Array</title>
  </head>
  <body>
    <p>
      <?php
      $myArray = array(
                       array('fule', 300201),
                       array('oxygen', 10034),
                       array('name', 'Asteroid Miner 99')
                      );
    echo 'Echoing My Associative Array<br/>';    
    for($i = 0; $i < sizeof($myArray); $i++)
     {
        foreach($myArray[$i] as $key=>$value){ echo ' ' . $value  ; }
        echo '<br/>';
     }
     
      ?>
    </p>
  </body>
</html>