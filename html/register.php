<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/register.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>
 
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
  $fname = $lname = $phonenumber = $emailaddress = $password = $address = $zipcode = $city = $country = "";
  $fname_err = $lname_err = $phonenumber_err = $emailaddress_err = $password_err = $address_err = $zipcode_err = $city_err = $country_err = "";

  // checks whether form has been submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["fname"])) {
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
          if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
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

      if (empty($_POST["zipcode"])) {
          $zipcode_err = "Zipcode is required";
      } else {
          $zipcode = clean_data($_POST["zipcode"]);

          // check if zipcode is a valid zipcode in the Netherlands
          if (!preg_match("/[1-9][0-9]{3}˽?[A-z]{2}/", $zipcode)) {
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

      // /^[a-zA-Z ]+$/

  }

  // insert data into database
  $query = "INSERT INTO customers (first_name, last_name, phonenumber, email, password, address, zip, city, country) 
  VALUES ('$fname', '$lname', '$phonenumber', '$emailaddress', '$password', '$address', '$zipcode', '$city', '$country')";

  // https://www.codegrepper.com/code-examples/javascript/how+to+redirect+to+another+page+in+php+after+alert+message

  // if query is succeeded return to homepage, else try again on the register page
  if (mysqli_query($conn, $query)) {
      // header ("Location: https://webtech-ki15.webtech-uva.nl/");
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Thank You for Signing Up!');
          window.location.href='https://webtech-ki15.webtech-uva.nl/';
          </script>");
  } else {
      //header ("Location: https://webtech-ki15.webtech-uva.nl/register.php");
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('This email is already in use, please register with an other email.');
          window.location.href='https://webtech-ki15.webtech-uva.nl/register.php';
          </script>");
  }

  // close connection database
  include "db_disconnect.php"

  ?>
 

  <div class="container">

    <div class="form">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formscreen">
        <div class="title">CREATE AN ACCOUNT</div>
        <p class="required"><span>* required field</span><p>

        <div class="register">
          <input type="text" placeholder="First name" name="fname" value="<?php echo $fname;?>"><span> * <?php echo $fname_err;?></span>
        </div>

        <div class="register">
          <input type="text" placeholder="Last name" name="lname" value="<?php echo $lname;?>"><span> * <?php echo $lname_err;?></span>
        </div>

        <div class="register">
          <input type="tel" placeholder="Phone number" name="phonenumber" value="<?php echo $phonenumber;?>"><span> * <?php echo $phonenumber_err;?></span>
        </div>

        <div class="register">
          <input type="email" placeholder="Email address" name="emailaddress" value="<?php echo $emailaddress;?>"><span> * <?php echo $emailaddress_err;?></span>
        </div>

        <div class="register">
          <input type="password" placeholder="Password of at least 8 characters" name="password"><span> * <?php echo $password_err;?></span>
        </div>

        <div class="register">
          <input type="text" placeholder="Address" name="address" value="<?php echo $address;?>"><span> * <?php echo $address_err;?></span>
        </div>

        <div class="register">
          <input type="text" placeholder="Zip code" name="zipcode" value="<?php echo $zipcode;?>"><span> * <?php echo $zipcode;?></span>
        </div>

        <div class="register">
          <input type="text" placeholder="City" name="city" value="<?php echo $city;?>"><span> * <?php echo $city_err;?></span>
        </div>

        <div class="register">
          <input type="text" placeholder="Country" name="country" value="<?php echo $country;?>"><span> * <?php echo $country_err;?></span>
        </div>

        <div class="agree">
          <p>By creating an account you agree to our <a href="#" class="terms">Terms & Privacy</a>.</p>
        </div>

        <div>
          <button class="create" type="submit">Create account!</button>
          <br></br>
          <a class="text" href="log-in.php">Back to login</a>
        </div>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>