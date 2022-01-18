<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>UVAZON</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <link rel="stylesheet" href="css/index.css" />
        <link rel="stylesheet" href="css/login.css" />
        <link rel="stylesheet" href="css/footer.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="navbar">
            <div class="logo">
              <img src="images/uvazone.png" width="250px">
            </div>
            <nav>
              <ul>
                <li><a href="index.php">HOME</a></li>
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
                <li><a class="currentpage" href="newlogin.html">LOG-IN/REGISTRER</a></li>
                <li><a href="contact.php">CONTACT</a></li>
              </ul>
            </nav>
            </div>

            <div class="form">
            <form action="" class="formscreen">
                <div class="title">LOGIN</div>

                <div class="textbox">
                    <input type="text" placeholder="Username" name="username" required>
                    <br><br>

                    <input type="password" placeholder="Password" name="pww" required>
                    <br><br>
                </div>

                <div>
                    <button type="submit" class="login" title="Login">Login</button> 
                    <p>Forgotten your <a class="text" href="password.html">password?</a></p>
                    <p>Not a member yet? Click here to <a class="text" href="register.html">register!</a></p>
                </div>
            </form>
            </div>
            <div class="searchbar">
              <form action="">
                <div class="textbar">
                  <input type="text" placeholder="Search for..." name="search">
                  <button type="submit" class="searchbutton">
                    <span class="icon">
                      <ion-icon name="search-outline"></ion-icon>
                    </span>
                  </button>
                </div>
              </form>
            </div>
        </div>
        <?php
        include "footer.php";
        ?>
    
    </body>
</html>