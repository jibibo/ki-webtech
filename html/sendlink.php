<?php 
include "db_connect.php";

function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

$resetmail = "";

// https://laratutorials.com/php-send-reset-password-link-email/

if(isset($_POST["reset_password"]) && $_POST["input_email"])
{
    $resetmail = clean_data($_POST["input_email"]);

    if (!filter_var($resetmail, FILTER_VALIDATE_EMAIL)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid email address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
        </script>");
        exit;
    }
    $result = mysqli_query($conn,"SELECT * FROM customers WHERE email='$resetmail'");

    if ($result) {
        $customer = mysqli_fetch_assoc($result);
        $token = bin2hex(random_bytes(32));
        $id = $customer["id"];

        mysqli_query($conn, "INSERT INTO reset_password_tokens (token, customer) VALUES ('$token', $id)");

        // $update = mysqli_query($conn,"UPDATE users set password='" . $password . "', token='" . $token . "' WHERE email='" . $resetmail . "'");
        $link = "Click on the following link to reset your password: https://webtech-ki15.webtech-uva.nl/reset_password.php?key=$resetmail&token=$token";

        $to_email = "$resetmail";
        $subject = "Reset password Uvazon";
        $mail_content = "$link";
        $headers = "From: uvazon@contact.nl";
        mail($to_email,$subject,$mail_content,$headers);

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Successfully sent email!');
        window.location.href='https://webtech-ki15.webtech-uva.nl/index.php';
        </script>");
    }
    else
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Something went wrong, please try again.');
        window.location.href='https://webtech-ki15.webtech-uva.nl/forgot-password.php';
        </script>");
    }
}

include "db_disconnect.php";
?>
