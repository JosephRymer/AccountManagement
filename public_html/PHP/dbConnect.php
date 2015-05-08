<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED); 

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "management";
    //Create connection 

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }
    
   // echo "Connected Successfully  - $dbhost";
?>