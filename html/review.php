<?php

include "redirect_http.php";

include "user_session.php";

// if user is not logged in, redirect to homepage
if (!$user_session) {
  header("Location: /");
  exit;
}

include "db_connect.php";

if (isset($_POST["rating"])) {
  $rating_raw = htmlspecialchars($_POST["rating"]);
  if (!is_numeric($rating_raw)) {
    // rating is not int
    header("Location: /");
    exit;
  }

  $rating = intval($rating_raw);

  if (!is_int($rating) || $rating < 1 || $rating > 5) {
    // invalid rating value, back to homepage
    header("Location: /");
    exit;
  }

  $review = null;

  // check if review is provided (otherwise it will be null)
  if (isset($_POST["review"])) {
    $review = htmlspecialchars($_POST["review"]);
  }

  // get product id
  $product_id_raw = htmlspecialchars($_POST["product_id"]);
  if (!is_numeric($product_id_raw)) {
    // invalid product id, back to homepage
    header("Location: /");
    exit;
  }

  $product_id = intval($product_id_raw);

  // get logged in user's id
  $customer_id = $user_session["id"];

  $product_exists_result = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id=$product_id"
  );

  if (!$product_exists_result) {
    // product does not exist (anymore), back to homepage
    header("Location: /");
    exit;
  }

  $title = htmlspecialchars($_POST["title"]);
  $body = htmlspecialchars($_POST["body"]);

  // insert review into db
  mysqli_query(
    $conn,
    "INSERT INTO product_reviews (customer, product, rating, title, body) 
    VALUES ($customer_id, $product_id, $rating, '$title', '$body')"
  );
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/review.css" />
</head>

<body>

  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <h2>Thank you for submiting a review!</h2>
    <div>
      <a href="products.php">Click here to go back to our products</a>
    </div>
  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>