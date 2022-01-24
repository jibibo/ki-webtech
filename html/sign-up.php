<?php 
// TO DO: create connection with database
// check connection

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
    if (empty($POST["email"])) {
        $email = ""; // goede manier???
    } elseif (!empty($POST["email"]) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = clean_data($POST["email"]);
        /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = "";
        }*/
    }
}

// $query = "INSERT INTO signup VALUES ('$email')";

/*  if(mysqli_query($conn, $sql)) {
        echo "Succesfully subscribed to our Newsletter!";
    } else {
        echo "Error" . mysqli_error($conn);
    }
*/

// TO DO: close connection database

?>