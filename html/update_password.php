<?php
include "db_connect.php";

function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

$pass = $confirm = "";

if(isset($_POST['submit_password'])) {

    $email= $_POST['email'];
    $pass = clean_data($_POST["password"]);
    $confirm = clean_data($_POST["cpassword"]);

    // check if password contains at least 8 characters
    if (strlen($pass) < 8 || strlen($confirm) < 8) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('The password should contain at least 8 characters');
        </script>");
        exit;
    }

    // password hashing
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // $query = mysqli_query($conn,"SELECT password FROM customers WHERE email='$email'");
    $result = mysqli_query($conn,"UPDATE customers SET password='$hashed_pass' WHERE email='$email'");

    if ($result) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('The password should contain at least 8 characters');
        window.location.href='https://webtech-ki15.webtech-uva.nl/index.php';
        </script>");
        exit;
    } else {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Something went wrong, please try again.');
        window.location.href='https://webtech-ki15.webtech-uva.nl/reset_password.php';
        </script>");
        exit;
    }
}

include "db_disconnect.php";
?>



