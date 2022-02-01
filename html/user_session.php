<?php

include "utils.php";
$user_session = null;

if (isset($_COOKIE["session_token"])) {

  include "db_connect.php";

  $session_token = htmlspecialchars($_COOKIE["session_token"]);
  pre_print("sestok $session_token<br>");

  $query_result = mysqli_query(
    $conn,
    "SELECT * 
    FROM customers c JOIN customer_session_tokens cst ON c.id=cst.customer 
    WHERE cst.session_token='$session_token' 
    LIMIT 1"
  );

  if ($query_result) {
    $user_session = mysqli_fetch_assoc($query_result);
    pre_print($user_session);
  } else {
    pre_print("invalid sestok");
  }

  include "db_disconnect.php";
}
