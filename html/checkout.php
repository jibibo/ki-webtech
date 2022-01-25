<?php 

include "db_connect.php";
# include "cookies.php";
session_start();


$username = $_SESSION["username"];

$user_query = "SELECT id FROM customers WHERE email = '$username'";
$user_result = mysqli_query($conn, $user_query);
$user_id = mysqli_fetch_array($user_result);


$cart_query = "SELECT product_id FROM cart_item WHERE cart_id = '$user_id[0]'";
$cart_result = mysqli_query($conn, $cart_query);
$rows = mysqli_num_rows($cart_result);


/*
$product_query = "SELECT * FROM products WHERE id = $product_id";
$product_result = mysqli_query($conn, $product_query);
$product_info = mysqli_fetch_assoc($product_result);
*/


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Checkout | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/checkout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&amp;display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="col-container">
    <div class="shipping-info">
      <h2 class="bottom">Shipping information </h2>
      <form>
        <label for="first-name">First name</label>
        <input type="text" id="first-name" placeholder=""><br>
        <label for="last-name">Last name</label>
        <input type="text" id="last-name" placeholder=""><br>

        <label for="adress">Street name and house number</label>
        <input type="text" id="adress" placeholder=><br>
        <label for="postal-code">Postal code</label>
        <input type="text" id="postal-code" placeholder=""><br>
      </form>
      <div class="contact-info">
        <h2 class="bottom">Contact information </h2>
        <form>
          <label for="e-mail">E-mail adress</label>
          <input type="text" id="e-mail" placeholder="">
          <label for="phone">Phone number</label>
          <input type="text" id="phone" placeholder="">
          <label><input type="checkbox" id="save-account"> Make an account for faster checkout</label>
          <label><input type="checkbox" id="agree-tos"> I agree to the <a href="#">Terms of Service</a></label>
          <div class="payment">
            <input type="submit" value="Continue to payment">
          </div>
        </form>
      </div>
    </div>

    <div class="cart">
      <div class="cart-container">
        <h2 class="bottom">Cart</h2>
        <div class="order-info">
          <table>
            <?php 
            if($rows === 0) {
              echo
              "
              <tr>
                <td><h3>Nothing added to cart yet</h3></td>
              </tr>
              ";
            } 
            else {
              while($cart_items = mysqli_fetch_array($cart_result)) {
                
                $product_id = $cart_items['product_id'];
                $product_query = "SELECT * FROM products WHERE id = '$product_id'";
                $product_result = mysqli_query($conn, $product_query);
                $product_info = mysqli_fetch_assoc($product_result);

                $product_name = $product_info['name'];
                $image_url = $product_info['image_url'];
                $price = $product_info['price'];
                $subtotal = $subtotal + $price;

                echo 
                "
                <tr>
                  <td>
                  <img src=$image_url width=100px height=100px>
                  </td>
                  <td>
                    <h3>$product_name</h3>
                  </td>
                  <td class='left'>
                    <h3> €$price</h3>
                  </td>
                </tr>
                ";
              }
          }              
          ?>
          <!--
            <tr>
              <td>
                <h3>Product name 1</h3>
              </td>
              <td class="left">
                <h3> €10 </h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Product name 2</h3>
              </td>
              <td class="left">
                <h3> €10 </h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Product name 3</h3>
              </td>
              <td class="left">
                <h3> €10 </h3>
              </td>
            </tr>
          -->
          <?php 
          if ($rows > 0) {
            echo 
            "
            <tr>
              <tfoot>
                <td>
                  <h3>Subtotal:</h3>
                </td>
                <td class='left'>
                  <h3>€$subtotal</h3>
                </td>
              </tfoot>
            </tr>
            ";
          }
          ?>
            

          </table>
        </div>
      </div>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>