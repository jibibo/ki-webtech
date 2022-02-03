<?php

include "db_connect.php";

// redirect user if insufficient information provided
if (
  !isset($_COOKIE["cart"]) || !isset($_POST["first_name"]) ||
  !isset($_POST["last_name"]) || !isset($_POST["address"]) ||
  !isset($_POST["zip"]) || !isset($_POST["country"]) ||
  !isset($_POST["email"]) || !isset($_POST["phonenumber"])
) {
  header("Location: /");
  exit;
}

// get order info

/*
$first_name = htmlspecialchars($_POST["first_name"]);
$last_name = htmlspecialchars($_POST["last_name"]);
$address = htmlspecialchars($_POST["address"]);
$zip = htmlspecialchars($_POST["zip"]);
$country = htmlspecialchars($_POST["country"]);
$email = htmlspecialchars($_POST["email"]);
$phonenumber = htmlspecialchars($_POST["phonenumber"]);
*/

// input validation and order info

function clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

$first_name = clean_data($_POST["first_name"]);

  // check if first name only consists of whitespaces and letters
  if (!preg_match("/^[a-zA-Z ]+$/", $first_name)) {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Please enter a valid name');
      window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
      </script>");
      exit;
  }

  $last_name = clean_data($_POST["last_name"]);

  // check if last name only consists of whitespaces and letters
  if (!preg_match("/^[a-zA-Z ]+$/", $last_name)) {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Please enter a valid name');
      window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
      </script>");
      exit;
  }

	$address = clean_data($_POST["address"]);

    // check if address is a valid address in the Netherlands
    if (!preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $address)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
        </script>");
        exit;
    }

    $zip = clean_data($_POST["zip"]);

    // check if zipcode is a valid zipcode in the Netherlands
    if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zip)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid zipcode');
        window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
        </script>");
        exit;
    }   
    
     $country = clean_data($_POST["country"]);

    // check if country only consists of whitespaces and letters
    if (!preg_match("/^[a-zA-Z ]+$/", $country)) {
        $country_err = "Please enter a valid country";
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid country');
        window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
        </script>");
        exit;
    }

    $email = clean_data($_POST["email"]);

    // check if email address is valid and well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid email address');
        window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
        </script>");
        exit;
    }

    $phonenumber = clean_data($_POST["phonenumber"]);

    // check if phone number is a valid number in the Netherlands
    // src regex: https://stackoverflow.com/a/123666/13216113
    // https://regexr.com/3aevr
    if (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $phonenumber)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Please enter a valid phone number');
        window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
        </script>");
        exit;
    }
    // /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/gm


// create order in db
mysqli_query(
  $conn,
  // "INSERT INTO `orders` (`id`, `first_name`, `last_name`, `address`, `zip`, `country`, `email`, `phone`, `total_price`, `date`, `status`) VALUES (NULL, 'sadf', 'asdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '-1', CURRENT_TIMESTAMP, 'PROCESSING');  "
  "INSERT INTO orders (first_name, last_name, address, zip, country, email, phonenumber) 
  VALUES ('$first_name', '$last_name', '$address', '$zip', '$country', '$email', '$phonenumber')"
);

// get the newly generated order id
$order_id = mysqli_insert_id($conn);

// get ordered products (stored in cookie)
$cartcookie = htmlspecialchars($_COOKIE["cart"]);
$cart_ids = explode("|", $cartcookie);

$product_ids = array();
foreach ($cart_ids as $product_id_str) {
  // product id is not numeric, continue
  if (!is_numeric($product_id_str)) {
    continue;
  }

  $product_id = intval($product_id_str);
  $product_ids[] = $product_id;
}

$product_ids_unique = array_unique($product_ids);
// src: https://stackoverflow.com/a/5945242/13216113
$product_counts = array_count_values($product_ids);
$order_products_info = array();

$subtotal = 0;
foreach ($product_ids_unique as $product_id) {
  // get product info
  $product_result = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id=$product_id"
  );

  if (!$product_result) {
    // product id not found, ignore
    continue;
  }

  $product = mysqli_fetch_assoc($product_result);
  $product_id = $product["id"];
  $product_name = $product["name"];
  $quantity = $product_counts[$product_id];
  $subtotal += $product["price"] * $quantity;

  mysqli_query(
    $conn,
    "INSERT INTO order_products (order_id, product_id, quantity) 
    VALUES ($order_id, $product_id, $quantity)"
  );

  $order_products_info[] = "$product_name ($quantity x)";
}

$order_products_info[] = "Total: € $subtotal";

// update recently created order to show the total price
mysqli_query(
  $conn,
  "UPDATE orders SET total_price=$subtotal WHERE id=$order_id;"
);
// clear user's cart cookie
setcookie("cart");

// alert the user of the order info
$order_products_info_joined = join("\n", $order_products_info);

?>

<html>
<head>
  <title>Home | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/invoice.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="message">
      <?php 
      echo 
      "
      <h1>Thank you for your purchase, ".$_POST['first_name']."! </h1>
      ";
      ?>
    </div>
    <div class="order-info">
      <table class="invoice-container">
        <tr class="bold">
          <td>Product</td>
          <td>Quantity</td>
          <td>Image</td>
        </tr>
        <br />
        <?php //echo join("<br /><tr><td>", $order_products_info) ?>
        
        <?php
        // include "utils.php";
        // pre_print($product_counts);
        foreach ($product_ids_unique as $product_id) {
          // get product info
          $product_result = mysqli_query(
            $conn,
            "SELECT * FROM products WHERE id=$product_id"
          );
        
          if (!$product_result) {
            // product id not found, ignore
            continue;
          }
        
          $product = mysqli_fetch_assoc($product_result);
          $product_id = $product["id"];
          $product_name = $product["name"];
          $quantity = $product_counts[$product_id];
          $subtotal += $product["price"] * $quantity;
          $image = $product["image_url"];

          echo 
          "
          <tr>
            <td>$product_name</td>
            <td>$quantity</td>
            <td class='right'> <img src='$image' width='200px' height='200px'></td>
          </tr>
          
          "; }
          echo 
          "
          <tr class='subtotal'>
            <td>Total price: €$subtotal</td>
          </tr>
          ";
        ?>
          </td>
        </tr>
      </table>
    </div>
    <div class="return">
          <form method="post">
            <input type="submit" value="Return to home page" /> 
          </form>
    </div>
  </div>
  <?php
  include "footer.php";
  ?>
</body>
</html>
