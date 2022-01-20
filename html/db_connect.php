<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

# include "db_credentials.php";

$db_server = "localhost";
$db_name = "uvazon";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

if (!$conn) {
  die("DB connection failed: " . mysqli_connect_error());
}
