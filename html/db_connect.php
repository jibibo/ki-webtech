<?php

// print all errors, helps with debugging
error_reporting(E_ALL);

// display errors
ini_set("display_errors", "On");

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
