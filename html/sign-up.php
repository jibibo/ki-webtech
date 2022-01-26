<?php 
// check connection
include "db_connect.php";

// cleans the input of users 
function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// set variables to empty values
$email = "";

// checks whether form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $email = ""; 
    } else {
        $email = clean_data($_POST["email"]);

        // checks whether the email form is correct
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = clean_data($_POST["email"]);
        }
    }
}

$query = "INSERT INTO newsletter VALUES ('$email')";

/*if (mysqli_query($conn, $query)) {
        echo "Succesfully subscribed to our Newsletter!";
} else {
        echo "This email is already subscribed, please enter with an other email." . mysqli_error($conn);
}*/

// shows alert message if the user is subscribed or not subscribed 
if (mysqli_query($conn, $query)) {
  echo '<script language="javascript">';
  echo 'alert("Thank You for subscribing to our Newsletter!")';
  echo '</script>';
} else {
  echo '<script language="javascript">';
  echo 'alert("This email is already subscribed, please enter with an other email.")';
  echo '</script>';
}

// disconnect
include "db_disconnect.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="gif">
    <img src="https://c.tenor.com/q-zZSTX6jSIAAAAC/mail-download.gif" alt="Mail gif">
  </div>

  <h2 class="subscribe">Subscribe to our Newsletter!</h2>

  <?php
  include "footer.php";
  ?>
</body>

</html>