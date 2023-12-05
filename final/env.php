<?php
    consoleMsg("env.php file LOADED!");

    $domain = $_SERVER['HTTP_HOST'];
    consoleMsg('Domain is: $domain');
    
    if($domain == 'localhost:8888') {
    //specific to your current environment (the local MAMP server)\
        $APP_CONFIG = [
            // path to environment (since you're using MAMP, turn on MAMP, go to the website)
            // and scroll down to MYSQL and copy the host
            'environment' => 'local',
            'database_host' => 'localhost',
            'database_user' => 'root',
            'database_pass' => 'root',
            'database_name' => 'idm232' // put in the name of your database
        ];
    } else {
        // Specify online environment
        $APP_CONFIG = [
            'environment' => 'live',
            'site_url' => 'https://thuchem.com/',
            'database_host' => 'mysql.thuchem.com',
            'database_user' => 'cd3346',
            'database_pass' => 'Luffy_05_05',
            'database_name' => 'thuchem_idm232' // put in the name of your database
        ];
    }
?>