<?php
// Start the session
session_start();
//session_regenerate_id(true); 
//echo "session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];



// Load Site config.ini File

$ini_path = "assets/config/config.ini";
if (file_exists($ini_path)) {} // path for top level files / components processed in index
else { $ini_path = "../config/config.ini"; } // path for sub files and processors

$ini_array = parse_ini_file($ini_path); // get the site config.ini file

// Set session variables


if ($_SESSION['authenticated'] == "") { $_SESSION['authenticated'] = false; }
if ($_SESSION["siteurl"] == "") { $_SESSION["siteurl"] = $ini_array['SITEURL']; }
if ($_SESSION["currlang"] == "") { $_SESSION["currlang"] = $ini_array['DEFAULTLANGUAGE']; }
if ($_SESSION["currcomponent"] == "") { $_SESSION["currcomponent"] = $ini_array['DEFAULTCOMPONENT']; }
if ($_SESSION["defaultsigninlandingcomponent"] == "") { $_SESSION["defaultsigninlandingcomponent"] = $ini_array['DEFAULTSIGNEDINCOMPONENT']; }






?>