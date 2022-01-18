<?php
include 'db_connect.php';

if (isset($_GET['id'])) {

    // Store id value from URL
    $id = $_GET['id'];

    // Query code
    $product_query = "SELECT * FROM products WHERE id = $id";
    $query2 = "SELECT image_url FROM products WHERE NOT id = $id AND category_id = 1";
    $review_query = "SELECT * FROM product_reviews WHERE product_id = $id LIMIT 10";

    // QPerform query on database
    $product_results = mysqli_query($conn, $product_query);
    $query_results2 = mysqli_query($conn, $query2);
    $review_query_results = mysqli_query($conn, $review_query);

    // Fetch results from query and store
    $products = mysqli_fetch_assoc($product_results);
    # $related_products = mysqli_fetch_assoc($query_results2);

    # print_r($related_products);

}

include "db_disconnect.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>philip products</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="css/philproducts.css" />

</head>

<body>
    <!-- <header> 
            <div class="banner">
                banner dingen
            </div>
        </header>
    -->
    <div class="product horizontal">
        <div class="product_image">
            <img src=<?php echo htmlspecialchars($products['image_url']); ?>>
        </div>
        <div class="product_specifications flex_container vertical">
            <div class="product_title">
                <h1> <?php echo htmlspecialchars($products['product_name']); ?></h1>
            </div>
            <div class="product horizontal order">
                <div class="product_price">
                    <h2> € <?php echo htmlspecialchars($products['price']); ?> </h2>
                </div>
                <div class="cart button">
                    <h2> Add to cart </h2>
                </div>
            </div>
            <div class="product_description">
                <h2> <?php echo htmlspecialchars($products['product_description']); ?></h2>
            </div>
        </div>
    </div>
    <div class="related_products product vertical">
        <h2> Related products </h2>
        <div class="images_related horizontal">

            <?php
            while ($product = mysqli_fetch_array($query_results2)) {
                $imgsrc = htmlspecialchars($product["image_src"]);
                echo "<img src='$imgsrc' class='product-img' />";
            }
            ?>

        </div>
    </div>

    <?php
    while ($reviews = mysqli_fetch_array($review_query_results)) {
        $review_user = htmlspecialchars($reviews["user_id"]);
        $review_title = htmlspecialchars($reviews["title"]);
        $review_rating = htmlspecialchars($reviews["rating"]);
        $review_body = htmlspecialchars($reviews["body"]);

        echo "<div class='reviews product vertical'>
        <table class='review-table'>
        <thead>
        <tr>
        <td rowspan='2'>$review_title</td>
        <td>$review_rating</td> 
        </tr>
        <tr>
        <td colspan='2'>$review_user</td>
        </tr>
        </thead>
        <tbody>
        <tr> 
        <td colspan='2' height='100' valign='top'>$review_body</td>
        </tr>
        </tbody>
        </table> 
        </div> ";
    }
    ?>

    </main>
</body>

</html>