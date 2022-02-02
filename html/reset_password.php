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
        <div class="title">Reset password</div>
        <div class="form">
        <?php /*
        if($_GET['key'] && $_GET['token'])
        {
            include "db_connect.php";
            
            $email = $_GET['key'];
            $token = $_GET['token'];
            $query = mysqli_query($conn,
            "SELECT * FROM `users` WHERE `token`='".$token."' and `email`='".$email."';"
            );
            
            if (mysqli_num_rows($query) > 0) {
                $row= mysqli_fetch_array($query);
            }

            include "db_disconnect.php";
        } */
        ?> 

            <form action="update_password.php" method="post" class="formscreen">
            <input type="hidden" name="email" >
            <input type="hidden" name="token" >
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