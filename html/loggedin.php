<?php

$success = false;

if(!empty($_POST['username'])) {

    include "db_connect.php";
    $stmt = $conn->prepare('SELECT id FROM customers WHERE email =? AND password=?');
    $stmt->bind_param('ss', $_POST['username'], $_POST['pww']);    
    $stmt->execute();
    $result = mysqli_stmt_fetch($stmt);
 
    if($result) {
        $success = true;
        echo "test";
        /* Hier zou je nog password hashing bij kunnen toevoegen

        if(password_verify('password', $hash)) {
            $success = true; 
            INSERT INTO DB 
        } */
    }
    
}

if ($success) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header("Location: index.php");
}






/*

$login_query = "SELECT * FROM customers WHERE email = $username";

$login_result = mysqli_query($conn, $login_query);

while($customer_info = mysqli_fetch_assoc($login_result)) {
    $passwords = $customer_info['passwords'];
    $usernames = $customer_info['email'];
    $user_id = $customer_info['id'];
    
    if ($passwords === $password && $usernames === $username) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $user_id;
        session_destroy();
        header("Location: cookies.php");

    }

*/

include "db_disconnect.php";
?>