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

// did not include password yet!!

// set variables to empty values
$fname = $lname = $phonenumber = $email = $password = $address = $zipcode = $city = $country = "";
$fname_err = $lname_err = $phonenumber_err = $email_err = $password_err = $address_err = $zipcode_err = $city_err = $country_err = "";

// checks whether form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($POST["fname"])) {
        $fname_err = "First name is required";
    } else {
        $fname = clean_data($_POST["fname"]);

        // check if first name only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
            $fname_err = "Please enter a valid name";
        }
    }

    if (empty($POST["lname"])) {
        $lname_err = "Last name is required";
    } else {
        $lname = clean_data($_POST["lname"]);

        // check if last name only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
            $lname_err = "Please enter a valid name";
        }
    }

    if (empty($POST["phonenumber"])) {
        $phonenumber_err = "Phone number is required";
    } else {
        $phonenumber = clean_data($_POST["phonenumber"]);

        // check if phone number is a valid number in the Netherlands
        if (!preg_match("/0[1-9][0-9]{8}/", $phonenumber)) {
            $phonenumber_err = "Please enter a valid phone number";
        }
    }

    // /0[1-9][0-9]{8}/ 
  
    if (empty($POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = clean_data($POST["email"]);

        // check if email address is valid and well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email address";
        }
    }

    // address weghalen --> ook in phpmyadmin? 
    // zipcode voldoende en makkelijker? 

    if (empty($POST["zipcode"])) {
        $zipcode_err = "Zipcode is required";
    } else {
        $zipcode = clean_data($POST["zipcode"]);

        // check if zipcode is a valid zipcode in the Netherlands
        if (!preg_match("/[1-9][0-9]{3}˽?[A-z]{2}/", $zipcode)) {
            $zipcode_err = "Please enter a valid zipcode";
        }
    }

    //[1-9][0-9]{3}˽?[A-z]{2}/
    // /^(?:NL-)?(\d{4})\s*([A-Z]{2})$/i

    if (empty($POST["city"])) {
        $city_err = "City is required";
    } else {
        $city = clean_data($_POST["city"]);

        // check if city only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $city_err = "Please enter a valid city";
        }
    }

    if (empty($POST["country"])) {
        $country_err = "Country is required";
    } else {
        $country = clean_data($_POST["country"]);

        // check if country only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $country)) {
            $country = "Please enter a valid country";
        }
    }

    // /^[a-zA-Z ]+$/

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