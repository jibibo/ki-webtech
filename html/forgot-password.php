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
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="css/forgot-password.css" />

  <style>
    /*.resetcontainer {
                background-color: white;
                padding: 70px;
I
            }

            .resetform {
                text-align: center;
                place-items: center;
                border: black;
            }

            .reset {
                color: #FEBD69;
                font-size: 38px;
                font-weight: bolder;
                padding: 25px;
            }

            .emailaddress .send {
                margin-top: 10px;
            }

            .emailaddress input {
                font-size: 20px;
                padding: 10px;
            }

            .send {
                font-size: 20px;
                color: black;
                padding: 10px 140px;
                background-color: #FEBD69;
                border-color: #FEBD69;
            }

            .send:hover {
                background-color: #e4b271;
            }

            .text {
                font-size: 20px;
            }

            .login {
                text-decoration: none;
                color: #FEBD69;
                font-weight: bolder;
            }

            .login:hover {
                text-decoration: underline;
            } */
  </style>
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="form">
      <form action="" class="formscreen">
        <div class="title">RESET YOUR PASSWORD</div>
        <p class="paragraph">No worries! We will send you an email with instructions to reset your password.</p>

        <div class="email">
          <input type="text" placeholder="Email address" name="email" required>
        </div>

        <div>
          <button type="submit" class="send">Send</button>
          <br></br>
          <a class="text" href="login.html">Back to login</a>
        </div>
      </form>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>