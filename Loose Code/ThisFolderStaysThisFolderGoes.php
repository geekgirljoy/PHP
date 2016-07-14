<?php
// This Folder Stays This Folder Goes
define('BR', '<br>' . PHP_EOL);

if (!is_dir('This Folder Stays')) {
    echo mkdir('This Folder Stays') ? "Folder 'This Folder Stays' was created." . BR : "Unable to create 'This Folder Stays'" . PHP_EOL;
}else{ echo "Folder 'This Folder Stays' already exists." . BR;}
if (!is_dir('This Folder Goes')) {
	 echo mkdir('This Folder Goes') ? "Folder 'This Folder Goes' was created." . BR : "Unable to create folder 'This Folder Goes'" . PHP_EOL;
}else{ echo "Folder 'This Folder Goes' already exists." . BR;}


echo rmdir('This Folder Goes') ? "Folder 'This Folder Goes' was deleted." : "Unable to delete folder 'This Folder Goes'." . BR;
?>