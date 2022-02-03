<?php

// script to get the user's info if they are logged in (checks token cookie)

$user_session = null;

if (isset($_COOKIE["session_token"])) {

  include "db_connect.php";

  $session_token = htmlspecialchars($_COOKIE["session_token"]);

  // get user info from db
  $query_result = mysqli_query(
    $conn,
    "SELECT * 
    FROM customers c JOIN customer_session_tokens cst ON c.id=cst.customer 
    WHERE cst.session_token='$session_token' 
    LIMIT 1"
  );

  if ($query_result) {
    // if user is set, set info, otherwise it remains null
    $user_session = mysqli_fetch_assoc($query_result);
  }

  include "db_disconnect.php";
}
