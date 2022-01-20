<!DOCTYPE html>
<html lang="en">

<head>
  <title>Checkout | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/checkout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&amp;display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include "navbar.php";
  ?>

<div class="col-container">
            <div class="shipping-info">
                <h2>Shipping information </h2>
                <form>
                    <label for="first-name">First name</label>
                    <input type="text" id="first-name" placeholder=""><br>
                    <label for="last-name">Last name</label>
                    <input type="text" id="last-name" placeholder=""><br>
                    
                    <label for="adress">Street name and house number</label>
                    <input type="text" id="adress" placeholder=><br>
                    <label for="postal-code">Postal code</label>
                    <input type="text" id="postal-code" placeholder=""><br>
             <!--   <div class="payment"> 
                        <input type="submit" value="Continue to payment">
                    </div>  ---> 
                </form>
                    <div class="contact-info">
                        <h2> Contact information </h2>
                        <form>
                            <label for="e-mail">E-mail adress</label>
                            <input type="text" id="e-mail" placeholder=""> 
                            <label for="phone">Phone number</label>
                            <input type="text" id=phone" placeholder="">
                            <div class="payment"> 
                                <input type="submit" value="Continue to payment">
                            </div>
                        </form>
                    </div>
            </div> 
            <div class="cart">
                <div class="cart-container">
                    <h2> Cart </h2> 
                    <div class="order-info">
                        <table> 
                            <tr>
                                <td><h3>Product name 1</h3></td>
                                <td class="left"><h3> €10 </h3> </td>
                            </tr>
                            <tr>
                                <td><h3>Product name 2</h3></td>
                                <td class="left"><h3> €10 </h3> </td> 
                            </tr>
                            <tr>
                                <td><h3>Product name 3</h3></td>
                                <td class="left"><h3> €10 </h3> </td> 
                            </tr>

                            <tr> <tfoot>
                                <td><h3>Subtotal:</h3></td>
                                <td class="left"><h3> €10 </h3> </td>
                            </tr> </tfoot>
                        </table>
                </div> 
            </div> 
        </div> 

  <?php
  include "footer.php";
  ?>
</body>

</html>
