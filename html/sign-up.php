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
        $email = ""; // goede manier???
    } else {
        $email = clean_data($_POST["email"]);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = clean_data($_POST["email"]);
        }
    }
}

$query = "INSERT INTO newsletter VALUES ('$email')";
// --> alleen inserten als het nog niet bestaat? 
/*  If Not Exists(select * from tablename where code='144....')
    Begin
    insert into tablename (code) values ('1448523')
    End */

/*if (mysqli_query($conn, $query)) {
        echo "Succesfully subscribed to our Newsletter!";
} else {
        echo "This email is already subscribed, please enter with an other email." . mysqli_error($conn);
}*/
  if (mysqli_query($conn, $query)) {
        echo '<script language="javascript">';
        echo 'alert("Succesfully subscribed to our Newsletter!")';
        echo '</script>';
  } else {
        echo '<script language="javascript">';
        echo 'alert("This email is already subscribed, please enter with an other email.")';
        echo '</script>';
  }

/* echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';*/

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

  <div class="container">


  </div>
<!-- <script>
  function message() {
    var input_valid = document.getElementById("footer_email");
    if (input_valid.checkValidity()) {
      alert("Thank You For Signing Up!");
    } //else {
      //alert("Invalid email");  test internet
    //} 
  }
</script> -->
  <?php
  include "footer.php";
  ?>
</body>

</html>