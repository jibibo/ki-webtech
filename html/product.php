<?php

include "user_session.php";

include "db_connect.php";

// rediret if "id" parameter is not set
if (!isset($_GET["id"])) {
  header("Location: products.php");
  exit;
}

// product-specific information
$product_id = htmlspecialchars($_GET["id"]);
if (!is_numeric($product_id)) {
  // redirect user to products.php if selected id is invalid
  header("Location: products.php");
  exit;
}
$result_product = mysqli_query(
  $conn,
  "SELECT * 
  FROM products 
  WHERE id=$product_id 
  LIMIT 1"
);

$product = mysqli_fetch_assoc($result_product);
if (!$product) {
  // redirect user to products.php if selected id does not exist
  header("Location: products.php");
  exit;
}
$product_name = $product["name"];
$product_description = $product["description"];
$product_image_url = $product["image_url"];
$product_price = number_format($product["price"], 2);

// product's categories
$result_categories = mysqli_query(
  $conn,
  "SELECT id, name
  FROM product_categories pc
  JOIN categories c ON pc.category=c.id 
  WHERE pc.product=$product_id"
);
$product_category_ids = array();
$product_categories = array();

while ($row = mysqli_fetch_assoc($result_categories)) {
  $product_category_ids[] = $row["id"];
  $product_categories[] = $row;
}

// related products: related to product by sharing a category
// src: https://stackoverflow.com/a/3919563/13216113
$category_array = join(",", $product_category_ids);
$related_products = array();

if (count($product_category_ids) > 0) {
  $result_related = mysqli_query(
    $conn,
    "SELECT DISTINCT id, name, price, image_url
    FROM product_categories pc
      JOIN products p ON pc.product=p.id
    WHERE pc.category IN ($category_array)
      AND p.id!=$product_id"
  );

  while ($row = mysqli_fetch_assoc($result_related)) {
    $related_products[] = $row;
  }
}

// customer reviews
$result_reviews = mysqli_query(
  $conn,
  "SELECT * 
  FROM product_reviews pr
  JOIN customers c ON pr.customer=c.id
  WHERE pr.product=$product_id"
);
$reviews = array();
while ($row = mysqli_fetch_assoc($result_reviews)) {
  $reviews[] = $row;
}

// product rating and review count
$result_rating = mysqli_query(
  $conn,
  "SELECT AVG(rating), COUNT(*)
  FROM product_reviews
  WHERE product=$product_id"
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
  <script src="js/clickCart.js"></script>
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
              echo <<<END
              <span class="stars">$rating</span> ($review_count review(s))
              END;
            } else {
              echo "No reviews yet!";
            }
            ?>
          </a>
        </span>

        <div class="shopping-btns">
          <!-- <form method="post">
            <button formaction="add_cart.php" class="cart-btn shopping-btn">+ Cart</button>
          </form> -->

          <!-- <div class="product-buttons">
                    <button class="product-cart">
                      <ion-icon name="cart-outline"></ion-icon>
                    </button>
                    <button class="product-wishlist">
                      <ion-icon name="heart-outline"></ion-icon>
                    </button>
                  </div> -->
          <button class="cart-btn shopping-btn"><ion-icon name="cart-outline"></ion-icon></button>
          <button class="wishlist-btn shopping-btn"><ion-icon name="heart-outline"></ion-icon></button>
        </div>

        <span class="description-label">description ―</span>
        <span class="description"><?php echo $product_description ?></span>

        <div class="categories">
          <?php
          foreach ($product_categories as $category) {
            $category_id = $category["id"];
            $category_name = $category["name"];

            echo <<<END
            <a href="products.php?search=&c[]=$category_id">$category_name</a>
            END;
          }
          ?>
        </div>

        <span class="product-id">(prod. nr.: <?php echo $product_id ?>)</span>
      </div>
    </div>

    <div class="related-products">
      <div class="related-products-header">
        <h2>Related products</h2>
      </div>
      <div class="related-products-list">

        <?php
        if ($related_products) {
          foreach ($related_products as $product) {
            $product_id = $product["id"];
            $product_img = $product["image_url"];
            $product_name = $product["name"];
            $product_price = number_format($product["price"], 2);
            echo <<<END
            <div class="product-list-item">
              <div class="product-img-wrapper">
                <a href="product.php?id=$product_id">
                  <img src="$product_img" />
                </a>
              </div>
              <div>
                <a class="product-name" href="product.php?id=$product_id">$product_name</a>
                <div class="product-details">
                  <span class="product-price">&euro; $product_price</span>
                  <div class="product-buttons">
                    <button class="product-cart">
                      <ion-icon name="cart-outline"></ion-icon>
                    </button>
                    <button class="product-wishlist">
                      <ion-icon name="heart-outline"></ion-icon>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            END;
          }
        } else {
          echo <<<END
          <h3><em>No related products</em></h3>
          END;
        }
        ?>

      </div>
    </div>

    <div class="product-reviews">
      <h2 class="reviews-header">Customer reviews</h2>

      <?php

      if ($user_session) {
        $product_id = htmlspecialchars($_GET["id"]);

        echo <<<END
        <div class="make-review padding">
          <form class="review-form" action="review.php" method="post">
            <input id="rating" type="number" name="rating" min="1" max="5" placeholder="★?" required />
            <input type="text" name="title" placeholder="Review title (optional)" />
            <input type="text" name="body" placeholder="Elaborate... (optional)" />
            <input type="hidden" name="product_id" value="$product_id" />
            <button type="submit">Submit review</button>
          </form>
        </div>
        END;
      } else {
        echo <<<END
        <div class="make-review">
          <div class="sign-in">Please sign in to submit a review</div>
        </div>
        END;
      }

      ?>

      <div class="customer-reviews" id="reviews">
        <?php
        if ($rating) {
          foreach ($reviews as $review) {
            $review_rating = $review["rating"];
            $review_title = $review["title"];
            $review_body = $review["body"];
            $review_author = $review["first_name"] . " " . $review["last_name"];

            echo <<<END
            <div class="review padding">
              <div class="review-top">
                <span class="review-rating">$review_rating ★</span>
                <span class="review-title">&quot;$review_title&quot;</span>
              </div>
              <p class="review-body">$review_body</p>
              <span class="review-author">― $review_author</span>
            </div>
            END;
          }
        } else {
          echo <<<END
          <div class="review">
            <div class="review-top">
              <span class="no-reviews">No reviews yet!</span>
            </div>
          END;
        }
        ?>

      </div>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>