<?php

include "db_connect.php";


if (isset($_POST["name"])) {
  $auth = htmlspecialchars($_POST["auth"]);

  if ($auth != $authorization_code) {
    echo "Invalid auth code";
    return;
  }

  $name = htmlspecialchars($_POST["name"]);

  $query = "INSERT INTO categories (name) 
    VALUES ('$name')";

  if (mysqli_query($conn, $query)) {
    echo "Added category: $name <br>";
  } else {
    echo "Adding category failed" . mysqli_error($conn);
  }
} else {
  echo "Name not set<br>";
}

$query = "SELECT name FROM categories";
$result = mysqli_query($conn, $query);
pre_print($result);

include "db_disconnect.php"

?>

<!DOCTYPE html>
<html>

<head>
  <title>add category</title>
</head>

<body>
  <p>add category</p>
  <h4><a href="add_category.php">reload page</a></h4>
  <form action="add_category.php" method="POST">
    <input type="text" name="name" placeholder="name" autofocus />
    <input type="text" name="auth" placeholder="auth" />
    <input type="submit" value="ADD" />
  </form>
</body>

</html>