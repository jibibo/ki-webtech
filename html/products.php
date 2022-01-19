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
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/products.css" />
</head>

<body>
  <div class="container">
    <div class="products">

      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
          $product_image_url = $product["image_url"];
          $product_name = $product["name"];
          $product_price = number_format($product["price"], 2);
          echo "
          <div class='product'>
            <img class='product-image' src='$product_image_url'/>
            <span class='product-name'>$product_name</span>
            <div class='product-details'>
              <span class='product-price'>&euro; $product_price</span>
              <button class='product-wishlist'>+ wishlist</button>
            </div>
          </div>
          ";
        }
      } else {
        echo "No products!";
      }

      ?>

      <div class="product">
        <img src="https://www.automobielmanagement.nl/wp-content/uploads/2019/04/Lada-Combi-1600x1123.jpg" />
        <span class="product-name">[product name]</span>
        <div class="product-details">
          <span class="product-price">&euro; [product price]]</span>
          <button class="product-wishlist">+ wishlist</button>
        </div>
      </div>

      <div class="product">
        <div class="product-left">
          <img src="https://www.automobielmanagement.nl/wp-content/uploads/2019/04/Lada-Combi-1600x1123.jpg" />

        </div>
        <div class="product-right">
          <span class="product-name">[product name]</span>

        </div>
      </div>
    </div>
  </div>
</body>

</html>