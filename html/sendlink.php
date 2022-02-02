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

    $query = mysqli_query($conn,"SELECT * FROM customers WHERE email='" . $resetmail . "'");

    $row= mysqli_fetch_array($query);

    if($row) {
        $token = md5($resetmail).rand(10,9999);

        $update = mysqli_query($conn,"UPDATE users set  password='" . $password . "', token='" . $token . "' WHERE email='" . $emailId . "'");
        $link = "<a href='https://webtech-ki15.webtech-uva.nl/reset_password.php?key=".$resetmail."&token=".$token."'>Click To Reset password</a>";

        $to_email = 'name @ company . com';
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function';
        $headers = 'From: noreply @ company . com';
        mail($to_email,$subject,$message,$headers);
        
    }



}

?>