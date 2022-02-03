<?php

include "user_session.php";

$cart_ids = array();

// check if cart cookie is set and put products id in array
if (isset($_COOKIE["cart"])) {
  $cartcookie = htmlspecialchars($_COOKIE["cart"]);
  $cart_ids = explode("|", $cartcookie);
}

$cart_count = count($cart_ids);
$subtotal = 0;

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
  <script src="js/removeCartItems.js" type="text/javascript"></script>
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="col-container">
    <div class="shipping-info">
      <h2 class="bottom">Shipping information </h2>
      <form id="order-form" action="order.php" method="post">
        <label for="first-name">First name</label>
        <input type="text" name="first_name" required value="<?php if ($user_session) echo $user_session["first_name"] ?>"><br>
        <label for="last-name">Last name</label>
        <input type="text" name="last_name" required value="<?php if ($user_session) echo $user_session["last_name"] ?>"><br>

        <label for="adress">Street name and house number</label>
        <input type="text" name="address" required value="<?php if ($user_session) echo $user_session["address"] ?>"><br>
        <label for="postal-code">Postal code</label>
        <input type="text" name="zip" required value="<?php if ($user_session) echo $user_session["zip"] ?>"><br>
        <label for="country">Country</label>
        <input type="text" name="country" required value="<?php if ($user_session) echo $user_session["country"] ?>"><br>

        <div class="contact-info">
          <h2 class="bottom">Contact information </h2>
          <label for="e-mail">E-mail adress</label>
          <input type="text" name="email" required value="<?php if ($user_session) echo $user_session["email"] ?>">
          <label for="phone">Phone number</label>
          <input type="text" name="phonenumber" required value="<?php if ($user_session) echo $user_session["phonenumber"] ?>">
          <label><input type="checkbox" id="agree-tos" required> I agree to the <a href="terms.php">Terms of Service</a></label>
          <div class="payment">
            <input type="submit" value="Buy now" />
          </div>
        </div>
      </form>
    </div>

    <div class="cart">
      <div class="cart-container">
        <h2 class="bottom">Cart</h2>
        <?php

        if ($cart_count) {
          echo $cart_count;
          // we have items in our cart, so give the user the option to remove
          echo <<<END
          <div class="remove-cart-button">
            <button onclick="removeCartItems()">Empty your cart</button>
          </div>
          END;
        }

        ?>
        <div class="order-info">
          <table>
            <?php
            include "db_connect.php";

            if (!$cart_count) {
              echo <<<END
              <tr>
                <td><h3>Nothing added to cart yet</h3></td>
              </tr>
              END;
            } else {
              foreach ($cart_ids as $product_id_str) {
                // product id is not numeric
                if (!is_numeric($product_id_str)) {
                  continue;
                }

                $product_id = intval($product_id_str);

                // get product info
                $product_result = mysqli_query(
                  $conn,
                  "SELECT * FROM products WHERE id=$product_id LIMIT 1"
                );

                // product id doesnt exist
                if (!$product_result) {
                  continue;
                }

                $product = mysqli_fetch_assoc($product_result);
                $product_name = $product["name"];
                $product_price = $product["price"];
                $product_image = $product["image_url"];
                $subtotal = $subtotal + $product_price;

                echo <<<END
                <tr>
                  <td>
                    <img src="$product_image" width="100px" height="100px">
                  </td>
                  <td>
                    <h3>$product_name</h3>
                  </td>
                  <td class="left">
                    <h3>€ $product_price</h3>
                  </td>
                </tr>
                END;
              }
            }

            if ($cart_count) {
              echo <<<END
              <tr>
                <tfoot>
                  <td>
                    <h3>Subtotal:</h3>
                  </td>
                  <td class="left">
                    <h3>€ $subtotal</h3>
                  </td>
                </tfoot>
              </tr>
              END;
            }

            include "db_disconnect.php";

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