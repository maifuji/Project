<?php

$db_username 		= 'root'; //database username
$db_password 		= ''; //database password
$db_name 			= 'test'; //database name
$db_host 			= 'localhost'; //hostname or IP
$item_per_page 		= 5; //item to display per page

$connecDB= mysqli_connect($db_host, $db_username,$db_password,$db_name)or die('could not connect to database');
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


?>