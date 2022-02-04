<?php

include "redirect_http.php";

include "db_connect.php";

// redirect user if they didn't provide information
if (!isset($_POST["name"])) {
  header("Location: /");
}

$name = htmlspecialchars($_POST["name"]);
$phone = htmlspecialchars($_POST["phone"]);
$email = htmlspecialchars($_POST["email"]);
$subject = htmlspecialchars($_POST["subject"]);
$message = htmlspecialchars($_POST["message"]);

// insert the contact information into our db
$query = "INSERT INTO 'contact_form' ('name', 'phone', 'email', 'subject', 'message') VALUES ('$name', '$phone', '$email', '$subject', '$message');";
$success = false;
if (mysqli_query($conn, $query)) {
  $success = true;
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thank you! | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/contacted.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <?php

    if ($success) {
      // if contact information was successfully inserted into the db
      echo <<<END
      <div class="concontainer">
        <h1>THANK YOU FOR CONTACTING US!</h1>
        <h5>We will reply as soon as possible.</h5>
      </div>
      END;
    } else {
      // something went wrong inserting the data into the db
      echo <<<END
      <h1>Something went wrong!</h1>
      END;
    }

    ?>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>