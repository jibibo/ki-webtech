<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($POST["email"])) {
        $email = "";
    } elseif (!empty($POST["email"]) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($POST["email"]);
        /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = "";
        }*/
    }





}