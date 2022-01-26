<?php 
// check connection
include "db_connect.php";

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

$query = "INSERT INTO newsletter VALUES ('$email')";
// --> alleen inserten als het nog niet bestaat? 
/*  If Not Exists(select * from tablename where code='144....')
    Begin
    insert into tablename (code) values ('1448523')
    End */

if(mysqli_query($conn, $sql)) {
        echo "Succesfully subscribed to our Newsletter!";
} else {
        echo "Error" . mysqli_error($conn);
}

// disconnect
include "db_disconnect.php"

?>