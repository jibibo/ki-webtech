<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contact us | UvAzon</title>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/contact.css" />
</head>

<body>
  <?php
  include "navbar.php";
  ?>

  <!-- <a href="index.php">
    <button type="button" class="homebutton">
      <span class="button_icon">
        <ion-icon name="home-outline"></ion-icon>
      </span>
    </button>
  </a> -->

  <div class="contact-container">
    <!-- <h1>CONTACT US!
      <img src="images/uvazon.png" alt="Uvazon logo" width="250px">
    </h1>
    <p>If you have any questions about you product or order, please fill in the following information</p> -->

    <div class="contact_box">
      <div class="contact_left">
        <h3>FILL IN BELOW</h3>

        <form name="frmContact" method="post" action="contacted.php">
          <div class="input_row">
            <div class="input_group">
              <label>NAME</label>
              <input name="NAME" class="input-form" type="text" placeholder="dr.bibo" required></input>

            </div>
            <div class="input_group">
              <label>PHONE</label>
              <input name="PHONE" class="input-form" type="text" placeholder="+31 ..." required></input>

            </div>

            <div class="input_group">
              <label>EMAIL</label>
              <input name="EMAIL" class="input-form" type="email" placeholder="dr.bibo@gmail.com" required></input>

            </div>
            <div class="input_group">
              <label>SUBJECT</label>
              <input name="SUBJECT" class="input-form" type="text" placeholder="subject of contact" required></input>

            </div>
          </div>
          <label>MESSAGE</label>
          <textarea rows="10" placeholder="max 200 characters" required></textarea>
          <div class="messagebutton">
            <button name="MESSAGE" type="submit">SUBMIT</button>
          </div>


        </form>

      </div>
      <div class="contact_right">
        <h3>REACH US!</h3>
        <table>
          <tr>
            <td>EMAIL</td>
            
              <td><a href="mailto:uvazon@contact.nl">uvazon@contact.com</a></td>
            
          </tr>
          <tr>
            <td>PHONE</td>
            <td>06-beldrbibo</td>
          </tr>
          <tr>
            <td>ADRESS</td>
            <td><a href="https://www.google.com/maps/place/Science+Park+904/@52.3544089,4.9535252,17z/data=!3m1!4b1!4m5!3m4!1s0x47c60944ecd0187d:0xbae0bc22b93e4985!8m2!3d52.3544089!4d4.9557139" >Science Park 904, 1098 XH Amsterdam</a></td>
          </tr>
        </table>
      </div>

    </div>
  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>