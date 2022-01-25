<?php

session_start();

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
      <form action="loggedin.php" method="post" class="formscreen">
        <div class="title">LOGIN</div>

        <div class="textbox">
          <input type="text" placeholder="Username" name="username" autofocus required>
          <br><br>

          <input type="password" placeholder="Password" name="pww" required>
          <br><br>
        </div>

        <div>
          <button type="submit" class="login" title="Login">Login</button>
          <p>Forgotten your <a class="text" href="forgot-password.php">password?</a></p>
          <p>Not a member yet? Click here to <a class="text" href="register.php">register!</a></p>
        </div>
      </form>
    </div>

    <?php if(isset($_SESSION['username'])) {
      echo "
      <form action='logout.php' method='post' class='formscreen'>
            <div>
          <button type='submit' class='logout' title='Logout'>Logout</button> </div>
          "; 
    }  ?>

  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>