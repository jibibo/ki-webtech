<?php

include "db_connect.php";
include "utils.php";

// rediret if "id" parameter is not set
if (!isset($_GET["id"])) {
  header("Location: products.php");
}

$product_id = htmlspecialchars($_GET["id"]);


$result_product = mysqli_query(
  $conn,
  "SELECT * 
  FROM products 
  WHERE id=$product_id 
  LIMIT 1"
);
$product = mysqli_fetch_assoc($result_product);
$product_name = $product["name"];
$product_description = $product["description"];
$product_image_url = $product["image_url"];
$product_price = number_format($product["price"], 2);


$result_categories = mysqli_query(
  $conn,
  "SELECT name, id
  FROM product_categories pc
  JOIN categories c ON pc.category_id=c.id 
  WHERE product_id=$product_id"
);
$categories = array();
$related_ids_array = array();
$related_products_array = array();
while ($row = mysqli_fetch_assoc($result_categories)) {
  $categories[] = $row;
  $category_id = $row["id"];

  $result_related = mysqli_query(
    $conn,
    "SELECT product_id, name
    FROM product_categories pc
    JOIN products p ON pc.product_id=p.id
    WHERE category_id=$category_id AND p.id!=$product_id"
  );

  while ($row = mysqli_fetch_assoc($result_related)) {
    $related_products_array[] = $row;
    $related_ids_array[] = $row["product_id"];
  }
}

// src: https://stackoverflow.com/questions/30626785/php-most-frequent-value-in-array
$product_occurences = array_count_values($related_ids_array);
arsort($product_occurences);
$top_5_related = array_slice(array_keys($product_occurences), 0, 5, true);


$result_reviews = mysqli_query(
  $conn,
  "SELECT * 
  FROM product_reviews pr
  JOIN customers c ON pr.customer_id=c.id
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
// this query only returns 1 row, containing AVG and COUNT
$row = mysqli_fetch_assoc($result_rating);
$review_count = $row["COUNT(*)"];
if ($review_count > 0) {
  $rating = round($row["AVG(rating)"], 1) . " / 5 ★";
} else {
  $rating = false;
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo $product_name ?> | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/product.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="product-details">
      <div class="product-left padding">
        <img class="product-image" src="<?php echo $product_image_url ?>" />
      </div>

      <div class="product-right padding">
        <h1 class="product-name"><?php echo $product_name ?></h1>
        <h2 class="product-price">&euro; <?php echo $product_price ?></h2>

        <span class="rating-reviews">
          <a href="#reviews">
            <?php
            if ($rating) {
              echo "
              <span class='stars'>$rating</span>
              ($review_count reviews)
              ";
            } else {
              echo "No reviews yet!";
            }
            ?>
          </a>
        </span>

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
            $category_name = $category["name"];

            echo "
            <a href='products.php'>$category_name</a>
            ";
          }
          ?>
          <a href="products.php">[category name]</a>
        </div>

        <span class="product-id">(prod. nr. <?php echo $product_id ?>)</span>
      </div>
    </div>

    <div class="related-products">
      <div class="related-products-header">
        <span>TODO Related products</span>
      </div>
      <div class="related-products-content">
        <?php
        foreach ($top_5_related as $related_id) {
          // todo HERHAAL CODE VAN products.php
          echo "
          <div class='product'>
            [product id $related_id]
          </div>
          ";
        }
        ?>

        <div class="product">
          [test]
        </div>
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
        if ($rating) {
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
        } else {
          echo "
          <div class='review'>
            <div class='review-top'>
              <span class='no-reviews'>No reviews yet!</span>
            </div>
          </div>";
        }
        ?>

        <div class="review padding">
          <div class="review-top">
            <span class="review-rating">[review rating]</span>
            <span class="review-title">"[review title]"</span>
          </div>
          <p class="review-body">[review body review body review body]</p>
          <span class="review-author">― [review author name]</span>
        </div>
      </div>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>