<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($POST["email"])) {
        $email = "";
    } else {
        $email = htmlspecialchars($POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = "";
        }
    }





}