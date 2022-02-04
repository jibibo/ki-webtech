<?php

include "redirect_http.php";

include "db_connect.php";

// redirect user if insufficient information provided
if (
  !isset($_COOKIE["cart"]) || !isset($_POST["first_name"]) ||
  !isset($_POST["last_name"]) || !isset($_POST["address"]) ||
  !isset($_POST["zip"]) || !isset($_POST["country"]) ||
  !isset($_POST["email"]) || !isset($_POST["phonenumber"]) ||
  !isset($_POST["city"])
) {
  header("Location: /");
  exit;
}

// input validation and order info

$first_name = htmlspecialchars($_POST["first_name"]);

// check if first name only consists of whitespaces and letters
if (!preg_match("/^[a-zA-Z ]+$/", $first_name)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid name");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$last_name = htmlspecialchars($_POST["last_name"]);

// check if last name only consists of whitespaces and letters
if (!preg_match("/^[a-zA-Z ]+$/", $last_name)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid name");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$address = htmlspecialchars($_POST["address"]);

// check if address is a valid address in the Netherlands
if (!preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $address)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid address");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$zip = htmlspecialchars($_POST["zip"]);

// check if zipcode is a valid zipcode in the Netherlands
if (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $zip)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid zipcode");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$city = htmlspecialchars($_POST["city"]);

// check if city only consists of whitespaces and letters
if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
  echo <<<END
  <script LANGUAGE='JavaScript'>
  window.alert('Please enter a valid city');
  window.location.href='https://webtech-ki15.webtech-uva.nl/checkout.php';
  </script>
  END;
  exit;
}

$country = htmlspecialchars($_POST["country"]);

// check if country only consists of whitespaces and letters
if (!preg_match("/^[a-zA-Z ]+$/", $country)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid country");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$email = htmlspecialchars($_POST["email"]);

// check if email address is valid and well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid email address");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

$phonenumber = htmlspecialchars($_POST["phonenumber"]);

// check if phone number is a valid number in the Netherlands
// https://regexr.com/3aevr
if (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $phonenumber)) {
  echo <<<END
  <script language="JavaScript">
  window.alert("Please enter a valid phone number");
  window.location.href="https://webtech-ki15.webtech-uva.nl/checkout.php";
  </script>
  END;
  exit;
}

// create order in db
mysqli_query(
  $conn,
  "INSERT INTO orders (first_name, last_name, address, zip, city, country, email, phonenumber) 
  VALUES ('$first_name', '$last_name', '$address', '$zip', '$city', '$country', '$email', '$phonenumber')"
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
// create array containing occurences of each value in the original array
$product_counts = array_count_values($product_ids);

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
}

// update recently created order to show the total price
mysqli_query(
  $conn,
  "UPDATE orders SET total_price=$subtotal WHERE id=$order_id;"
);

// clear user's cart cookie
setcookie("cart");

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
  <link rel="stylesheet" href="css/order.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="message">
      <?php
      // inform the user that they have successfully bought their products
      echo <<<END
      <h1>Thank you for your purchase, $first_name! </h1>
      END;
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

        <?php
        // iterate over each product bought and get its information

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

          echo <<<END
          <tr>
            <td>$product_name</td>
            <td>$quantity</td>
            <td class="right"> <img src="$image" width="200px" height="200px"></td>
          </tr>
          END;
        }

        // print calculated total price
        echo <<<END
        <tr class="subtotal">
          <td>Total price: €$subtotal</td>
        </tr>
        END;
        ?>

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