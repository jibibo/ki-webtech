<nav>
  <div class="container-logo">
    <a href="/">
      <div class="logo">
        <img src="images/uvazon.png" alt="UvAzon Logo" width="250px" />
      </div>
    </a>
    <div class="sticky">
      <ul id="nav-ul">
        <li><a href="/">Home</a></li>
        <li class="dropdown-menu">
          <a href="products.php" class="dropdown-button">Products</a>
        </li>

        <?php
        // update cart count tally on page load
        $count = 0;
        if (isset($_COOKIE["cart"])) {
          // split cookie string
          $products_in_cart = explode("|", $_COOKIE["cart"]);

          if ($products_in_cart[0] == "") {
            // if element [0] is an empty string after clearing cookie, set empty array
            $products_in_cart = array();
          }

          $count = count($products_in_cart);
        }
        ?>

        <li><a href="checkout.php" id="navbar-checkout"><?php echo "Checkout ($count)" ?></a></li>
        <li><a href="contact.php">Contact us</a></li>
        <li><a href="about.php">About us</a></li>

        <?php
        if (!isset($_COOKIE["session_token"])) {
          echo <<<END
          <li><a href="session.php">Log-in / Register</a></li>
          END;
        }

        if (isset($_COOKIE["session_token"])) {
          echo <<<END
          <li>
            <form action="session.php" method="post">
              <input type="hidden" name="in_out" value="out" />
              <button class="logoutbutton" type="submit" title="Log out">Log out</button>
            </form>
          </li>
          END;
        }
        ?>

        <div class="search-wrapper">
          <form action="products.php" method="get">
            <input class="search-input" type="text" placeholder="Search products" name="search">
          </form>
        </div>
      </ul>
    </div>
  </div>
</nav>
