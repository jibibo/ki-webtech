<?php

include "db_connect.php";


if (isset($_POST["name"])) {
  $auth = htmlspecialchars($_POST["auth"]);

  if ($auth != $authorization_code) {
    echo "Invalid auth code";
    return;
  }

  $name = htmlspecialchars($_POST["name"]);
  $description = htmlspecialchars($_POST["description"]);
  $price = htmlspecialchars($_POST["price"]);
  $image_url = htmlspecialchars($_POST["image_url"]);

  $query = "INSERT INTO products (name, description, price, image_url) 
    VALUES ('$name', '$description', $price, '$image_url')";

  if (mysqli_query($conn, $query)) {
    echo "Added product: $name <br>";
  } else {
    echo "Adding failed" . mysqli_error($conn);
  }
} else {
  echo "Name not set<br>";
}

include "db_disconnect.php"

?>

<!DOCTYPE html>
<html>

<head>
  <title>add product</title>
</head>

<body>
  <p>add product</p>
  <h4><a href="add_product.php">reload page</a></h4>
  <form action="/add_product.php" method="POST">
    <input type="text" name="name" placeholder="name" autofocus />
    <textarea name="description" placeholder="description"></textarea>
    <input type="number" name="price" placeholder="price" />
    <input type="text" name="image_url" placeholder="image url" />
    <input type="text" name="auth" placeholder="auth" value="<?php echo $authorization_code ?>" />
    <input type="submit" value="ADD" />
  </form>
</body>

</html>