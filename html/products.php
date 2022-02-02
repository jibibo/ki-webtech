<?php

include "db_connect.php";
include "utils.php";

// src: https://stackoverflow.com/a/6324360/13216113
$result_categories = mysqli_query(
  $conn,
  "SELECT name, id, COUNT(*) 
  FROM categories c 
    JOIN product_categories pc ON c.id=pc.category 
  GROUP BY c.name 
  ORDER BY COUNT(*) DESC, c.name;"
);
$categories = array();
while ($row = mysqli_fetch_assoc($result_categories)) {
  $categories[] = $row;
}

// src: https://stackoverflow.com/a/1222248/13216113
$categories_checked = array();
foreach ($_GET as $key => $values) {
  if ($key != "c" || !is_array($values)) {
    continue;
  }

  foreach ($values as $category_raw) {
    // src: https://www.w3schools.com/php/func_var_is_numeric.asp
    if (!is_numeric($category_raw)) {
      continue;
    }

    $category_id = intval($category_raw);
    if (!is_int($category_id)) {
      continue;
    }

    $categories_checked[] = $category_id;
  }
}

if (isset($_GET["search"])) {
  $categories_join = join(",", $categories_checked);
  $search = htmlspecialchars($_GET["search"]);

  if ($categories_join) {
    if ($search) {
      // src: https://stackoverflow.com/a/16082874/13216113
      $products_query = "SELECT *
        FROM products p 
          JOIN product_categories pc ON p.id=pc.product 
        WHERE pc.category IN ($categories_join)
          AND LOWER(p.name) LIKE LOWER('%$search%');";
    } else {
      $products_query = "SELECT *
      FROM products p 
        JOIN product_categories pc ON p.id=pc.product 
      WHERE pc.category IN ($categories_join);";
    }
  } else {
    if ($search) {
      $products_query = "SELECT *
        FROM products p 
          JOIN product_categories pc ON p.id=pc.product 
        WHERE LOWER(p.name) LIKE LOWER('%$search%');";
    } else {
      $products_query = "SELECT * FROM products;";
    }
  }
} else {
  $products_query = "SELECT * FROM products;";
}

$products_result = mysqli_query($conn, $products_query);
$products_count = mysqli_num_rows($products_result);
$products = array();
while ($row = mysqli_fetch_assoc($products_result)) {
  $products[] = $row;
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>Products | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/products.css" />
  <script src="js/clickCart.js"></script>
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <div class="products-left">
      <form action="products.php" method="GET" id="search-form">

        <input id="search-input" type="text" placeholder="Search" name="search" />

        <div class="category-checkboxes">
          <?php

          if (count($categories) > 0) {
            foreach ($categories as $category) {
              $category_name = $category["name"];
              $category_id = $category["id"];
              $category_count = $category["COUNT(*)"];
              $category_checked = "";

              if (in_array($category_id, $categories_checked)) {
                $category_checked = "checked";
              }

              echo <<<END
              <div class="category-checkbox">
                <input type="checkbox" name="c[]" value="$category_id" id="$category_id" $category_checked/>
                <label for="$category_id">$category_name ($category_count)</label>
              </div>
              END;
            }
          } else {
            echo <<<END
            <div class="no-categories">
              <span>No categories!</span>
            </div>
            END;
          }

          ?>
        </div>

        <button type="submit">Search!</button>
      </form>
    </div>

    <div class="products-right">

      <?php

      if (
        (isset($_GET["search"]) && $_GET["search"]) || (isset($_GET["c"]) && $_GET["c"])
      ) {
        echo <<<END
        <span>$products_count product(s) found</span>
        END;
      }

      ?>

      <div class="product-list">

        <?php

        if ($products_count > 0) {
          foreach ($products as $product) {
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
                    <button class="product-cart" onclick="clickCart($product_id)">
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
          echo "No products found!";
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