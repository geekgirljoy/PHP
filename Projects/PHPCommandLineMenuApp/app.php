<?php

include "functions.php";
include "menus.php";

 
// The Application
$Application = new stdClass();
$Application->RunState = 1;
$Application->CurrentMenu = $MainMenu;
$Application->SpecialKeywords = $SpecialKeywords;


while($Application->RunState != 0){
    DisplayMenu($Application->CurrentMenu); // show current menu
    $Application->command = GetCommmand("Selection: "); // get user input
    
    // Perform any Application wide special keyword checks here
    if(!empty( $Application->SpecialKeywords->Actions[strtoupper($Application->command)])){
        
        // if the action is a string function name
        if(is_string($Application->SpecialKeywords->Actions[strtoupper($Application->command)])){
            call_user_func($Application->SpecialKeywords->Actions[strtoupper($Application->command)]);
        }
        
        // if the action is an array [function name, data]
        if(is_array($Application->SpecialKeywords->Actions[strtoupper($Application->command)])){
            call_user_func($Application->SpecialKeywords->Actions[strtoupper($Application->command)][0] , $Application->SpecialKeywords->Actions[strtoupper($Application->command)][1]);
        }
    }
    
    // Perform Regular Menu Actions
    if(!empty($Application->CurrentMenu->MenuActions[$Application->command])){ // if the menu option has a corasponding menu action
        
        // if the action is a string function name
        if(is_string($Application->CurrentMenu->MenuActions[$Application->command])){
            call_user_func($Application->CurrentMenu->MenuActions[$Application->command]);
        }
        
        // if the action is an array [function name, data]
        if(is_array($Application->CurrentMenu->MenuActions[$Application->command])){
            call_user_func($Application->CurrentMenu->MenuActions[$Application->command][0] , $Application->CurrentMenu->MenuActions[$Application->command][1]);
        }
    }
}
