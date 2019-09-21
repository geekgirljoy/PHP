<?php


/*
  _      _____ _   _ _    ___   __
 | |    |_   _| \ | | |  | \ \ / /
 | |      | | |  \| | |  | |\ V / 
 | |      | | | . ` | |  | | > <  
 | |____ _| |_| |\  | |__| |/ . \ 
 |______|_____|_| \_|\____//_/ \_\                                  
*/
// Install eSpeak - Run this command in a terminal
/*
 sudo apt-get install eSpeak
*/


/*
  __  __          _____ 
 |  \/  |   /\   / ____|
 | \  / |  /  \ | |     
 | |\/| | / /\ \| |     
 | |  | |/ ____ \ |____ 
 |_|  |_/_/    \_\_____|
*/

// Install Homebrew Package Manager & eSpeak - Run these commands in a terminal
/* 

/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

brew install espeak

*/

$voice = "espeak";
$statement = 'Hello World!';
exec("$voice '$statement'");
