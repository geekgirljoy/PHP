<?php
// echo 300 new lines
function ClearScreen(){
    echo str_repeat(PHP_EOL, 300);
}

// Display a menu object and it's options
function DisplayMenu($menu_object){
    ClearScreen();
    
    echo '[' . $menu_object->Name . ']' . PHP_EOL;
    
    foreach($menu_object->MenuOptions as $key => $value) {
      echo "$key: $value" . PHP_EOL;
    }
}

// Get user input/feedback
function GetCommmand($text = ''){
    $cmd = readline($text);
    readline_add_history($cmd); // add command to history
    return $cmd;
};

// Quit the application
function Quit(){
    ClearScreen();
    $GLOBALS['Application']->RunState = 0;
    echo "Buh Bye!!!" . PHP_EOL;
}

// Cross-platform open a text editor example 
function OpenTextEditor(){
    
    $OS = strtoupper(substr(PHP_OS, 0, 3));
    
    if($OS == 'WIN'){ // Windows
        pclose(popen("start /B notepad", "r")); // open notepad
    }
    elseif($OS == 'DAR'){ // Mac
        pclose(popen("TextEdit", "r")); // open TextEdit
    }
    elseif($OS == 'LIN'){ // Linux
        pclose(popen("nano", "r")); // open nano
    }
    elseif($OS == 'BSD'){
        echo "Not Implemented." . PHP_EOL;
    }
    elseif($OS == 'SOL'){ // Solaris
       echo "Not Implemented." . PHP_EOL;
    }
    elseif($OS == 'UNK'){ // Unknown
        echo "Not Implemented." . PHP_EOL;
    }
    else{
        echo "Not Implemented." . PHP_EOL;
    }
}

// Ping an address example
function Ping($address){
    system("ping $address");
}

// Change the application current menu to a new menu object
function ChangeMenu($new_menu){
    ClearScreen();
    $GLOBALS['Application']->CurrentMenu = $GLOBALS[$new_menu];
}
