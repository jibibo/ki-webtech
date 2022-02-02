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
$first_name = htmlspecialchars($_POST["first_name"]);
$last_name = htmlspecialchars($_POST["last_name"]);
$address = htmlspecialchars($_POST["address"]);
$zip = htmlspecialchars($_POST["zip"]);
$country = htmlspecialchars($_POST["country"]);
$email = htmlspecialchars($_POST["email"]);
$phonenumber = htmlspecialchars($_POST["phonenumber"]);

// create order in db
mysqli_query(
  $conn,
  // "INSERT INTO `orders` (`id`, `first_name`, `last_name`, `address`, `zip`, `country`, `email`, `phone`, `total_price`, `date`, `status`) VALUES (NULL, 'sadf', 'asdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '-1', CURRENT_TIMESTAMP, 'PROCESSING');  "
  "INSERT INTO orders (first_name, last_name, address, zip, country, email, phonenumber) 
  VALUES ('$first_name', '$last_name', '$address', '$zip', '$country', '$email', '$phonenumber')"
);

// get the newly generated order id
$order_id = mysqli_insert_id($conn);
echo "created id $order_id <br/>";

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
echo $order_products_info_joined;

echo <<<END
<script>
window.alert("$order_products_info_joined");
window.location.href = "/";
</script>
END;




// if (isset($_SESSION['username'])) {
//   $username = $_SESSION["username"];
//   $user_query = "SELECT id FROM customers WHERE email = '$username'";
//   $user_result = mysqli_query($conn, $user_query);
//   $user_id = mysqli_fetch_array($user_result);

//   $status = "Processing";
//   $adress = $_POST['adress'];
//   $postal_code = $_POST['postal-code'];
//   $email = $_POST['e-mail'];
//   $phone = $_POST['phone'];
//   $subtotal = 0;

//   // fetching subtotal
//   $cart_query = "SELECT product_id FROM cart_items WHERE user_id = '$username'";
//   $cart_result = mysqli_query($conn, $cart_query);

//   while ($cart_items = mysqli_fetch_array($cart_result)) {
//     $product_id = $cart_items['product_id'];
//     $product_query = "SELECT * FROM products WHERE id = '$product_id'";
//     $product_result = mysqli_query($conn, $product_query);
//     $product_info = mysqli_fetch_assoc($product_result);

//     $price = $product_info['price'];
//     $subtotal = $subtotal + $price;
//   }



//   $query = "INSERT INTO order_info (user_id, status, 
//     address, postal_code, email, phone_number, price)
//     VALUES ('$user_id[0]', '$status', '$adress', '$postal_code', 
//     '$email', '$phone', '$subtotal')";

//   if (mysqli_query($conn, $query)) {
//     echo "succes";
//   } else {
//     echo "Error";
//   }
// }


/* ALERT BOX */

// $delete_query = "DELETE FROM cart_items WHERE user_id = '$username'";

// if(mysqli_query($conn, $delete_query))
// {
// unset($_SESSION['cart']);
// }
