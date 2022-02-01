<?php
session_start();
$product_id = $_SESSION['product_id'];
$username = $_SESSION['username'];
unset($_SESSION['cart']);
include "db_connect.php";

echo "$product_id";


if(isset($_SESSION['cart']))
{
    $query = "INSERT INTO cart_items (product_id) 
    VALUES ('$product_id') WHERE user_id = '$username'";
    if(mysqli_query($conn, $query)) 
    {
        echo "Already set";
    } else {
        echo "Error";
    }

} else 
{
    $query = "INSERT INTO cart_items (user_id, product_id)
    VALUES ('$username', '$product_id')";
    
    if(mysqli_query($conn, $query)) 
        {
        $_SESSION['cart'] = 1; 
        
        echo "Already set";
        } else {
            echo "Error";
        }
    
}

header("Location: product.php?id=$product_id");



?>