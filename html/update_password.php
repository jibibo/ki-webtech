<?php
// connect with database
include "db_connect.php";

// funtion to clean input data
function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// set variables
$pass = $confirm = "";

// checks whether form has been submitted
if(isset($_POST['submit_password'])) {

    // get submitted email value
    $email = clean_data($_POST["email"]);
    $token = clean_data($_POST["token"]);
    // clean password input
    $pass = clean_data($_POST["password"]);
    $confirm = clean_data($_POST["cpassword"]);

    // if both passwords doesn't contain at least 8 characters, print error message
    if (strlen($pass) < 8 || strlen($confirm) < 8) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('The password should contain at least 8 characters, please try again');
        window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
        </script>");
        exit;
    }

    // password hashing
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // make sure the token is legitimate
    $result_token = mysqli_query($conn,"SELECT * FROM reset_password_tokens WHERE token='$token'");

    // if token does not exist, print error message
    if (!$result_token) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Your password reset token does not exist, please try again');
        window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
        </script>");
        exit;
    }

    // update the old password to the new one
    $result = mysqli_query($conn,"UPDATE customers SET password='$hashed_pass' WHERE email='$email'");

    // if query succeeds, print success message, else print error message
    if ($result) {
        mysqli_query($conn,"DELETE FROM reset_password_tokens WHERE token='$token'");
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Password is successfully changed!');
        window.location.href='https://webtech-ki15.webtech-uva.nl/index.php';
        </script>");
        exit;
    } else {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Something went wrong, please try again.');
        window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
        </script>");
        exit;
    }
}

// disconnect database
include "db_disconnect.php";
?>



