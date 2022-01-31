<?php

include "db_connect.php";

if (isset($_POST["name"])) {
  $name = htmlspecialchars($_POST["name"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $email = htmlspecialchars($_POST["email"]);
  $subject = htmlspecialchars($_POST["subject"]);
  $message = htmlspecialchars($_POST["message"]);
  
  $query = "INSERT INTO `contact_form` (`name`, `phone`, `email`, `subject`, `message`, `id`) VALUES ('$name', '$phone', '$email', '$subject', '$message', NULL);";
  $success = false;
  if (mysqli_query($conn, $query)) {
    $success = true;
  }
}


include "db_disconnect.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thanks you! | UvAzon</title>
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
 
  <div class="container">
      <?php

      if ($success) {
        echo <<<END
        <h1>Thank you for contacting us! We will reply as soon as possible.</h1>
        END;
      } else {
        echo <<<END
        <h1>broke</h1>
        END;
      }

      ?>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>