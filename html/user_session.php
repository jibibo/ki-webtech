<?php

$user_session = null;

if (isset($_COOKIE["session_token"])) {
  include "db_connect.php";

  $session_token = htmlspecialchars($_COOKIE["session_token"]);
  
  $query_result = mysqli_query(
    $conn,
    "SELECT * 
    FROM customers c JOIN customer_session_tokens cst ON c.id=cst.customer 
    WHERE cst.session_token=$session_token 
    LIMIT 1"
  );

  if (mysqli_num_rows($query_result) > 0) {
    $user_session = mysqli_fetch_assoc($query_result);
  }

  include "db_disconnect.php";
}

?>