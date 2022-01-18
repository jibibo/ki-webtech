<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UVAZON</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/footer.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet" />
  
</head>

<body>
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <img src="images/uvazone.png" alt="Uvazone logo" width="250px" />
      </div>
      <nav>
        <ul>
          <li><a class="currentpage" href="index.php">HOME</a></li>
          <li class="menu">
            <a href="javascript:void(0)" class="dropdown">PRODUCTS</a>
            <div class="content">
              <a href="">Clothing</a>
              <a href="">Shoes</a>
              <a href="">Cosmetics</a>
            </div>
          </li>
          <li><a href="about.html">ABOUT US</a></li>
          <li><a href="checkout.html">CHECKOUT</a></li>
          <li><a href="login.html">LOG-IN/REGISTRER</a></li>
          <li><a href="contact.php">CONTACT</a></li>

          <div class="searchbar"> 
              <form action="">
                <div class="textbar">
                  <input type="text" placeholder="Search for..." name="search">
                </div>
                <button type="submit" class="searchbutton">
                  <span class="icon">
                    <ion-icon name="search-outline"></ion-icon>
                  </span>
                </button>
              </form>
          </div> 
        </ul>
      </nav>
    </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <div class="filler"></div>

  <?php
  include "footer.php";
  ?>
</body>

</html>