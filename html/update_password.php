<?php
// connect with database
include "db_connect.php";

// set variables
$pass = $confirm = "";

// checks whether form has been submitted
if (isset($_POST['submit_password'])) {

  // get submitted email value
  $email = htmlspecialchars($_POST["email"]);
  $token = htmlspecialchars($_POST["token"]);
  // clean password input
  $pass = htmlspecialchars($_POST["password"]);
  $confirm = htmlspecialchars($_POST["cpassword"]);

  // if both passwords doesn't contain at least 8 characters, print error message
  if (strlen($pass) < 8 || strlen($confirm) < 8) {
    echo <<<END
    <script language='JavaScript'>
    window.alert('The password should contain at least 8 characters, please try again');
    window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
    </script>
    END;
    exit;
  }

  // password hashing
  $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

  // make sure the token is legitimate
  $result_token = mysqli_query($conn, "SELECT * FROM reset_password_tokens WHERE token='$token'");

  // if token does not exist, print error message
  if (!$result_token) {
    echo <<<END
    <script language='JavaScript'>
    window.alert('Your password reset token does not exist, please try again');
    window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
    </script>
    END;
    exit;
  }

  // update the old password to the new one
  $result = mysqli_query($conn, "UPDATE customers SET password='$hashed_pass' WHERE email='$email'");

  // if query succeeds, print success message, else print error message
  if ($result) {
    mysqli_query($conn, "DELETE FROM reset_password_tokens WHERE token='$token'");
    echo <<<END
    <script language='JavaScript'>
    window.alert('Password is successfully changed!');
    window.location.href='https://webtech-ki15.webtech-uva.nl/index.php';
    </script>
    END;
    exit;
  } else {
    echo <<<END
    <script language='JavaScript'>
    window.alert('Something went wrong, please try again.');
    window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
    </script>
    END;
    exit;
  }
}

// disconnect database
include "db_disconnect.php";
