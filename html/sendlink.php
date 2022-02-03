<?php

include "redirect_http.php";

// connect with database
include "db_connect.php";

// set variable
$resetmail = "";

// checks whether form has been submitted
if (isset($_POST["reset_password"]) && $_POST["input_email"]) {
  // cleans input data
  $resetmail = htmlspecialchars($_POST["input_email"]);

  // show error message if the email is not valid
  if (!filter_var($resetmail, FILTER_VALIDATE_EMAIL)) {
    echo <<<END
    <script language='JavaScript'>
    window.alert('Please enter a valid email address');
    window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
    </script>
    END;
    exit;
  }

  // select all information of the user
  $result = mysqli_query($conn, "SELECT * FROM customers WHERE email='$resetmail'");

  // if the query succeeds, send email with reset password link
  if ($result) {
    // get all information of the query
    $customer = mysqli_fetch_assoc($result);

    if (!$customer) {
      // show error message if customer is not set
      echo <<<END
      <script language='JavaScript'>
      window.alert('Something went wrong, email does not exist.');
      window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
      </script>
      END;
      exit;
    }

    // set token
    $token = bin2hex(random_bytes(32));
    // get user id
    $id = $customer["id"];

    // insert the user id and token into table
    mysqli_query($conn, "INSERT INTO reset_password_tokens (token, customer) VALUES ('$token', $id)");

    // make a link with the token and the submitted email
    $link = "Click on the following link to reset your password: https://webtech-ki15.webtech-uva.nl/reset_password.php?key=$resetmail&token=$token";

    // send email with link to user 
    $to_email = "$resetmail";
    $subject = "Reset password Uvazon";
    $mail_content = "$link";
    $headers = "From: noreply@uvazon.nl";
    mail($to_email, $subject, $mail_content, $headers);

    // after send, show succeed message
    echo <<<END
    <script language='JavaScript'>
    window.alert('Successfully sent email!');
    window.location.href='https://webtech-ki15.webtech-uva.nl/index.php';
    </script>
    END;
  } else {
    // else show error message
    echo <<<END
    <script LANGUAGE='JavaScript'>
    window.alert('Something went wrong: email not found');
    window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
    </script>
    END;
    exit;
  }
}

// disconnect database
include "db_disconnect.php";
