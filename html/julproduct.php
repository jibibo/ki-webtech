<?php

include "db_connect.php";

if (isset($_GET["id"])) {
  $selected_id = true;

  $id = htmlspecialchars($_GET["id"]);

  $q_product = "SELECT * FROM products WHERE id=$id LIMIT 1";
  $q_categories = "SELECT category_id 
  FROM product_categories JOIN categories ON product_categories.category_id=categories.id 
  WHERE product_id=$id";

  $r_product = mysqli_query($conn, $q_product);
  $product = mysqli_fetch_array($r_product);
  $r_categories = mysqli_query($conn, $q_categories);
} else {
  $r_product = false;
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>jul view product</title>
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="css/julproduct.css" />
</head>

<body>
  <div class="container">
    <div class="product-details padding">
      <div class="product-left padding">
        <img class='product-image' src='https://www.orangebag.nl/cache/gestuz-truien.541928/gestuz-truien-700-932.jpg' />
      </div>

      <div class="product-right padding">
        <h1 class='product-name'>Naam</h1>
        <h2 class='product-price'>&euro; 20</h2>

        <div class="shopping-buttons padding">
          <button class="cart-button shopping-button">Add to cart</button>
          <button class="wishlist-button shopping-button">+ wishlist</button>
        </div>

        <span class="rating">8 / 10</span>
        <p class="description">asdfij asdifjas dio fjasid fjsado ifjsdaoasdijf aisdf jasdoif jsaodfj asod fijasd ofijasd foiji fjasdi jasdfoijsadoi jdasof jdsa o</p>
        
        <div class="categories">
          <span class="category">kleding</span>
          <span class="category">coole kleding</span>
          <span class="category">auto kleding</span>
        </div>
      </div>
    </div>

    <div class="product-reviews">
      <div class="submit-review">
        <form action="review.php" method="GET">
          <input type="number" name="rating" min="1" max="10" />
          <textarea name="review"></textarea>
          <input type="submit">
        </form>
      </div>

      <div class="customer-reviews">
        <div class="review">
          <span class="review-rating">8 / 10</span>
          <span class="review-title">amazing</span>
          <p class="review-body">amazing amazing amazing amazing amazing amazing amazing amazing </p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<!-- <?php

      if ($r_product) {
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
      } else {
        echo "Product not found";
      }

      ?> -->