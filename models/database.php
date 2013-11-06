<?php
    //declare constants
    define("ABSOLUTE_PATH",'http://'.$_SERVER['SERVER_NAME'].'/roza/');
    define("SLOGAN", "Connecting people in better way!");
    define("FOOTER_NOTE", "Mydomain.com.");

    //database connection details
    if (!isset($_SESSION)) {
        session_start();
    }
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "database";

    mysql_connect($host, $user, $pass) or die("Cannot Connect to DB : <P>" . mysql_error());
    mysql_select_db($db) or die("Cannot Select DB : <P>" . mysql_error());
?>