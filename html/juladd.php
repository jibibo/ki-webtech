<?php

include "db_connect.php";


if (isset($_GET["name"])) {
  $name = htmlspecialchars($_GET["name"]);
  $description = htmlspecialchars($_GET["description"]);
  $price = htmlspecialchars($_GET["price"]);
  $image_url = htmlspecialchars($_GET["image_url"]);

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
  <form action="/juladd.php" method="GET">
    <input type="text" name="name" placeholder="name" autofocus/>
    <textarea name="description" placeholder="description"></textarea>
    <input type="number" name="price" placeholder="price" />
    <input type="text" name="image_url" placeholder="image url" />
    <input type="submit" value="ADD" />
  </form>
</body>

</html>