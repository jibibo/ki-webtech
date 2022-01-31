<?php

include "db_connect.php";

// if (!isset($_COOKIE["session_token"])) {
//   header("Location: /");
//   return;
// }

$session_token = htmlspecialchars($_COOKIE["session_token"]);

$result = mysqli_query($conn, "
  SELECT * FROM 
");

include "db_disconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/admin.css" />
</head>

<body>
  <?php include "navbar.php" ?>

  <div class="container">
    <h1>
      Admin page
    </h1>

    <h2>
      Add product
    </h2>

    <form action="admin.php" method="POST">
      <input type="text" name="name" placeholder="Name" autofocus />
      <textarea name="description" placeholder="Description"></textarea>
      <input type="number" name="price" step="0.01" placeholder="Price" />
      <input type="text" name="image_url" placeholder="Image (URL)" />
      <input type="text" name="categories" placeholder="Category IDs (1,2,3)" />
      <input type="submit" value="Add product" />
      <input type="hidden" name="action" value="add_product" />
    </form>

    <h2>
      Add category
    </h2>

    <!-- laat alleen "admin" op navbar zien als ingelogde user een admin is -->

    <div class="categories-list">

    </div>

    <form action="admin.php" method="POST">
      <input type="text" name="name" placeholder="name" autofocus />
      <input type="submit" value="Add category" />
      <input type="hidden" name="action" value="add_category" />
    </form>
  </div>

  <?php include "footer.php" ?>
</body>

</html>