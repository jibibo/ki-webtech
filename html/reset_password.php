<!doctype html>
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
        <?php 
        // https://laratutorials.com/php-send-reset-password-link-email/

        if($_GET['key'] && $_GET['token'])
        {
            include "db_connect.php";
            
            $email = $_GET['key'];
            $token = $_GET['token'];
            $first_query = mysqli_query($conn,"SELECT id FROM customers WHERE email='$email'");
            $id = mysqli_fetch_assoc($first_query);
            $query = mysqli_query($conn,"SELECT customer FROM reset_password_tokens WHERE token='$token'");
            $customer_id = mysqli_fetch_assoc($query);
            
            if ($id != $customer_id) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Your emailaddress doesn't match the submitted one.');
                window.location.href='https://webtech-ki15.webtech-uva.nl/';
                </script>");
                exit;
            } 
            include "db_disconnect.php";
        } 
        ?> 

            <form action="update_password.php" method="post" class="formscreen">
            <div class="title">Reset password</div>
            <input type="hidden" name="email" value="<?php echo $email;?>">
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