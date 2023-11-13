<?php
consoleMsg("fun.php file LOADED!");

//Define global variables for secure data connections, privacy
// and other stuffs
global $APP_CONFIG;

function consoleMsg($msg) {
    echo '<script type="text/javascript">console.log("' . $msg .'");</script>';
}

?>