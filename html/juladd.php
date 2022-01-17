<?php

include "connect.php";


if ($_GET["name"]) {
  echo "Name set<br>";

  $name = $_GET["name"];
  $price = $_GET["price"];
  $image = $_GET["image"];

  $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
  if (mysqli_query($conn, $query)) {
    echo "Added product: $name <br>";
  } else {
    echo "Adding failed" . mysqli_error($conn);
  }
} else {
  echo "Name not set<br>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <title>localhost</title>
</head>

<body>
  <form action="/juladd.php" method="GET">
    <input type="text" name="name" placeholder="product name" />
    <input type="number" name="price" placeholder="price" />
    <input type="text" name="image" placeholder="image url" />
    <input type="submit" value="ADD" />
  </form>
</body>

</html>