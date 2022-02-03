<?php 
// create connection with database
include "db_connect.php";

// cleans the input of users 
function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// did not include password yet!!
// address weghalen --> ook in phpmyadmin weghalen? 
// wachtwoord in zelfde table stoppen?? 
// zipcode voldoende en makkelijker? 

// set variables to empty values
$fname = $lname = $phonenumber = $emailaddress = $psw = $address = $zipcode = $city = $country = "";
//$fname_err = $lname_err = $phonenumber_err = $emailaddress_err = $password_err = $address_err = $zipcode_err = $city_err = $country_err = "";

// checks whether form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*if (empty($_POST["fname"])) {
        $fname_err = "First name is required";
    } else {
        $fname = clean_data($_POST["fname"]);

        // check if first name only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
            $fname_err = "Please enter a valid name";
        }
    }

    if (empty($_POST["lname"])) {
        $lname_err = "Last name is required";
    } else {
        $lname = clean_data($_POST["lname"]);

        // check if last name only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
            $lname_err = "Please enter a valid name";
        }
    }

    if (empty($_POST["phonenumber"])) {
        $phonenumber_err = "Phone number is required";
    } else {
        $phonenumber = clean_data($_POST["phonenumber"]);

        // check if phone number is a valid number in the Netherlands
        if (!preg_match("/0[1-9][0-9]{8}/", $phonenumber)) {
            $phonenumber_err = "Please enter a valid phone number";
        }
    }

    // /0[1-9][0-9]{8}/ 
  
    if (empty($_POST["emailaddress"])) {
        $emailaddress_err = "Email is required";
    } else {
        $emailaddress = clean_data($_POST["emailaddress"]);

        // check if email address is valid and well-formed
        if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
            $emailaddress_err = "Please enter a valid email address";
        }
    }

    // source: https://stackoverflow.com/questions/8141125/regex-for-password-php
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = clean_data($_POST["password"]);

        // check if password is valid and secure
        if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
            $password_err = "The password should contain at least 1 number, 1 lowercase and 1 uppercase character";
        }
    }



// https://murani.nl/blog/2015-09-28/nederlandse-reguliere-expressies/ --> address regex
    if (empty($_POST["address"])) {
        $address_err = "Address is required";
    } else {
        $address = clean_data($_POST["address"]);

        // check if address is a valid address in the Netherlands
        if (!preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $address)) {
            $address_err = "Please enter a valid address";
        }
    }

    // address weghalen --> ook in phpmyadmin? 
    // zipcode voldoende en makkelijker? 
    //https://stackoverflow.com/questions/17898523/regular-expression-for-dutch-zip-postal-code

    if (empty($_POST["zipcode"])) {
        $zipcode_err = "Zipcode is required";
    } else {
        $zipcode = clean_data($_POST["zipcode"]);

        // check if zipcode is a valid zipcode in the Netherlands
        if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zipcode)) {
            $zipcode_err = "Please enter a valid zipcode";
        }
    }

    //[1-9][0-9]{3}˽?[A-z]{2}/
    // /^(?:NL-)?(\d{4})\s*([A-Z]{2})$/i

    if (empty($_POST["city"])) {
        $city_err = "City is required";
    } else {
        $city = clean_data($_POST["city"]);

        // check if city only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $city_err = "Please enter a valid city";
        }
    }

    if (empty($_POST["country"])) {
        $country_err = "Country is required";
    } else {
        $country = clean_data($_POST["country"]);

        // check if country only consists of whitespaces and letters
        if (!preg_match("/^[a-zA-Z ]+$/", $country)) {
            $country_err = "Please enter a valid country";
        }
    }

    // /^[a-zA-Z ]+$/ */

    $fname = clean_data($_POST["first_name"]);

    // check if first name only consists of whitespaces and letters
    if (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid name');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

    $lname = clean_data($_POST["last_name"]);

    // check if last name only consists of whitespaces and letters
    if (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid name');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

    $phonenumber = clean_data($_POST["phone"]);

    // check if phone number is a valid number in the Netherlands
    // src regex: https://stackoverflow.com/a/123666/13216113
    // https://regexr.com/3aevr
    if (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $phonenumber)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid phone number');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }
    // /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/gm

    $emailaddress = clean_data($_POST["email"]);

    // check if email address is valid and well-formed
    if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid email address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

    $psw = clean_data($_POST["password"]);

    // check if password contains at least 8 characters
    if (strlen($psw) < 8) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('The password should contain at least 8 characters');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

    // password hashing

    $hashed_psw = password_hash($psw, PASSWORD_DEFAULT);



// https://murani.nl/blog/2015-09-28/nederlandse-reguliere-expressies/ --> address regex

    $address = clean_data($_POST["address"]);

    // check if address is a valid address in the Netherlands
    if (!preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $address)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

// address weghalen --> ook in phpmyadmin? 
// zipcode voldoende en makkelijker? 
//https://stackoverflow.com/questions/17898523/regular-expression-for-dutch-zip-postal-code

    $zipcode = clean_data($_POST["zipcode"]);

    // check if zipcode is a valid zipcode in the Netherlands
    if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zipcode)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid zipcode');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }

//[1-9][0-9]{3}˽?[A-z]{2}/
// /^(?:NL-)?(\d{4})\s*([A-Z]{2})$/i

    $city = clean_data($_POST["city"]);

    // check if city only consists of whitespaces and letters
    if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
        $city_err = "Please enter a valid city";
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid city');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }


    $country = clean_data($_POST["country"]);

    // check if country only consists of whitespaces and letters
    if (!preg_match("/^[a-zA-Z ]+$/", $country)) {
        $country_err = "Please enter a valid country";
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid country');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
        exit;
    }
    

}

// insert data into database if all input was valid
$query = "INSERT INTO customers (first_name, last_name, phonenumber, email, password, address, zip, city, country) 
VALUES ('$fname', '$lname', '$phonenumber', '$emailaddress', '$hashed_psw', '$address', '$zipcode', '$city', '$country')";

// https://www.codegrepper.com/code-examples/javascript/how+to+redirect+to+another+page+in+php+after+alert+message

// if query is succeeded return to homepage, else try again on the register page
if (mysqli_query($conn, $query)) {
    // header ("Location: https://webtech-ki15.webtech-uva.nl/");
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Thank You for Signing Up!');
        window.location.href='https://webtech-ki15.webtech-uva.nl/session.php';
        </script>");
} else {
    //header ("Location: https://webtech-ki15.webtech-uva.nl/register.php");
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('This email is already in use, please register with an other email.');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
}

// close connection database
include "db_disconnect.php";
//header("Location: /");

?>
