<?php
include "db_connect.php";
session_start();

if(isset($_SESSION['username']))
{
    $username = $_SESSION["username"];
    $user_query = "SELECT id FROM customers WHERE email = '$username'";
    $user_result = mysqli_query($conn, $user_query);
    $user_id = mysqli_fetch_array($user_result);

    $status = "Processing";
    $adress = $_POST['adress'];
    $postal_code = $_POST['postal-code'];
    $email = $_POST['e-mail'];
    $phone = $_POST['phone'];
    $subtotal = 0;

    // fetching subtotal
    $cart_query = "SELECT product_id FROM cart_items WHERE user_id = '$username'";
    $cart_result = mysqli_query($conn, $cart_query);

    while($cart_items = mysqli_fetch_array($cart_result)) {     
        $product_id = $cart_items['product_id'];
        $product_query = "SELECT * FROM products WHERE id = '$product_id'";
        $product_result = mysqli_query($conn, $product_query);
        $product_info = mysqli_fetch_assoc($product_result);

        $price = $product_info['price'];
        $subtotal = $subtotal + $price;
    }
  
    

    $query = "INSERT INTO order_info (user_id, status, 
    address, postal_code, email, phone_number, price)
    VALUES ('$user_id[0]', '$status', '$adress', '$postal_code', 
    '$email', '$phone', '$subtotal')";

    if(mysqli_query($conn, $query)) 
    {
        echo "succes";
    } else {
        echo "Error";
    } 
}


/* ALERT BOX */

$delete_query = "DELETE FROM cart_items WHERE user_id = '$username'";

if(mysqli_query($conn, $delete_query))
{
    unset($_SESSION['cart']);
}

echo 
"
<script>
window.alert('Payment successful!');
window.location.href = '/';
</script>
";

?>