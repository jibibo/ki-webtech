<?php

include "db_connect.php";
include "utils.php";

if (!isset($_GET["id"])) {
  header("Location: index.php");
}

$product_id = htmlspecialchars($_GET["id"]);

$result_product = mysqli_query(
  $conn,
  "SELECT * FROM products 
  WHERE id=$product_id 
  LIMIT 1"
);
$product = mysqli_fetch_assoc($result_product);
$product_name = $product["name"];
$product_description = $product["description"];
$product_price = number_format($product["price"], 2);

$result_categories = mysqli_query(
  $conn,
  "SELECT name 
  FROM product_categories 
  JOIN categories ON product_categories.category_id=categories.id 
  WHERE product_id=$product_id"
);
$categories = array();
while ($row = mysqli_fetch_assoc($result_categories)) {
  $categories[] = $row["name"];
}

$result_reviews = mysqli_query(
  $conn,
  "SELECT * 
  FROM product_reviews 
  JOIN customers ON product_reviews.customer_id=customers.id
  WHERE product_id=$product_id"
);
$reviews = array();
while ($row = mysqli_fetch_assoc($result_reviews)) {
  $reviews[] = $row;
}

$result_rating = mysqli_query(
  $conn,
  "SELECT AVG(rating), COUNT(*)
  FROM product_reviews
  WHERE product_id=$product_id"
);
$row = mysqli_fetch_assoc($result_rating);
$rating = round($row["AVG(rating)"], 1);
$review_count = $row["COUNT(*)"];

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo $product_name ?> | UvAzon</title>
  <link rel="stylesheet" href="css/product.css" />
</head>

<body>
  <div class="container">
    <div class="product-details padding">
      <div class="product-left">
        <img class="product-image" src="https://www.orangebag.nl/cache/gestuz-truien.541928/gestuz-truien-700-932.jpg" />
      </div>

      <div class="product-right padding">
        <h1 class="product-name"><?php echo $product_name ?></h1>
        <h2 class="product-price">&euro; <?php echo $product_price ?></h2>
        <a href="#reviews" class="rating-reviews">
          <span class="stars">
            <?php echo $rating ?> ★</span> (<?php echo $review_count ?> reviews)
        </a>

        <div class="shopping-btns">
          <button class="buy-btn shopping-btn">BUY NOW</button>
          <button class="cart-btn shopping-btn">+ Cart</button>
          <button class="wishlist-btn shopping-btn">+ Wishlist</button>
        </div>

        <span class="description-label">description ―</span>
        <span class="description"><?php echo $product_description ?></span>

        <div class="categories">
          <?php
          foreach ($categories as $category) {
            echo "
            <a href='products.php'>$category</a>
            ";
          }
          ?>
        </div>

        <span class="product-id">(prod. nr. 1)</span>
      </div>
    </div>

    <div class="product-reviews padding">
      <div class="make-review padding">
        <form class="review-form" action="review.php" method="GET">
          <label for="rating">Stars:</label>
          <input id="rating" type="number" name="rating" min="1" max="5">
          <textarea name="review" placeholder="Write us a review... (optional)"></textarea>
          <input type="submit" value="Submit review">
        </form>
      </div>

      <div class="customer-reviews" id="reviews">
        <?php
        foreach ($reviews as $review) {
          $review_rating = $review["rating"];
          $review_title = $review["title"];
          $review_body = $review["body"];
          $review_author = $review["first_name"] . " " . $review["last_name"];

          echo "
          <div class='review padding'>
            <div class='review-top'>
              <span class='review-rating'>$review_rating ★</span>
              <span class='review-title'>&quot;$review_title&quot;</span>
            </div>
            <p class='review-body'>$review_body</p>
            <span class='review-author'>― $review_author</span>
          </div>
          ";
        }
        ?>

        <div class="review padding">
          <div class="review-top">
            <span class="review-rating">[0] ★</span>
            <span class="review-title">"[review title]"</span>
          </div>
          <p class="review-body">[review body review body review body]</p>
          <span class="review-author">― [review author name]</span>
        </div>
      </div>
    </div>
  </div>
</body>

</html>