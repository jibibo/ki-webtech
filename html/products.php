<?php

include "db_connect.php";

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>Products | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/products.css" />

</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="products">

      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
          $product_id = $product["id"];
          $product_img = $product["image_url"];
          $product_name = $product["name"];
          $product_price = number_format($product["price"], 2);
          echo "
          <div class='product-list-item'>
            <div class='product-img-wrapper'>
              <a href='product.php?id=$product_id'>
                <img src='$product_img' />
              </a>
            </div>
            <div>
              <a class='product-name' href='product.php?id=$product_id'>$product_name</a>
              <div class='product-details'>
                <span class='product-price'>&euro; $product_price</span>
                <div class='product-buttons'>
                  <button class='product-buy'>Buy</button>
                  <button class='product-cart'>cart</button>
                  <button class='product-wishlist'>Wishlist</button>
                </div>
              </div>
            </div>
          </div>
          ";
        }
      } else {
        echo "No products!";
      }

      ?>

      <!-- <div class='product-list-item'>
        <div class='product-img-wrapper'>
          <a href='product.php?id=$product_id'>
            <img src='https://www.automobielmanagement.nl/wp-content/uploads/2019/04/Lada-Combi-1600x1123.jpg' />
          </a>
        </div>
        <div>
          <a class='product-name' href='product.php?id=$product_id'>$product_name</a>
          <div class='product-details'>
            <span class='product-price'>&euro; $product_price</span>
            <div class='product-buttons'>
              <button class='product-buy'>Buy</button>
              <button class='product-cart'>Cart</button>
              <button class='product-wishlist'>Wishlist</button>
            </div>
          </div>
        </div>
      </div> -->

    </div>
  </div>

  <?php
  include "footer.php";
  ?>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>