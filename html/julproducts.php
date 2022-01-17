<?php

include "db_connect.php";

if ($_GET["search"]) {
  $name = htmlspecialchars($_GET["search"]);

  $query = "SELECT * FROM products WHERE name LIKE '%$name%'";
} else {
  $query = "SELECT * FROM products";
}

$result = mysqli_query($conn, $query);

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="css/julproducts.css" />

</head>

<body>
  <div class="container">
    <div class="products">

      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='product'>";
          echo "<img class='product-image' src='" . $row["image_url"] . "'/>";
          echo "<span class='product-name'>" . $row["name"] . "</span>";
          echo "<div class='product-details'>";
          echo "<span class='product-price'>&euro; " . $row["price"] . "</span>";
          echo "<button class='product-wishlist'>+ wishlist</button>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "No products";
      }

      ?>

    </div>
  </div>
</body>

</html>