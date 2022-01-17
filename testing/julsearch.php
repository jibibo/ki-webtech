<?php

include "db_connect.php";

if ($_GET["name"]) {
  echo "Name set<br>";

  $name = $_GET["name"];

  $query = "SELECT name, price, image FROM products WHERE name='$name'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "Product: " . $row["name"] . " with price: " . $row["price"] . "<img src='" . $row["image"] . "' />" . "<br>";
    }
  } else {
    echo "No results<br>";
  }
} else {
  echo "Name not set<br>";
}

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>search</title>
</head>

<body>
  <form action="/julsearch.php" method="GET">
    <input type="text" name="name" placeholder="product name" />
    <input type="submit" value="SEARCH" />
  </form>
</body>

</html>