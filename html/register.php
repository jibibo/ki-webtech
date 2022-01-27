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
        <p class="required"><span>* required field</span><p>

        <div class="register">
          <input type="text" placeholder="First name" name="fname" required><span> * </span>
        </div>

        <div class="register">
          <input type="text" placeholder="Last name" name="lname" required><span> * </span>
        </div>

        <div class="register">
          <input type="tel" placeholder="Phone number" name="phonenumber" ><span> * </span>
        </div>

        <div class="register">
          <input type="email" placeholder="Email address" name="email" required><span> * </span>
        </div>

        <div class="register">
          <input type="password" placeholder="Password of at least 8 characters" name="password" required><span> * </span>
        </div>

        <div class="register">
          <input type="text" placeholder="Address" name="address" required><span> * </span>
        </div>

        <div class="register">
          <input type="text" placeholder="Zip code" name="zipcode" required><span> * </span>
        </div>

        <div class="register">
          <input type="text" placeholder="City" name="city" required><span> * </span>
        </div>

        <div class="register">
          <input type="text" placeholder="Country" name="country" required><span> * </span>
        </div>

        <div class="agree">
          <p>By creating an account you agree to our <a href="#" class="terms">Terms & Privacy</a>.</p>
        </div>

        <div>
          <button class="create" type="submit">Create account!</button>
          <br></br>
          <a class="text" href="log-in.php">Back to login</a>
        </div>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>