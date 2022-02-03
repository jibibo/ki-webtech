<!DOCTYPE html>
<html lang="en">

<head>
  <title>Forgot password | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/forgot-password.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="form">
      <form action="sendlink.php" method="post" class="formscreen">
        <div class="title">RESET YOUR PASSWORD</div>
        <p class="paragraph">Forgot your password? No worries! We will send you an email with instructions to reset your password.</p>

        <div class="email">
          <input type="text" placeholder="Email address" name="input_email" required>
        </div>

        <div>
          <button type="submit" class="send" name="reset_password">Send</button>
          <br />
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