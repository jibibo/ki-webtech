<div id="footerplace">
  <div class="footer_container">
    <div class="footer">
      <div class="footer-heading footer-1">
        <h2>ABOUT US</h2>
        <a href="#">Blog</a>
        <a href="#">PRODUCTS</a>
        <a href="#">huppelepup</a>
        <a href="#">terms of service</a>
        <a href="#">delivery</a>
      </div>
      <div class="footer-heading footer-2">
        <h2>CONTACT</h2>
        <a href="mailto:uvazon@contact.nl">uvazon@contact.nl</a>
        <a href="#">06-87654321</a>
        <a href="https://www.google.com/maps/place/Science+Park+904/@52.3544089,4.9535252,17z/data=!3m1!4b1!4m5!3m4!1s0x47c60944ecd0187d:0xbae0bc22b93e4985!8m2!3d52.3544089!4d4.9557139">Science Park 904, 1098 XH Amsterdam</a>
        <a href="#">fax</a>
      </div>
      <div class="footer-heading footer-3">
        <h2>SOCIALS</h2>
        <a href="#">hyves</a>
        <a href="#">Instagram</a>
        <a href="#">habbo</a>
        <a href="#">twitter</a>
        <a href="#">facebook</a>
      </div>
      <div class="footer_emailform">
        <h2>JOIN OUR NEWSLETTER!</h2>
        <form action="sign-up.php" method="post"> 
          <input type="email" placeholder="please enter email..." id="footer_email" name="email"/><!-- required 
          oninvalid="this.setCustomValidity('Please enter an email address')"
          oninput="this.setCustomValidity('')"/> -->
          <input type="submit" onclick="message()" value="SIGN UP!" id="footer_email_btn" name="submit"/>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  function message() {
    var input_valid = document.getElementById("footer_email");
    if (input_valid.checkValidity()) {
      alert("Thank You For Signing Up!");
    } //else {
      //alert("Invalid email");  test internet
    //} 
  }
</script> -->

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/activeNavLink.js"></script>