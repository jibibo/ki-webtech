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
      <form action="" class="formscreen">
        <div class="title">CREATE AN ACCOUNT</div>

        <div class="register">
          <!-- <label> FIRST NAME</label> -->
          <input type="text" placeholder="First name" required>
        </div>

        <div class="register">
          <!-- <label>LAST NAME</label> -->
          <input type="text" placeholder="Last name" required>
        </div>

        <div class="register">
          <!--<label>PHONE</label> -->
          <input type="tel" placeholder="Phone number" required>
        </div>

        <div class="register">
          <!-- <label>EMAIL</label> -->
          <input type="email" placeholder="Email address" required>
        </div>

        <div class="register">
          <!-- <label>EMAIL</label> -->
          <input type="password" placeholder="Password of at least 8 characters" required>
        </div>

        <div class="register">
          <!-- <label>EMAIL</label> -->
          <input type="text" placeholder="Zip code" required>
        </div>

        <div class="register">
          <!-- <label>EMAIL</label> -->
          <input type="text" placeholder="House number" required>
        </div>

        <div class="register">
          <!-- <label>EMAIL</label> -->
          <input type="text" placeholder="Country" required>
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