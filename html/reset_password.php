<?php

include "redirect_http.php";

// https://laratutorials.com/php-send-reset-password-link-email/ --> ter inspiratie gebruikt

// connect with database
include "db_connect.php";

// get key value from url
$email = $_GET["key"];
// get token value from url
$token = $_GET["token"];

// select everything from customers table where the given email is the same
$first_result = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");

// select everything from reset_password_tokens where the given token is the same
$result = mysqli_query($conn, "SELECT * FROM reset_password_tokens WHERE token='$token'");

// if query succeeds, get customer id from customers table
if ($first_result) {
  $customer = mysqli_fetch_assoc($first_result);
  $id = $customer["id"];
}

// if query succeeds, get customer id from reset_password_tokens table
if ($result) {
  $customer_reset = mysqli_fetch_assoc($result);
  $customer_id = $customer_reset["customer"];
}

// if those two customer id's do not match, print error message and return to forgot password page
if ($id != $customer_id) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Your email address doesn"t match the submitted one.");
  window.location.href="https://webtech-ki15.webtech-uva.nl/forgot-password.php";
  </script>
  END;
  exit;
}

// disconnect database
include "db_disconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reset | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/session.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="form">
      <form action="update_password.php" method="post" class="formscreen">
        <div class="title">Reset password</div>
        <input type="hidden" name="email" value="<?php echo $email ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>" />
        <div class="textbox">
          <input type="password" placeholder="New Password" name='password' required>
        </div>
        <div class="textbox">
          <input type="password" placeholder="Confirm Password" name='cpassword' required>
        </div>
        <button type="submit" name="submit_password" class="login">Change Password</button>
      </form>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>