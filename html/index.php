<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
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
    <div class="imagecontainer">
      <img src="https://www.rtlnieuws.nl/sites/default/files/content/images/2021/09/07/apple-event.png?itok=Zn29uG2Z&offsetX=0&offsetY=19&cropWidth=1978&cropHeight=1113&width=2048&height=1152&impolicy=dynamic" alt="Apple products" class="apple">
      <div class="text_center">Begin the year with Apple</div>
      <button><a href="https://webtech-ki15.webtech-uva.nl/products.php?search=&c%5B%5D=20" class="applelink">Go to collection</a></button>
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
            <img src="https://support.apple.com/library/content/dam/edam/applecare/images/en_US/macbookpro/macbook-pro-2021-14in.png" alt="Electronics" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Electronics</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://cdn.shopify.com/s/files/1/1862/4277/products/GlassScreenProtector_iPhone12Pro.jpg?v=1618431180" alt="Screenprotectors" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Screenprotectors</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://cdn.webshopapp.com/shops/256679/files/370778642/case2go-case2go-laptoptas-geschikt-voor-lenovo-thi.jpg" alt="Laptop bags" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Laptop bags</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://media.travelbags-cdn.nl/product-square-320/2580/image.jpg" alt="Bags" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shopshoes">Bags</a>
          </div>
        </div>
        <div class="column">
          <a href="">
            <img src="https://media.s-bol.com/Yo8RQV9NARO/1200x1199.jpg" alt="Office supplies" class="view">
          </a>
          <div class="imagelink">
            <a href="" class="shop">Office supplies</a>
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