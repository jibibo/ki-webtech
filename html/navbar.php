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
          <div class="dropdown-content">
            <!-- https://stackoverflow.com/questions/6243051/how-to-pass-an-array-within-a-query-string -->
            <a href="products.php?c[]=12&c[]=13">Kleding</a>
            <a href="products.php?c[]=2">Auto's</a>
            <a href="products.php?c[]=3">Schoenen</a>
          </div>
        </li>
        <li><a href="checkout.php">Checkout</a></li>
        <li><a href="session.php">Log in/out | Register</a></li>
        <li><a href="contact.php">Contact us</a></li>
        <li><a href="about.php">About us</a></li>
        <div class="search-wrapper">
          <form action="products.php" method="get">
            <input class="search-input" type="text" placeholder="Search products" name="search">
          </form>
        </div>
      </ul>
    </div>
  </div>
</nav>