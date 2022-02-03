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
      <span class="headertext">Apple Bestsellers</span>
      <div class="beautyrow">
        <div class="picture">
          <a href="">
            <img src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MWP22?wid=1144&hei=1144&fmt=jpeg&qlt=80&.v=1591634795000" alt="Apple airpods" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MKU93_VW_34FR+watch-40-alum-gold-nc-se_VW_34FR_WF_CO?wid=1400&hei=1400&trim=1,0&fmt=p-jpg&qlt=95&.v=1632171039000,1630712417000" alt="Apple watch" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/airtag-4pack-select-202104_FMT_WHH?wid=1000&hei=1000&fmt=jpeg&qlt=95&.v=1617761669000" alt="Apple airtags" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/mbp-spacegray-select-202011_GEO_EMEA_LANG_NL?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1632948906000" alt="Macbook pro" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://images.mobilefun.co.uk/graphics/450pixelp/83357.jpg" alt="Magsafe iphone charger" class="hover">
          </a>
        </div>
      </div>
    </div>

    <div class="trendingcontainer">
      <span class="headertext">Trending</span>
      <div class="trending">
        <div class="picture">
          <a href="">
            <img src="https://as-images.apple.com/is/MXJ92?wid=445&hei=445&fmt=jpeg&qlt=95&.v=1580420175341" alt="Beats studio3" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://www.notebookcheck.nl/uploads/tx_nbc2/AcerChromebook11-CB311-9HT__1_.JPG" alt="Acer chromebook" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://images.mobilefun.co.uk/graphics/productgalleries/82982/b.jpg" alt="Iphone charger" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://image.gsmpunt.nl/product/90000/82387/360x432/dux-ducis-apple-iphone-11-tempered-glass-screen-protector_8.jpg" alt="screenprotector" class="hover">
          </a>
        </div>
        <div class="picture">
          <a href="">
            <img src="https://media.travelbags-cdn.nl/sqaure-1360/72734/image.jpg" alt="Herschel bag" class="hover">
          </a>
        </div>
      </div>
    </div>

    <div class="categorycontainer">
      <span class="headertext">Categories</span>
      <div class="category">
        <div class="column">
          <a href="">
            <img src="https://static.iphoned.nl/orca/products/9402/apple-macbook-pro.jpg" alt="Electronics" class="view">
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