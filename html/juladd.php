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
echo "Conn closed<br>";
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
