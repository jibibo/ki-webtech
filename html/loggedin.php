<?php

$success = false;

if(!empty($_POST['username'])) {

    include "db_connect.php";
    $stmt = $conn->prepare('SELECT id, password FROM customers WHERE email=?');
    $stmt->bind_param('s', $_POST['username']);    
    $stmt->execute();
    $result = $stmt -> get_result();
    $user_info = $result -> fetch_assoc();
    
    // verify if input password is equal to hashed password
    if($result) {
        if(password_verify($_POST['pww'], $user_info['password'])) {
            $success = true;
        }
    }

if ($success) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header("Location: index.php");
} else {
    echo "
    
    <script>
        window.alert('Wrong password or username!');
        window.location.href = 'log-in.php';
        </script>
        ";
    #header("Location: log-in.php");
    }
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
