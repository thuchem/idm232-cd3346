<?php
consoleMsg("fun.php file LOADED!");

//Define global variables for secure data connections, privacy
// and other stuffs
global $APP_CONFIG;

function consoleMsg($msg) {
    echo '<script type="text/javascript">console.log("' . $msg .'");</script>';
}

// Get the value of the search input field and reinserts into the value para
function echoSearchValue($field) {
    if (isset($_POST[$field])) {
        echo $_POST[$field];
    }
}

?>