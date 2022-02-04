<?php

// print all errors, helps with debugging
error_reporting(E_ALL);

// display errors
ini_set("display_errors", "On");

// this file (only on the server, uses .gitignore) contains login info for the mysql server (very dangerous)
// the variables $db_username and $db_password are defined in here
include "db_credentials.php";

// db server address & db name
$db_server = "localhost";
$db_name = "uvazon";

// connect to db
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name, 3307);

if (!$conn) {
  // abort
  die("DB connection failed: " . mysqli_connect_error());
}
