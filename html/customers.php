<?php

include "redirect_http.php";

// create connection with database
include "db_connect.php";


// set variables to empty values
$fname = $lname = $phonenumber = $emailaddress = $psw = $address = $zipcode = $city = $country = "";

// checks whether form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fname = htmlspecialchars($_POST["first_name"]);

  // check if first name only consists of whitespaces and letters
  if (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid name');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $lname = htmlspecialchars($_POST["last_name"]);

  // check if last name only consists of whitespaces and letters
  if (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid name');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $phonenumber = htmlspecialchars($_POST["phone"]);

  // https://regexr.com/3aevr
  // check if phone number is a valid number in the Netherlands
  if (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $phonenumber)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid phone number');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $emailaddress = htmlspecialchars($_POST["email"]);

  // check if email address is valid and well-formed
  if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid email address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $psw = htmlspecialchars($_POST["password"]);

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
  $address = htmlspecialchars($_POST["address"]);

  // check if address is a valid address in the Netherlands
  if (!preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $address)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $zipcode = htmlspecialchars($_POST["zipcode"]);

  // https://stackoverflow.com/questions/17898523/regular-expression-for-dutch-zip-postal-code
  // check if zipcode is a valid zipcode in the Netherlands
  if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zipcode)) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid zipcode');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $city = htmlspecialchars($_POST["city"]);

  // check if city only consists of whitespaces and letters
  if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
    $city_err = "Please enter a valid city";
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid city');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
    exit;
  }

  $country = htmlspecialchars($_POST["country"]);

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
  echo ("<script LANGUAGE='JavaScript'>
        window.alert('Thank You for Signing Up!');
        window.location.href='https://webtech-ki15.webtech-uva.nl/session.php';
        </script>");
} else {
  echo ("<script LANGUAGE='JavaScript'>
        window.alert('This email is already in use, please register with an other email.');
        window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
        </script>");
}

// close connection database
include "db_disconnect.php";
