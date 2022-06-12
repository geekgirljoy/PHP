<?php 

// Application Special Keywords
$SpecialKeywords = new stdClass();
$SpecialKeywords->Name = "Special Keywords";
$SpecialKeywords->Actions = array('QUIT'=>'Quit'); // SpecialKeywords KEYS ARE ALL CAPS
                                                   // Values are their function name
// Application Main Menu
$MainMenu = new stdClass();
$MainMenu->Name = "Main Menu";
$MainMenu->MenuOptions = array('Quit', 'Open a Text Editor', 'Ping Google', 'Submenu 42', 'Nothing');
$MainMenu->MenuActions = array('Quit', 'OpenTextEditor', ['Ping', '8.8.8.8'], ['ChangeMenu', 'Submenu42'] );

// Submenu 42 
$Submenu42 = new stdClass();
$Submenu42->Name = "Submenu 42";
$Submenu42->MenuOptions = array('Back to Main Menu', 'Nothing', 'Nada', 'Nope', 'Ziltch');
$Submenu42->MenuActions = array(['ChangeMenu', 'MainMenu'],  );
