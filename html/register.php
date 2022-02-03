<?php

include "redirect_http.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/register.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">

    <div class="form">
      <form action="customers.php" method="post" class="formscreen">
        <div class="title">CREATE AN ACCOUNT</div>

        <div class="register">
          <input type="text" placeholder="First name" name="first_name" required>
        </div>

        <div class="register">
          <input type="text" placeholder="Last name" name="last_name" required>
        </div>

        <div class="register">
          <input type="tel" placeholder="Phone number" name="phone" required>
        </div>

        <div class="register">
          <input type="email" placeholder="Email address" name="email" required>
        </div>

        <div class="register">
          <input type="password" placeholder="Password (8+ characters)" name="password" required>
        </div>

        <div class="register">
          <input type="text" placeholder="Address" name="address" required>
        </div>

        <div class="register">
          <input type="text" placeholder="Zip code" name="zipcode" required>
        </div>

        <div class="register">
          <input type="text" placeholder="City" name="city" required>
        </div>

        <div class="register">
          <input type="text" placeholder="Country" name="country" required>
        </div>

        <div class="agree">
          <p>By creating an account you agree to our <a href="terms.php" class="terms">Terms & Privacy</a>.</p>
        </div>

        <div>
          <button class="create" type="submit">Create account!</button>
          <br></br>
          <a class="text" href="session.php">Back to login</a>
        </div>
      </form>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>
