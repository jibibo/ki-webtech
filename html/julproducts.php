<?php

include "db_connect.php";

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>jul products</title>
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="css/julproducts.css" />

</head>

<body>
  <div class="container">
    <div class="products">

      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
          <div class='product'>
            <img class='product-image' src='" . $row["image_url"] . "'/>
            <span class='product-name'>" . $row["name"] . "</span>
            <div class='product-details'>
              <span class='product-price'>&euro; " . $row["price"] . "</span>
              <button class='product-wishlist'>+ wishlist</button>
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
</body>

</html>