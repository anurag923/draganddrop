<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");
$appurl = 'http://dragdrop.ground11.in';
 

$contact_email = 'info@ground11.in';

//db details
$dbHost = 'localhost';
$dbUsername = 'groundin_drag';
$dbPassword = 'groundin_drag';
$dbName = 'groundin_drag';

//Connect and select the database
$con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 

?>