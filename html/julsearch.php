<?php
// login info
$servername = "localhost";
$username = "webaccess";
$password = "123";
$database = "uvazon";
// Create and check connection
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn) {
  echo "Conn ok<br>";
} else {
  echo "Conn failed<br>";
  die("Connection failed: " . mysqli_connect_error());
}

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

mysqli_close($conn);
echo "Conn closed<br>";
?>

<!DOCTYPE html>
<html>

<head>
  <title>localhost</title>
</head>

<body>
  <form action="/julsearch.php" method="GET">
    <input type="text" name="name" placeholder="product name" />
    <input type="submit" value="SEARCH" />
  </form>
</body>

</html>