<?php

include "user_session.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <div class="container">
    <?php

    if ($user_session) {
      $first_name = $user_session["first_name"];
      echo <<<END
      <h2>Signed in as $first_name</h2>
      END;
    }

    ?>

    <div class="imagecontainer">
      <span class="headertext">Begin the year with Nike</span>
      <img src="https://theplaybook.asia/wp-content/uploads/sites/27/2019/06/cropped-sale_malaysia_nike_com.png" alt="Nike sale" class="nike">
      <button><a href="" class="nikelink">Go to collection</a></button>
    </div>

    <div class="beautycontainer">
      <span class="headertext">Beauty Bestsellers</span>
      <div class="beautyrow">
        <div class="picture">
          <a href="">
            <img src="https://images-na.ssl-images-amazon.com/images/I/71OK6VII-lL._SL1500_.jpg" alt="Fenty eyeshadow palette" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://i0.wp.com/angelteam.biz/wp-content/uploads/2019/06/s2113033-main-zoom.jpg?fit=2000%2C2000&ssl=1" alt="Fenty highlighter" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://shielabeautyworld.com/wp-content/uploads/2020/03/sweet-mouth.png" alt="Fenty lip gloss" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://cdn11.bigcommerce.com/s-h0vxbu2ww9/images/stencil/500x500/products/2696/6282/5602__29379.1575033839.jpg?c=2" alt="Laneige lip balm" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://cdn.webshopapp.com/shops/243452/files/323036432/image.jpg" alt="Belif eye cream" class="hover">
          </a>
        </div>
      </div>
    </div>

    <div class="trendingcontainer">
      <span class="headertext">Trending</span>
      <div class="trending">
        <div class="picture">
          <a href="">
            <img src="https://m.media-amazon.com/images/I/81DN5b9LvKL._SX466_.jpg" alt="PS5 spider-man game" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://dyson-h.assetsadobe2.com/is/image/content/dam/dyson/leap-petite-global/shop/Shop-all-page-Hero.jpg?$responsive$&cropPathE=mobile&fit=stretch,1&fmt=pjpeg&wid=640" alt="Dyson airwrap" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MWP22?wid=1144&hei=1144&fmt=jpeg&qlt=80&.v=1591634795000" alt="Apple airpods" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://media.direct.playstation.com/is/image/sierialto/PS5-front-with-dualsense" alt="PS5" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://www.safehome.org/app/uploads/2018/12/Ring-Doorbell-Camera.jpg" alt="Ring camera" class="hover">
          </a>
        </div>
      </div>
    </div>

    <div class="categorycontainer">
      <span class="headertext">Categories</span>
      <div class="category">
        <div class="column">
          <a href="">
            <img src="https://static.iphoned.nl/orca/products/9009/apple-macbook-pro-2021.png" alt="Electronics" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Electronics</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://fashionista.com/.image/t_share/MTQ5ODI4NDYxNzUyNDk0MDQz/fenty-beauty-by-rihanna-group-shot.jpg" alt="Cosmetics" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Cosmetics</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://photos.queens.cz/queens/2020-03/large/daily-paper-alias-hoodie-100039_1.jpg" alt="Clothing" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Clothing</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://static.nike.com/a/images/t_prod_ss/w_960,c_limit,f_auto/35d7eef5-0dbd-4d37-bc3b-f977ca87a8e7/air-jordan-1-bordeaux-555088-611-release-date.jpg" alt="Shoes" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shopshoes">Shoes</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://www.volvocars.com/images/v/-/media/project/contentplatform/data/media/my23/homepage/homepage-gallery-01-1x1.jpg?h=1080&iar=0&w=1080" alt="Cars" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Cars</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>