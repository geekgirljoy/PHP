<?php
session_start();

    $username = $_POST['username'];
    $secret = $_POST['password'];
    
    //$secret = password_hash($userpass, PASSWORD_BCRYPT);
    //Store $secret in database
    //echo $secret;
        
            
    $host = "127.0.0.1";
    $user ="geekgirljoy";
    $pass = "";
    $db = "fikits";
    $port = 3306;
   
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    //And now to perform a simple query to make sure it's working
    $query = "SELECT * FROM Users WHERE email='".$username."' OR display_name='".$username."'";

    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $DBPass = $row['password'];
    }

if (password_verify($secret, $DBPass))
{ 
  $_SESSION['failedlogin'] = false;
  $_SESSION['authenticated'] = true;
  header('Location: ' . $_SESSION['siteurl'] . 'assets/api/PageManager.php?SelectedComponent=' . $_SESSION['defaultsigninlandingcomponent']);
}
else
{
  $_SESSION['failedlogin'] = true;
  $_SESSION['authenticated'] = false;
  header('Location: ' . $_SESSION['siteurl'] . 'assets/api/PageManager.php?SelectedComponent=SignInComponent');
}

            
?>