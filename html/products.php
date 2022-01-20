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
          $product_image_url = $product["image_url"];
          $product_name = $product["name"];
          $product_price = number_format($product["price"], 2);
          echo "
          <div class='product'>
            <a href='product.php?id=$product_id'>
              <img class='product-image' src='$product_image_url'/>
            </a>
            <span class='product-name'>$product_name</span>
            <div class='product-details'>
              <span class='product-price'>&euro; $product_price</span>
              <button class='product-buy'>Buy!</button>
            </div>
          </div>
          ";
        }
      } else {
        echo "No products!";
      }

      ?>

      

    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>