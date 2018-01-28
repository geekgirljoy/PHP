<?php
// !IMPORTANT! Manually Pull/Create your repo before using this script

// This script assumes that you keep your repos in your 
// user folder in a folder called repos.

// Adjust the $local_path variable to meet your needs 
$repo_name = 'test';
$local_path = '$HOME'."/repos/$repo_name/"; // linux & mac path example
// $local_path = "%userprofile%\repos\$repo_name"; // win path example
////////////////////////////////////////////////////////////////////////////////////
/// Put anything you want to occur before the push here.
////////////////////////////////////////////////////////////////////////////////////

// comment this line after the script has run once
// it updates the config file for the repo to tell git to store the
// credentials after you enter them once
shell_exec("cd $local_path;git config credential.helper store");

// Pull Repo
shell_exec("cd $local_path;git pull");

// THE FIRST TIME THIS SCRIPT RUNS YOU WILL BE PROMPTED
// TO MANUALLY ENTER CREDENTIALS HERE.

// Add all new files
shell_exec("cd $local_path;git add *");

// Push new data
shell_exec("cd $local_path;git push origin master");

///////////////////////////////////////////////////////////////////////////////////
/// Put anything you want to occur after the push here.
///////////////////////////////////////////////////////////////////////////////////
?>
