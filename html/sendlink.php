<?php 


// info:
// https://www.allphptricks.com/forgot-password-recovery-reset-using-php-and-mysql/

include "db_connect.php";

function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

$resetmail = "";

// https://laratutorials.com/php-send-reset-password-link-email/

if(isset($_POST['reset_password']) && $_POST['input_email'])
{
    $resetmail = clean_data($_POST['input_email']);

    if (!filter_var($resetmail, FILTER_VALIDATE_EMAIL)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid email address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }
    $query = mysqli_query($conn,"SELECT * FROM customers WHERE email='" . $resetmail . "'");

    $row= mysqli_fetch_array($query);

    if($row) {
        $token = md5($resetmail).rand(10,9999);

        $update = mysqli_query($conn,"UPDATE users set  password='" . $password . "', token='" . $token . "' WHERE email='" . $emailId . "'");
        $link = "<a href='https://webtech-ki15.webtech-uva.nl/index.php?key=".$resetmail."&token=".$token."'>Click To Reset password</a>";

        $to_email = "$resetmail";
        $subject = "Reset password Uvazon";
        $message = "$link";
        $headers = 'From: uvazon@contact.nl';
        mail($to_email,$subject,$message,$headers);
        
    }
}

include "db_disconnect.php";

?>