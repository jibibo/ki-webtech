<?php 
// TO DO: create connection with database
// check connection
// include "db_connect.php";

// cleans the input of users 
function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// set variables to empty values
$fname = $lname = $phonenumber = $email = $password = $address = $zipcode = $city = $country = "";
$fname_err = $lname_err = $phonenumber_err = $email_err = $password_err = $address_err = $zipcode_err = $city_err = $country_err = "";

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

// $query = "INSERT INTO customers VALUES ('$fname', '$lname', '$phonenumber', '$email', '$password', 'address', '$zipcode', '$city', '$country')";
// --> alleen inserten als het nog niet bestaat? 
/*  If Not Exists(select * from tablename where code='144....')
    Begin
    insert into tablename (code) values ('1448523')
    End */

/*  if(mysqli_query($conn, $sql)) {
        echo "Succesfully subscribed to our Newsletter!";
    } else {
        echo "Error" . mysqli_error($conn);
    }
*/

// TO DO: close connection database
// include "db_disconnect.php"

?>