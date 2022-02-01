<?php

// session_start();

include "user_session.php";

include "db_connect.php";

$status = "";

if (isset($_POST["in_out"])) {
  $in_out = htmlspecialchars($_POST["in_out"]);

  if ($in_out == "in") {
    // user should be logged IN
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $query_result = mysqli_query(
      $conn,
      "SELECT * FROM customers WHERE email='$email' LIMIT 1"
    );
    // check if customer with that email exists
    if ($query_result) {
      $customer = mysqli_fetch_assoc($query_result);
      // check password
      if (password_verify($password, $customer["password"])) {
        // src: https://www.php.net/manual/en/function.random-bytes.php
        // generate session token
        $session_token = bin2hex(random_bytes(32));
        setcookie("session_token", $session_token);
        $customer_id = $customer["id"];
        mysqli_query(
          $conn,
          "INSERT INTO customer_session_tokens ('customer', 'session_token') 
          VALUES ($customer_id, '$session_token')"
        );
        $name = $customer["first_name"];
        $status = "Logged in as $name";
        // header("Location: /");
      } else {
        $status = "Invalid password";
      }
    } else {
      $status = "Email is not registered";
    }

  } elseif ($in_out == "out" && isset($_COOKIE["session_token"])) {
    // user should be logged OUT, clear the users session token cookie and db id
    $session_token = htmlspecialchars($_COOKIE["session_token"]);
    $query_result = mysqli_query(
      $conn,
      "SELECT * 
      FROM customer_session_tokens cst
      WHERE session_token='$session_token' 
      LIMIT 1"
    );

    if ($query_result) {
      mysqli_query(
        $conn,
        "DELETE FROM customer_session_tokens cst 
        WHERE cst.session_token='$session_token'"
      );
    }

    setcookie("session_token");
    // if invalid session token OR successfully deleted session token, redirect
    $status = "Logged out";

    // header("Location: /");
  } else {
    // invalid log in/out option, or not logged in & wanted to log out
    $status = "Something went wrong, please try again";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log in | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/log-in.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="form">
      <form action="log-in.php" method="post" class="formscreen">
        <div class="title">Log in</div>

        <?php

        if ($status) {
          echo <<<END
          <br />
          <span class="status">$status</span>
          END;
        }

        ?>

        <div class="textbox">
          <input type="text" placeholder="Email address" name="email" autofocus required>
          <br><br>

          <input type="password" placeholder="Password" name="password" required>
          <br><br>
        </div>

        <div>
          <input type="hidden" name="in_out" value="in" />
          <button type="submit" class="login" title="Login">Log in</button>
          <p><a class="text" href="forgot-password.php">Forgot password</a></p>
          <p>Not a member yet? <a class="text" href="register.php">Click here to register!</a></p>
        </div>
      </form>
    </div>

    <?php
    // if (isset($_SESSION['username'])) {
    if (isset($_COOKIE["session_token"])) {
      echo <<<END
      <form action="log-in.php" method="post" class="formscreen">
        <div>
          <input type="hidden" name="in_out" value="out" />
          <button type="submit" class="logout" title="Logout">Logout</button>
        </div>
      </form>
      END;
    }
    ?>

  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>