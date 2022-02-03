<?php 
// create connection with database
include "db_connect.php";

// cleans the input of users 
function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// set variables to empty values
$email = $email_err = "";

// checks whether form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // if empty return to homepage and exit code, else get input value
  if (empty($_POST["email"])) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('This field is empty, please enter an email for signing up.');
    window.location.href='https://webtech-ki15.webtech-uva.nl/';
    </script>");
    exit;
  } else {
      $email = clean_data($_POST["email"]);

      // if input is not valid, return to home page and exit code
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo <<<END
        <script language="JavaScript">
        window.alert("Please enter a valid email address");
        window.location.href="https://webtech-ki15.webtech-uva.nl/";
        </script>
        END;
        exit;
      } 
  }
}

// only insert form data into database if input was valid
$query = "INSERT INTO newsletter VALUES ('$email')";

// if the email is already subscribed, alert user and redirect user to homepage
if (!mysqli_query($conn, $query)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("This email is already subscribed, please enter with an other email.");
  window.location.href="https://webtech-ki15.webtech-uva.nl/";
  </script>
  END;
}

// disconnect from database
include "db_disconnect.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Newsletter | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/sign-up.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="gif">
    <!--<img src="https://c.tenor.com/q-zZSTX6jSIAAAAC/mail-download.gif" alt="Mail gif">-->

    <!-- shows user that the subscription to the newsletter was successfull -->
    <img src="https://cdn.dribbble.com/users/1551941/screenshots/6346538/thankyoudribble.gif" alt="Mail gif">
  </div>

  <div class="subscribe"> 
    <h2>Subscribed to our Newsletter!</h2>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>